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
            @if ($menu->show_date == date('Y-m-d'))
                <div class="menu" data-id="{{ $menu->id }}">
                    <a data-id="{{ $menu->id }}" class="menuDetail">
                        <img src="{{ asset($menu->menuList->picture) }}" alt="{{ $menu->menuList->menu }}"></a>
                    <p>{{ $menu->menuList->menu }}</p>
                    <p><span>&#xa5</span>{{ $menu->menuList->price }} </p>
                    <p class="soldOut {{ !$menu->sold_out ? 'hidden' : '' }}">SOLD OUT</p>
                </div>
            @endif
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
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <button id="modalClose">
                閉じる
            </button>
        </div>
    </section>


    <script>
        'use strict';

        const menuDetails = document.querySelectorAll('.menuDetail');
        const modal = document.getElementById('modal');
        const mask = document.getElementById('mask');
        // const soldOut = document.querySelector('div#modal.p.soldOut');

        menuDetails.forEach(menuDetail => {
            menuDetail.addEventListener('click', () => {
                let responseClone;

                fetch(`/menuViewer/${menuDetail.parentNode.dataset.id}/detail`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: menuDetail.dataset.id,
                        }),
                    })
                    .then(response => {
                        responseClone = response.clone();
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);

                        modal.querySelector('img').src = menuDetail.firstElementChild.src;

                        modal.querySelector('li:nth-child(1)').innerText = `メニュー: ${data.menu}`;
                        modal.querySelector('li:nth-child(2)').innerText = `値段: ${data.price}`;

                        modal.querySelector('li:nth-child(3)').innerText = `エネルギー: ${data.energy}`;
                        modal.querySelector('li:nth-child(4)').innerText = `タンパク質: ${data.protein}`;
                        modal.querySelector('li:nth-child(5)').innerText = `脂質: ${data.lipid}`;
                        modal.querySelector('li:nth-child(6)').innerText =
                        `炭水化物: ${data.carbohydrates}`;
                        modal.querySelector('li:nth-child(7)').innerText = `食塩相当量: ${data.salt}`;
                        modal.querySelector('li:nth-child(8)').innerText = `カルシウム: ${data.calcium}`;
                        modal.querySelector('li:nth-child(9)').innerText = `野菜量: ${data.vegetable}`;

                        if (data.sold_out == 1) {
                            modal.querySelector('.soldOut').classList.remove("hidden");
                        }

                    }, function(rejectionReason) {
                        console.log('Error parsing JSON from response:', rejectionReason,
                        responseClone);
                        responseClone.text()
                            .then(function(bodyText) {
                                console.log('Received the following instead of valid JSON:',
                                    bodyText);
                                console.log('Substring after position 15:', bodyText.substring(
                                235));
                            });
                    });

                mask.classList.remove('hidden');
                modal.classList.remove('hidden');
            });
        });

        // モーダルを閉じる
        const modalClose = document.getElementById('modalClose');
        modalClose.addEventListener('click', () => {
            mask.classList.add('hidden');
            modal.classList.add('hidden');

            if (!modal.querySelector('.soldOut').classList.contains("hidden")) {
                modal.querySelector('.soldOut').classList.add("hidden");
            }
        });
    </script>
</body>

</html>
