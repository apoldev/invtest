<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attr;
use App\Models\Item;
use App\Models\AttrGroup;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Item::paginate(10);
        return view('admin.items', compact('items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = Item::findOrFail($id);
        $item->load('attrs.group');

        $groups = AttrGroup::with('attrs')->get(["id", "title", "slug"])->toArray();

        $current_attrs = [];
        foreach($item->toArray()['attrs'] as $a){
            $current_attrs[$a['group']['slug']] = $a['slug'];
        }

        return view('admin.edit', compact('item', 'groups', 'current_attrs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $validData = $request->validate([
            'title' => 'min:5|max:200',
            'attrs.*' => 'exists:attrs,id'
        ]);

        $item = Item::find($id);

        if(empty($item)){
            return back()->withErrors(['msg' => "Товар не найден"])->withInput();
        }

        $request_attrs = array_values($validData['attrs']);
        $attrs = Attr::find($request_attrs);


        if(!empty($attrs)){
            $item->attrs()->sync($attrs->pluck('id')->toArray());
        }

        if($item->fill($validData)->save()){
            return redirect()->route('items.edit', $item->id)->with(['success' => 'Успешно изменено']);
        }


        return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // Отвяжем связи свойств
        $item->attrs()->detach();
        
        $item->delete();

        return back()->with([
            'success' => "Товар \"$item->title\" успешно удален",
        ]);
    }
}
