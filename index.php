<!--
==============================================================
どん語検定合格証 ver.1.2
Released: 2024/10/07 Tue.
製作者：カリドけい
https://dongo.calidokei.com/
==============================================================
-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>どん語検定合格証書</title>
    <meta name="description" content="架空の資格「どん語検定」の合格証書を作れます。">
    <meta name="keywords" content="阪神タイガース, 岡田彰布, どんでん, どんコメ, どん語, プロ野球" />
    <meta name="twitter:card" content="susummary_large_imagemmary" />
    <meta name="twitter:title" content="どん語検定合格証書" />
    <meta name="twitter:description" content="架空の資格「どん語検定」の合格証書を作れます。" />
    <meta name="twitter:image" content="img/top.png" />
    <link rel="stylesheet" href="certificate_template.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script>
        function previewCertificate() {
            // 入力された情報をリアルタイムでプレビューに反映
            document.getElementById('previewName').textContent = document.getElementById('name').value;
            
            let level = document.querySelector('input[name="level"]:checked');
            document.getElementById('previewLevel').textContent = level ? level.value : '';
            
            let listeningScore = document.getElementById('listeningScore').value;
            document.getElementById('previewListeningScore').textContent = listeningScore ? listeningScore : '0';

            let speakingScore = document.getElementById('speakingScore').value;
            document.getElementById('previewSpeakingScore').textContent = speakingScore ? speakingScore : '0';

            let fillScore = document.getElementById('fillScore').value;
            document.getElementById('previewFillScore').textContent = fillScore ? fillScore : '0';

            let summaryScore = document.getElementById('summaryScore').value;
            document.getElementById('previewSummaryScore').textContent = summaryScore ? summaryScore : '0';

            let essayScore = document.getElementById('essayScore').value;
            document.getElementById('previewEssayScore').textContent = essayScore ? essayScore : '0';

            let totalScore = (parseInt(listeningScore) || 0) + (parseInt(speakingScore) || 0) + (parseInt(fillScore) || 0) + (parseInt(summaryScore) || 0) + (parseInt(essayScore) || 0);
            document.getElementById('previewTotalScore').textContent = totalScore;

            // 証明写真のプレビュー
            const photoInput = document.getElementById('photo');
            const photoPreview = document.getElementById('previewPhoto');
            if (photoInput.files && photoInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                }
                reader.readAsDataURL(photoInput.files[0]);
            } else {
                photoPreview.src = '';
            }
        }
    </script>
</head>
<body>
<script src="//accaii.com/donden/script.js" async></script><noscript><img src="//accaii.com/donden/script?guid=on"></noscript>

    <h1>どん語検定合格証</h1>
    <img src="img/top.png" alt="top-image" style="max-width: 50%"><br>
    <div class="input-section">
        <h2>情報入力</h2>
        <form id="certForm" action="save_image.php" method="POST" enctype="multipart/form-data">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" oninput="previewCertificate()" required><br>

            <label for="level">合格級:</label>
            <input type="radio" id="grade3" name="level" value="3級" onclick="previewCertificate()" required>3級
            <input type="radio" id="grade2" name="level" value="2級" onclick="previewCertificate()">2級
            <input type="radio" id="grade1" name="level" value="1級" onclick="previewCertificate()">1級<br>

            <label for="photo">証明写真(JPG or PNG):</label>
            <input type="file" id="photo" name="photo" onchange="previewCertificate()"><br>

            <label for="listeningScore">リスニング問題点数:</label>
            <input type="number" id="listeningScore" name="listeningScore" oninput="previewCertificate()" required><br>

            <label for="speakingScore">スピーキング問題点数:</label>
            <input type="number" id="speakingScore" name="speakingScore" oninput="previewCertificate()" required><br>

            <label for="fillScore">穴埋め問題点数:</label>
            <input type="number" id="fillScore" name="fillScore" oninput="previewCertificate()" required><br>

            <label for="summaryScore">要約問題点数:</label>
            <input type="number" id="summaryScore" name="summaryScore" oninput="previewCertificate()" required><br>

            <label for="essayScore">自由作文点数:</label>
            <input type="number" id="essayScore" name="essayScore" oninput="previewCertificate()" required><br>

            <input type="submit" value="画像として保存">
        </form>

    </div>

    <div class="output-section">
        <h1>プレビュー</h1>
        <div id="certificatePreview" class="certificate">
            <h2>どん語検定合格証</h2>
            <div id="nameAndPhoto" >
                <p id="nameDisplay">名前: <span id="previewName"></span>　殿</p>
                <div style="text-align: right;">
                    <img id="previewPhoto" alt="証明写真" style="display: none; max-width: 100px; max-height: 100px;">
                    <div id="placeholderText" style="max-width: 100px; max-height: 100px; border: 1px dashed #000;">
                    <p>ここにアイコンが入ります</p>
                    </div>
                </div>
            </div>
            <hr>
            <p>合格級: <span id="previewLevel"></span></p>
            <hr>
            <p>リスニング問題点数: <span id="previewListeningScore">0</span></p>
            <hr>
            <p>スピーキング問題点数: <span id="previewSpeakingScore">0</span></p>
            <hr>
            <p>穴埋め問題点数: <span id="previewFillScore">0</span></p>
            <hr>
            <p>要約問題点数: <span id="previewSummaryScore">0</span></p>
            <hr>
            <p>自由作文点数: <span id="previewEssayScore">0</span></p>
            <hr>
            <p class="total-score">合計点数: <span id="previewTotalScore">0</span></p>
        </div>
    </div>

    <div class="fb-share-button" data-href="https://dongo.calidokei.com/" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdongo.calidokei.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Facebookにシェアする</a></div>

    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <a href="https://bsky.app/intent/compose"><img src="img/bluesky.png" alt="share-bluesky" width="50px" height="50px"/></a>

    <a href="https://misskey-hub.net/share/?text=%E3%81%A9%E3%82%93%E8%AA%9E%E6%A4%9C%E5%AE%9A%E3%81%AB%E5%90%88%E6%A0%BC%E3%81%97%E3%81%BE%E3%81%97%E3%81%9F%EF%BC%81%0A%23%E3%81%A9%E3%82%93%E8%AA%9E%E6%A4%9C%E5%AE%9A%E5%90%88%E6%A0%BC%E8%A8%BC+&url=https%3A%2F%2Fdongo.calidokei.com%2F&visibility=public&localOnly=0">
    <img src="img/misskey.png" alt="share-misskey" width="50px" height="50px">
    </a>

    <button onclick="copyUrl()">URLをコピー</button>

    <a href="https://marshmallow-qa.com/ns5xfwmfxfbj3f1?t=Kx2nm0&utm_medium=url_text&utm_source=promotion">マシュマロ</a> <a href="https://wavebox.me/wave/4lz81nai04mnacc5/">Wavebox</a>

<p>ver.1.2 <a href="updatenews.html">管理人＆更新情報</a></p>
<p><a href="https://github.com/calidokei/dongo-certificate">GitHub</a></p>
<p><a href="index.php">https://dongo.calidokei.com/</a> / Master: カリドけい</p>
<p>Copyright&copy;2024-2025 <a href="index.php">どん語検定合格証</a> All Rights Reserved.</p>
<p>このサイトはリンクフリーです。</p>
<p>このサイトはGoogleChrome, Firefoxで動作確認済みです。</p>

<script>
document.getElementById('photoInput').addEventListener('change', function (event) {
    const input = event.target;
    const previewPhoto = document.getElementById('previewPhoto');
    const placeholderText = document.getElementById('placeholderText');
    const nameDisplay = document.getElementById('nameDisplay');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        // 画像が読み込まれたらプレビュー表示をする
        reader.onload = function (e) {
            previewPhoto.src = e.target.result;
            previewPhoto.style.display = 'block'; // プレビュー画像を表示
            placeholderText.style.display = 'none'; // プレースホルダを非表示
        };

        // エラーが発生した場合
        previewPhoto.onerror = function () {
            previewPhoto.style.display = 'none'; // 破れたアイコンを非表示
            placeholderText.style.display = 'block'; // プレースホルダを再表示
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // ファイルが選択されていない場合
        previewPhoto.style.display = 'none';
        placeholderText.style.display = 'block';
    }
});
</script>

<script>
    function copyUrl() {
    const element = document.createElement('input');
    element.value = location.href;
    document.body.appendChild(element);
    element.select();
    document.execCommand('copy');
    document.body.removeChild(element);
}
</script>
</body>
</html>
