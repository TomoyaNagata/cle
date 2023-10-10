<?php
session_start();
$name=$_SESSION['name'];
$id=$_SESSION['id']; //従業員コード
if($_SERVER['REQUEST_METHOD']){
    if($_POST['back']){
        unset($name);
        unset($id);
        header('Location:../index.php');
        exit();
    }
    if (isset($_POST['reset'])) {
            // リセットボタンが押された場合、セッション変数を初期化
            for ($room = 1; $room < 31; $room++) {
                $_SESSION['bath_room' . $room] = "";
                $_SESSION['bed_room' . $room] = "";
                $_SESSION['check_room' . $room] = "";
            }
            header('Location: room_table.php');
            exit();
        }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部屋</title>
    <link rel="stylesheet" href=" ../CSS/room_table.css">
</head>
<body>
    <p><?php echo $name; ?></p>
    <table border="">
    <tr>
        <td>No,</td><td>風呂</td><td>ベッド</td><td>点検</td>
    </tr>
    <?php for($room=1;$room<31;$room++) :?>
    <tr>
      <td><a href="room_check.php?room=<?php echo $room; ?>"><?php echo $room; ?></a></td>
      <td><?php echo $_SESSION['bath_room'.$room]; ?></td>
      <td><?php echo $_SESSION['bed_room'.$room]; ?></td>
      <td><?php echo $_SESSION['check_room'.$room]; ?></td>
    </tr>
    <?php endfor; ?>
<form action="" method="post">
    <input type="submit" name="reset" value="リセット">
    <input type="submit" name="back" value="ログアウト">
</form>
<form action="../generate_pdf.php" method="post">
    <input type="submit" name="download_pdf" value="PDFでダウンロード">
</form>

</body>
</html>