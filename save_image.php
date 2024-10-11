<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 入力情報を取得
    $name = htmlspecialchars($_POST['name']);
    $level = htmlspecialchars($_POST['level']);
    $listeningScore = htmlspecialchars($_POST['listeningScore']);
    $speakingScore = htmlspecialchars($_POST['speakingScore']);
    $fillScore = (int)$_POST['fillScore'];
    $summaryScore = (int)$_POST['summaryScore'];
    $essayScore = (int)$_POST['essayScore'];
    $totalScore = $listeningScore + $speakingScore + $fillScore + $summaryScore + $essayScore;

    // アップロードされた証明写真のパス
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $photoPath = $uploadDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);

    // 画像を生成
    $imgWidth = 800;
    $imgHeight = 600;
    $img = imagecreatetruecolor($imgWidth, $imgHeight);
    $bgColor = imagecolorallocate($img, 255, 255, 255); // 白背景
    imagefill($img, 0, 0, $bgColor);

    $textColor = imagecolorallocate($img, 0, 0, 0);
    $font = __DIR__ . '/Zen_Maru_Gothic/ZenMaruGothic-Medium.ttf'; // フォントファイルのパスを正しく指定

    // フォントが存在するか確認
    if (!file_exists($font)) {
        echo 'Font file not found: ' . $font; // フォントのパスを表示
        exit;
    }

    // 大枠の色
    $borderColor = imagecolorallocate($img, 0, 0, 0); // 黒色の枠線

    // 大枠を描画
    imagerectangle($img, 10, 10, $imgWidth - 10, $imgHeight - 10, $borderColor);

    // 証書のヘッダー
    imagettftext($img, 24, 0, 250, 50, $textColor, $font, 'どん語検定合格証');

    // 名前と証明写真の配置
    imagettftext($img, 20, 0, 50, 150, $textColor, $font, "名前: $name");

    // 証明写真をリサイズして配置
    $photo = imagecreatefromstring(file_get_contents($photoPath));
    if ($photo === false) {
        echo 'Failed to create image from uploaded photo.';
        exit;
    }
    $photoResized = imagescale($photo, 100, 100);
    imagecopy($img, $photoResized, 600, 100, 0, 0, 100, 100);

    // 各項目のy座標を調整
    $y = 250; // 初期位置

    // 合格級を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "合格級: $level");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 次の項目の位置を下げる

    // リスニング問題点数を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "リスニング問題点数: $listeningScore");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 次の項目の位置を下げる

    // リスニング問題点数を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "スピーキング問題点数: $speakingScore");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 次の項目の位置を下げる

    // 穴埋め問題点数を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "穴埋め問題点数: $fillScore");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 次の項目の位置を下げる

    // 要約問題点数を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "要約問題点数: $summaryScore");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 次の項目の位置を下げる

    // 自由作文点数を出力
    imagettftext($img, 20, 0, 50, $y, $textColor, $font, "自由作文点数: $essayScore");
    imageline($img, 50, $y + 10, 750, $y + 10, $textColor);
    $y += 40; // 合計点数の位置を下げる

    // 合計点数を大きく表示
    imagettftext($img, 28, 0, 50, $y, imagecolorallocate($img, 217, 83, 79), $font, "合計点数: $totalScore");

    // バッファをクリア
    ob_clean();
    ob_end_clean();

    // ヘッダーを設定して画像を出力
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="certificate_' . $name . '.jpg"');

    // 画像を出力
    imagejpeg($img);
    imagedestroy($img);
    imagedestroy($photoResized);
}
