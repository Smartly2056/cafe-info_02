<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー編集</title>
    <link rel="stylesheet" href="{{ url('css/menu.css') }}">
</head>

<body>
    <h1>メニュー編集画面</h1>

    <h3>メニュー掲載フォーム</h3>
    <div class="showImage">
        <form action="{{ route('edit.show') }}" method="POST">
            @csrf

            <div>
                <label for="#">メニューID</label>
                <input type="number" name="menu_id">
            </div>
            <button type="submit">メニュー掲載</button>
        </form>

        <button class="purge">全て削除</button>
    </div>
    <hr>

    <div class="menuViewer">
        @forelse ($MenuViewer as $menu)
            <div class="menu">
                <a data-id="{{ $menu->id }}"><img src="#" alt="#"></a>
                <p>{{ $menu->menuList->menu }}</p>
                <p>&#xa5 {{ $menu->menuList->price }}</p>

                </p>
                <button data-id="#" class="delete">削除</button>
                <input type="checkbox" data-id="#">完売</input>
            </div>
        @empty
            <p>No menus yet</p>
        @endforelse
    </div>

    <hr>
    <div class="menuList">
        <h3>メニューリスト</h3>
        <table>
            <tr>
                <th>メニューID</th>
                <th>メニュー名</th>
            </tr>
            @forelse ($menuList as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->menu }}</td>
                </tr>
            @empty
                <tr>
                    <td>No menu_id yet</td>
                    <td>No menu yet</td>
                </tr>
            @endforelse
        </table>
    </div>

    <hr>
    <h3>メニューを追加</h3>
    <div class="submitImage">
        <form action="{{ route('edit.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- <div>
                <img id="preview">
                <input type="file" name="file" onchange="previewFile(this);">
            </div> --}}
            <div>
                <label for="#">メニュー名</label>
                <input type="text" name="menu" placeholder="例:カレーライス">
                @error('menu')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">写真</label>
                <input type="text" name="picture" placeholder="例:aaa">
                @error('picture')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">値段</label>
                <input type="number" name="price" placeholder="例:500">
                @error('price')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">エネルギー</label>
                <input type="number" name="energy">kcal
                @error('energy')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">タンパク質</label>
                <input type="number" step="0.01" name="protein">g
                @error('protein')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">脂質</label>
                <input type="number" step="0.01" name="lipid">g
                @error('lipid')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">炭水化物</label>
                <input type="number" step="0.01" name="carbohydrates">g
                @error('carbohydrates')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">食塩相当量</label>
                <input type="number" step="0.01" name="salt">g
                @error('salt')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">カルシウム</label>
                <input type="number" step="0.01" name="calcium">g
                @error('calcium')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">野菜量</label>
                <input type="number" step="0.01" name="vegetable">g
                @error('vegetable')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" name="submit">メニュー追加</button>
        </form>
    </div>
    <hr>
    <h3>営業時間を更新</h3>
    <div class="submitCalendar">
        <form action="" method="" enctype="">
            <div>
                <img id="previewCalendar">
                <input type="file" name="file_calendar" onchange=";">
            </div>
            <button type="submit" name="submit">更新</button>
        </form>
    </div>
    <hr>
    <div>
        <a href="">新規ユーザー登録</a>
    </div>
    <a href="">ログアウト</a>


    <script src=""></script>
</body>


</html>
