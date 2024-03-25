<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuList;
use App\Models\MenuViewer;


class MenuController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showMenus()
    {
        $menus = MenuViewer::all();

        return view('viewer.menuViewer')
            ->with(['menus' => $menus]);
    }

    // 管理者ページ
    public function editPage()
    {
        $menuList = MenuList::all();

        return view('edit.editPage')
            ->with(['menuList' => $menuList]);
    }

}
