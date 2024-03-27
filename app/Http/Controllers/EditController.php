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
        $directory = 'images';
        $fileName = $request->file('picture')->getClientOriginalName();
        $request->file('picture')->storeAs('public/' . $directory, $fileName);


        $menuList = new MenuList();
        $menuList->menu = $request->menu;
        $menuList->price = $request->price;
        $menuList->picture = 'storage/' . $directory . '/' . $fileName;
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
        $menus->show_date = $request->show_date;
        $menus->sold_out = 0;
        $menus->save();

        return redirect()
            ->route('edit.postPage');
    }

    public function destroy($id)
    {
        $menu = MenuViewer::findOrFail($id);
        $menu->delete();

        return redirect()
            ->route('edit.editPage');
    }

    public function toggle($id)
    {
        $menu = MenuViewer::findOrFail($id);

        $menu->sold_out = !($menu->sold_out);
        $menu->save();

        return redirect()
            ->route('edit.editPage');
    }

    // 各詳細表示画面
    public function postPage()
    {
        $menuList = MenuList::all();
        $MenuViewer = MenuViewer::all();

        return view('edit.postPage')
            ->with(['menuList' => $menuList, 'MenuViewer' => $MenuViewer]);
    }

    public function create()
    {
        $menuList = MenuList::all();
        $MenuViewer = MenuViewer::all();

        return view('edit.create')
            ->with(['menuList' => $menuList, 'MenuViewer' => $MenuViewer]);
    }





}
