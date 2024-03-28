<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuList;
use App\Models\MenuViewer;
use App\Models\Calendar;
use App\Http\Requests\MenuRequest;


// メニュー編集画面トップ
class EditController extends Controller
{
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

    public function calendar(Request $request)
    {
        $directory = 'calendars';
        $fileName = $request->file('calendar')->getClientOriginalName();
        $request->file('calendar')->storeAs('public/' . $directory, $fileName);

        $calendar = new Calendar();
        $calendar->calendar = 'storage/' . $directory . '/' . $fileName;
        $calendar->save();

        return redirect()
            ->route('edit.editPage');
    }


    // メニュー掲載画面
    public function postPage()
    {
        $menuList = MenuList::all();
        $MenuViewer = MenuViewer::where('show_date', '>=', date('Y-m-d'))
            ->orderBy('show_date', 'asc')
            ->get();

        return view('edit.postPage')
            ->with(['menuList' => $menuList, 'MenuViewer' => $MenuViewer]);
    }

    public function post(Request $request)
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

    // 新規メニュー追加画面
    public function create()
    {
        $menuList = MenuList::all();
        $MenuViewer = MenuViewer::all();

        return view('edit.create')
            ->with(['menuList' => $menuList, 'MenuViewer' => $MenuViewer]);
    }

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





}
