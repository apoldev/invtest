<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class CatalogController extends Controller
{
    //

    public function list(){


        $items = Item::with('attrs')->get();

        return view('catalog',[
            'items' => $items
        ]);
    }
}
