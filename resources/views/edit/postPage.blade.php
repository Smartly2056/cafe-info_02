<?php
    date_default_timezone_set('Asia/Tokyo');

    $week = [
        "日", "月", "火", "水", "木", "金", "土",
    ];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー掲載画面</title>
    <link rel="stylesheet" href="{{ url('css/menu.css') }}">
</head>

<body>
    <div>
        &laquo; <a href="{{ route('edit.editPage') }}">戻る</a>
    </div>
    <h1>メニュー掲載画面</h1>

    <h3>メニュー掲載フォーム</h3>
    <div class="showImage">
        <form action="{{ route('edit.show') }}" method="POST">
            @csrf

            <div>
                <label>メニューID</label>
                <input type="number" name="menu_id">
            </div>
            <div>
                <label>掲載日</label>
                <select name="show_date">
                    <option value="{{ date('Y-m-d') }}">
                        {{ date('m/d') }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        {{ date('m/d', strtotime('+1 day')) }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+2 day')) }}">
                        {{ date('m/d', strtotime('+2 day')) }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+3 day')) }}">
                        {{ date('m/d', strtotime('+3 day')) }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+4 day')) }}">
                        {{ date('m/d', strtotime('+4 day')) }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+5 day')) }}">
                        {{ date('m/d', strtotime('+5 day')) }}
                    </option>
                    <option value="{{ date('Y-m-d', strtotime('+6 day')) }}">
                        {{ date('m/d', strtotime('+6 day')) }}
                    </option>
                </select>
            </div>
            <button type="submit">メニュー掲載</button>
        </form>

        <button class="purge">全て削除</button>
    </div>
    <hr>

    <h3>メニュー一覧</h3>



    <div class="dateOptions">
        <div>
            <input type="radio" name="date" id="today" checked>
            <label for="today">{{ date('m/d') . '(' . $week[date('w')] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="tomorrow">
            <label for="tomorrow">{{ date('m/d', strtotime('+1 day')) . '(' . $week[date('w', strtotime('+1 day'))] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="two">
            <label for="two">{{ date('m/d', strtotime('+2 day')) . '(' . $week[date('w', strtotime('+2 day'))] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="three">
            <label for="three">{{ date('m/d', strtotime('+3 day')) . '(' . $week[date('w', strtotime('+3 day'))] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="four">
            <label for="four">{{ date('m/d', strtotime('+4 day')) . '(' . $week[date('w', strtotime('+4 day'))] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="five">
            <label for="five">{{ date('m/d', strtotime('+5 day')) . '(' . $week[date('w', strtotime('+5 day'))] . ')' }}</label>
        </div>
        <div>
            <input type="radio" name="date" id="six">
            <label for="six">{{ date('m/d', strtotime('+6 day')) . '(' . $week[date('w', strtotime('+6 day'))] . ')' }}</label>
        </div>
    </div>


    <div class="menuViewer">
        @forelse ($MenuViewer as $menu)
            <div class="menu" data-id="{{ $menu->id }}">
                <img src="{{ asset($menu->menuList->picture) }}" alt="{{ $menu->menuList->menu }}">
                <p>{{ $menu->menuList->menu ? $menu->menuList->menu : '-' }}</p>
                <p><span>&#xa5</span>{{ $menu->menuList->price ? $menu->menuList->price : '-' }}</p>

                <button data-id="{{ $menu->id }}" class="delete">削除</button>
                <input type="checkbox" data-id="{{ $menu->id }}" {{ $menu->sold_out ? 'checked' : '' }}>完売</input>
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
                    <td>{{ $menu->id ? $menu->id : '-' }}</td>
                    <td>{{ $menu->menu ? $menu->menu : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td>No menu_id yet</td>
                    <td>No menu yet</td>
                </tr>
            @endforelse
        </table>
    </div>



    <script>
        function previewFile(event) {
            let fileData = new FileReader();
            fileData.onload = (function() {
                const preview = document.getElementById('preview');
                preview.src = fileData.result;
                preview.style.width = "200px";
                preview.style.height = "150px";

            });
            fileData.readAsDataURL(event.files[0]);
        }

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                fetch(`/editPage/${checkbox.parentNode.dataset.id}/toggle`, {
                    method: 'POST',
                    // method: 'PATCH',
                    body: new URLSearchParams({
                        id: checkbox.dataset.id,
                    }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });
                checkbox.parentNode.classList.toggle('soldOut');
            });
        });

        const deletes = document.querySelectorAll('.delete');
        deletes.forEach(button => {
            button.addEventListener('click', () => {
                fetch(`/editPage/${button.parentNode.dataset.id}/destroy`, {
                    method: 'POST',
                    // method: 'DELETE',
                    body: new URLSearchParams({
                        id: button.dataset.id,
                    }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });

                button.parentNode.remove();
            });
        });
    </script>
</body>



</html>
