<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー表示</title>
    <link rel="stylesheet" href="{{ url('css/menu.css') }}">
</head>

<body>
    <div class="menuViewer">
        @forelse ($MenuViewer as $menu)
            <div class="menu" data-id="{{ $menu->id }}">
                <a data-id="{{ $menu->id }}"><img src="{{ asset($menu->menuList->picture) }}" alt="{{ $menu->menuList->menu }}"></a>
                <p>{{ $menu->menuList->menu }}</p>
                <p><span>&#xa5</span>{{ $menu->menuList->price }} </p>
                <p class="soldOut {{ !($menu->sold_out) ? "hidden" : ""}}">SOLD OUT</p>
            </div>
        @empty
            <p>No menus yet</p>
        @endforelse
    </div>


    <!-- モーダル -->
    <section id="mask" class="hidden">
        <div id="modal" class="hidden">

            <img src="" alt="">
            <p class="soldOut hidden">SOLD OUT</p>
            <ul>
                @forelse ($MenuViewer as $menu)
                    <li>{{ $menu->menu_id }}</li>
                @empty
                    <span>No menu yet</span>
                @endforelse
            </ul>
            <button id="modalClose">
                閉じる
            </button>
        </div>
    </section>


    <script src="menu.js"></script>
</body>

</html>
