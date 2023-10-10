<?php
session_start();
$error='';
if($_SERVER['REQUEST_METHOD']==="POST"){
    $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    $db=new mysqli('localhost:8889','root','root','kadai');
    if(!$db){
        die($db->error);
    }
    $stmt=$db->prepare('select member_name,member_id from members where member_id=? limit 1');
    if(!$stmt){
        die($db->error);
    }
    $stmt->bind_param('i',$id);
    $success=$stmt->execute();
    if(!$success){
        die($db->error);
    }
    $stmt->bind_result($member_name,$member_id);
    $stmt->fetch();
    if((int)$id===$member_id){
        $_SESSION['name']=$member_name;
        $_SESSION['id']=$member_id;
        header('Location: room/room_table.php');
        exit();
    }
    else{
        $error='login_error';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <form action="" method="post">
        <p>従業員コード</p>
        <input type="text" name="id" >
        <?php if($error==='login_error'): ?>
        <p>*従業員コードが一致しません</p>
        <?php endif; ?>
        <input type="submit" name="submit_login" value="ログイン">
    </form>
</body>
</html>