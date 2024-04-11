<?php
date_default_timezone_set('Asia/Tokyo');

$week = ['日', '月', '火', '水', '木', '金', '土'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー掲載画面</title>
    <link rel="stylesheet" href="{{ url('css/editPage.css') }}">
</head>

<body>
    <div>
        &laquo; <a href="{{ route('edit.editPage') }}">戻る</a>
    </div>
    <h1>メニュー掲載画面</h1>

    <h3>メニュー掲載フォーム</h3>
    <div class="showImage">
        <form action="{{ route('edit.post') }}" method="POST">
            @csrf

            <div>
                <label>メニューID</label>
                <input type="number" name="menu_id">
            </div>
            <div>
                <label>提供日</label>
                <select name="show_date">
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $dateValue = date('Y-m-d', strtotime('+' . $i . 'day'));
                            $oldValue = old('show_date');
                        @endphp

                        <option value="{{ $dateValue }}" {{ $oldValue == $dateValue ? 'selected' : '' }}>
                            {{ date('m/d', strtotime('+' . $i . 'day')) }}
                            {{ old('show_date') }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit">メニュー掲載</button>
        </form>

        {{-- <button class="purge">全て削除</button> --}}
    </div>
    <hr>

    <h3>メニュー一覧</h3>

    {{-- 日付選択 --}}
    <div class="dateOptions">
        @for ($i = 0; $i < 7; $i++)
            @php
                $dateValue = date('Y-m-d', strtotime('+' . $i . 'day'));
            @endphp

            <button class="showDate"
                value="{{ $dateValue }}">{{ date('m/d', strtotime('+' . $i . ' day')) . '(' . $week[date('w', strtotime('+' . $i . ' day'))] . ')' }}</button>
        @endfor
    </div>

    {{-- メニュー一覧 --}}
    <div>
        @for ($i = 0; $i < 7; $i++)
            @php
                $dateValue = date('Y-m-d', strtotime('+' . $i . 'day'));
            @endphp

            <p data-id="{{ $dateValue }}" class="menuDate {{ $i !== 0 ? 'hidden' : '' }}">
                {{ date('m/d', strtotime('+' . $i . ' day')) }}のメニュー</p>
            <div data-id="{{ $dateValue }}" class="menuViewer {{ $i !== 0 ? 'hidden' : '' }}">
                @forelse ($MenuViewer as $menu)
                    @if ($menu->show_date == date('Y-m-d', strtotime('+' . $i . ' day')))
                        <div class="menu" data-id="{{ $menu->id }}">
                            <img src="{{ asset($menu->menuList->picture) }}" alt="{{ $menu->menuList->menu }}">
                            <p>{{ $menu->menuList->menu ? $menu->menuList->menu : '-' }}</p>
                            <p><span>&#xa5</span>{{ $menu->menuList->price ? $menu->menuList->price : '-' }}</p>

                            <button data-id="{{ $menu->id }}" class="delete_post">削除</button>
                        </div>
                    @endif
                @empty
                    <p>No menus yet</p>
                @endforelse
            </div>
        @endfor
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


    {{-- JS --}}
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

        const deletes = document.querySelectorAll('.delete_post');
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

        const showDates = document.querySelectorAll('.showDate');
        const menuViewers = document.querySelectorAll('.menuViewer');
        const menuDates = document.querySelectorAll('.menuDate');

        showDates.forEach(date => {
            date.addEventListener('click', () => {
                menuViewers.forEach(menuViewer => {
                    menuViewer.classList.add('hidden');

                    if (menuViewer.dataset.id == date.value) {
                        menuViewer.classList.remove('hidden');
                    }
                });
                menuDates.forEach(menuDate => {
                    menuDate.classList.add('hidden');

                    if (menuDate.dataset.id == date.value) {
                        menuDate.classList.remove('hidden');
                    }
                });

            });
        });
    </script>
</body>



</html>
