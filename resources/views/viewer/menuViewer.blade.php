<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー表示</title>
    {{-- <link rel="stylesheet" href="css/menu.css"> --}}
</head>

<body>
    <div class="menuViewer">
        <div class="menu">

        </div>
    </div>


    <!-- モーダル -->
    <section id="mask" class="hidden">
        <div id="modal" class="hidden">
            <img src="" alt="">
            <p class="soldOut hidden">SOLD OUT</p>
            <ul>
                @forelse ($menus as $menu)
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
