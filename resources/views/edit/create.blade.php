<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規メニュー追加</title>
    <link rel="stylesheet" href="{{ url('css/editPage.css') }}">
</head>

<body>
    <div>
        &laquo; <a href="{{ route('edit.editPage') }}">戻る</a>
    </div>
    <h1>新規メニュー追加画面</h1>

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

    <hr>
    <h3>メニューを追加</h3>
    <div class="submitImage">
        <form action="{{ route('edit.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <img id="preview">
                <input type="file" name="picture" onchange="previewFile(this);">
                @error('picture')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="#">メニュー名</label>
                <input type="text" name="menu" placeholder="例:カレーライス">
                @error('menu')
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
