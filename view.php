<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ一覧</title>
</head>
<body>
    <form action="" method="POST">
        <p>検索したい文字を入力してください。</p>
        <input type="text" name="text">
        <input type="submit" value="検索">
    </form>
</body>
</html>




<?php
    // isset():undefinedかどうかチェック　undefinedとは無い関数から取ろうとした。中身のないものから取ろうとした。変数が存在しているかどうか
    if (isset($_POST['text'])) { // isset の反対は empty{}
        $text = $_POST['text'];
    } else {
        $text = "";
    }

    // $text = $_POST['text'];


    //データベースへ接続する
    $dsn = 'mysql:dbname=phpkiso;host=localhost'; // データソースネーム
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password); // dbhとはデータベースハンドラー
    $dbh->query('SET NAMES UTF8');

    //SQL文を実行する
    $sql = 'SELECT * FROM `survru`'; // お問い合わせの内容を全部SELECTするSQL文 {このアスタリスクが全部という意味} 
    // SELECT * FROM `survey` WHERE `content` LIKE "%入力値($text)%"
    $sql = 'SELECT * FROM `survru` WHERE `nickname` LIKE ?';
    // これは上の文を作るときの参考　INSERT INTO `survru`(`nickname`, `emainl`, `content`) VALUES ("misuzu","aaa","aaa")
    $data[] = '%'.$text.'%';
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data); // ->これの意味は、誰々さん→○○してください

    //データベースを切断する
    $dbh = null;

    // $rec = $stmt->fetch(PDO::FETCH_ASSOC); // 実行結果を１行ずつ配列形式で取り出す
    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){ // fetch １つづず取り出す
        echo $rec['code'].'<br>';
        echo $rec['nickname'].'<br>';
        echo $rec['emainl'].'<br>';
        echo $rec['content'].'<br>';
        echo '<hr>'; // <hr>はただの棒線の意味
    }

?>