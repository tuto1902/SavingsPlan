<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function create()
    {
        return view('items.create');
    }

    public function store()
    {
        Item::truncate();

        foreach(request('items') as $item){
            $item['amount'] = preg_replace('/[^0-9]/', '', $item['amount']);
            if($item['label'] && $item['amount']) {
                Item::create($item);
            }
        }

        return redirect('/');
    }
}
