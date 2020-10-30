<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\AttrGroup;


class CatalogController extends Controller
{
    //

    public function list(){


        $items = Item::with('attrs')->get();
        $groups = AttrGroup::with('attrs')->get();

        $filter_data = [
            "groups" => $groups,
            "price_min" => 0, //Item::min('price'),
            "price_max" => Item::max('price')
        ];

        return view('catalog',[
            'items' => $items,
            'filter' => $filter_data
        ]);
    }
}
