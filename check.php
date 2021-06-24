<?php
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $content = htmlspecialchars($_POST['content']);

    // ちゃんと文字が入力されているかチェック
    if ($nickname == '') {
        $nickname_result = 'ニックネームが入力されていません。';
    } else {
        $nickname_result = 'ようこそ' . $nickname . '様';
    }
    // メールアドレス
    if ($email == '') {
        $email_result = 'メールアドレスが入力されていません。';
    } else {
        $email_result = 'メールアドレス：' . $email;
    }
    // お問い合わせ内容
    if ($content == '') {
        $content_result = 'お問い合わせ内容が入力されていません。';
    } else {
        $content_result = 'お問い合わせ内容：' . $content;
    }
?>

<?php include('header.php'); ?>
<?php include('mainvisual.php'); ?>
<hr color="#a1785c" width="80%" size="1">
<div class="check">
    <h1>入力内容確認</h1>
    <p><?php echo $nickname_result; ?></p>
    <p><?php echo $email_result; ?></p>
    <p><?php echo $content_result; ?></p>
    <form method="POST" action="thanks.php">
        <input type="hidden" name="nickname" value="<?=$nickname?>">
        <input type="hidden" name="email" value="<?=$email?>">
        <input type="hidden" name="content" value="<?=$content?>">
        <input type="button" value="戻る" onclick="history.back()">
        <?php if($nickname != '' && $email != '' && $content != ""): ?>
            <input type="submit" value="OK">
        <?php endif; ?>
    </form>
</div>
    <?php include('footer.php'); ?>