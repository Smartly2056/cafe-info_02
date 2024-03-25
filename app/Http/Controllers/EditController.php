<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuList;
use App\Models\MenuViewer;
use App\Http\Requests\MenuRequest;


class EditController extends Controller
{
    public function store(MenuRequest $request)
    {
        $menuList = new MenuList();
        $menuList->menu = $request->menu;
        $menuList->price = $request->price;
        $menuList->picture = $request->picture;
        $menuList->energy = $request->energy;
        $menuList->protein = $request->protein;
        $menuList->lipid = $request->lipid;
        $menuList->carbohydrates = $request->carbohydrates;
        $menuList->salt = $request->salt;
        $menuList->calcium = $request->calcium;
        $menuList->vegetable = $request->vegetable;
        $menuList->save();

        return redirect()
            ->route('edit.editPage');
    }

    public function show(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
        ]);

        $menus = new MenuViewer();
        $menus->menu_id = $request->menu_id;
        // $menus->show_date = null;
        $menus->sold_out = 0;
        $menus->save();

        return redirect()
            ->route('edit.editPage');
    }
}
