<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\AttrGroup;

class CatalogController extends Controller
{
    //

    public function list(Request $request){



        $data = $request->validate([
            'priceFrom' => 'numeric|min:0',
            'priceTo' => 'numeric|min:0',
        ]);


        // Доступные группы фильтров
        $groups = AttrGroup::with('attrs')->get(["id", "title", "slug"])->toArray();



        // Обработаем get запрос, и сравнив с доступными фильтрами
        $input_filter = [];
        foreach($groups as &$group){

            foreach($group['attrs'] as &$filter_attr){
                $filter_attr['checked'] = false;
            }

            if($request->has($group['slug'])){
                if(!empty($request->get($group['slug']))){
                    $input_filter_array = preg_split("/[\s,]+/is", $request->get($group['slug'])) ?? [];

                    foreach($group['attrs'] as &$filter_attr){
                        $filter_attr['checked'] = in_array($filter_attr['slug'], $input_filter_array);
                    }

                    $input_filter[$group['slug']] = $input_filter_array;
                }
                
            }
        }

        
        // Загрузим коллекцию товаров
        $items = new Item();

        // Если есть фильтры свойств, то применим
        foreach($input_filter as $filters){
            if(!empty($filters)){
                $items = $items->whereHas('attrs', function ($query) use ($filters) {
                    $query->where(function($q) use ($filters){
                        foreach($filters as $filter){
                            $q->orWhere("slug", $filter);
                        }
                    });
                });
            }
        }


        // Запомним минимальные и максимальные цены на основе фильтров по свойствам
        $price_min = $items->min('price') ?? 0;
        $price_max = $items->max('price') ?? 9000;


        // если есть фильтры цен, то применим
        if($request->has("priceTo")){
            $items = $items->where("price", "<=", $data["priceTo"]);
        }

        if($request->has("priceFrom")){
            $items = $items->where("price", ">=", $data['priceFrom']);
        }

        // Подтянем свойства товаров, на всякий случай я их вывожу в карточке товара
        $items = $items->with('attrs');

        
        
        
        $filter_data = [
            "groups" => $groups,
            "price_min" => $price_min,
            "price_max" => $price_max,
            "price_filter" => [
                empty($data['priceFrom']) ? $price_min : $data['priceFrom'], 
                empty($data['priceTo']) ? $price_max : $data['priceTo']
            ]
        ];
        
        

        return view('catalog',[
            'items' => $items->get(),
            'filter' => $filter_data
        ]);
    }
}
