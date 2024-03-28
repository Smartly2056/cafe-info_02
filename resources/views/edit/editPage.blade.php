<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー編集</title>
    <link rel="stylesheet" href="{{ url('css/editPage.css') }}">
</head>

<body>
    <h1>メニュー編集画面</h1>

    <a href="{{ route('edit.postPage') }}">メニュー掲載画面</a>
    <a href="{{ route('edit.create') }}">新規メニュー追加画面</a>

    <hr>
    <h3>本日のメニュー</h3>
    <div class="menuViewer">
        @forelse ($MenuViewer as $menu)
            @if ($menu->show_date == date('Y-m-d'))
                <div class="menu" data-id="{{ $menu->id }}">
                    <img src="{{ asset($menu->menuList->picture) }}" alt="{{ $menu->menuList->menu }}">
                    <p>{{ $menu->menuList->menu ? $menu->menuList->menu : '-' }}</p>
                    <p><span>&#xa5</span>{{ $menu->menuList->price ? $menu->menuList->price : '-' }}</p>

                    <button data-id="{{ $menu->id }}" class="delete">削除</button>
                    <input type="checkbox" data-id="{{ $menu->id }}" {{ $menu->sold_out ? 'checked' : '' }}>完売</input>
                </div>
            @endif
        @empty
            <p>No menus yet</p>
        @endforelse
    </div>

    <hr>
    <h3>営業カレンダーを更新</h3>
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
