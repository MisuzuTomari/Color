<?php 
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $content = htmlspecialchars($_POST['content']);


    // ここから
    //データベースへ接続する
    $dsn = 'mysql:dbname=phpkiso;host=localhost'; // データソースネームは毎回変える
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password); // dbhとはデータベースハンドラー
    $dbh->query('SET NAMES UTF8');

    //SQL文を実行する　命令文作る→準備してね→実行してね
    // $sql = 'INSERT INTO `survru`(`nickname`, `emainl`, `content`) VALUES ("'.$nickname.'","'.$email.'","'.$content.'")';
    $sql = 'INSERT INTO `survru`(`nickname`, `emainl`, `content`) VALUES (?,?,?)';
    // これは上の文を作るときの参考　INSERT INTO `survru`(`nickname`, `emainl`, `content`) VALUES ("misuzu","aaa","aaa")
    $data = [$nickname, $email, $content]; //ハテナにするならこの行が必要。はてなの数だけ指定が必要。
    $stmt = $dbh->prepare($sql);
    // $stmt->execute();
    $stmt->execute($data); // ハテナにするなら（）のなかに関数を指定する。

    //データベースを切断する
    $dbh = null;
    
    // ここまでは覚える
?>

<?php include('header.php'); ?>
<?php include('mainvisual.php'); ?>

<div class="thanks">
<hr color="#a1785c" width="80%" size="1">
    <h1>お問い合わせありがとうございました！</h1>
    <div>
        <h3>お問い合わせ詳細内容</h3>
        <p>ニックネーム：<?=$nickname?></p>
        <p>メールアドレス：<?=$email?></p>
        <p>お問い合わせ内容：<?=$content?></p>
    </div>
</div>   
<?php include('footer.php'); ?>