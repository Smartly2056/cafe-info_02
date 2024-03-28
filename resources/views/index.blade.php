<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>東北大学 学食情報</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>
    <header id="header">
        <h1 class="site-title">東北大学 学食情報</h1>
{{--
        <nav>
            <button action="#">川内の杜ダイニング</button>
            <button action="#">文系食堂</button>
            <button action="#">あおば食堂</button>
            <button action="#">みどり食堂</button>
            <button action="#">理薬食堂</button>
            <button action="#">星陵食堂</button>
            <button action="#">さくらキッチン</button>
        </nav> --}}
    </header>
    <section>
        <h2 id="store">あおば食堂</h2>

        <h2>本日のメニュー</h2>
        <div class="menus">
            <iframe src="{{ url('/menuViewer') }}" frameborder="0"></iframe>
        </div>
    </section>
    <section>
        <h2>混雑状況</h2>
        <div class="liveMovie">
            <iframe src="https://www.youtube.com/embed/vyk_Ud2z1wQ" frameborder="0" allowfullscreen></iframe>
        </div>
    </section>

    <section>
        <h2>営業時間</h2>

    </section>

    <footer>
        東北大学生協
    </footer>
</body>

</html>
