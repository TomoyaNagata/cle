<?php
session_start();
if(isset($_GET['room'])){
    $room_number=intval($_GET['room']);
}
$name=$_SESSION['name'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $host='localhost:8889';
    $username='root';
    $password='root';
    $database='kadai';
    $db=new mysqli($host,$username,$password,$database);
    if(!$db){
        die($db->error);
    }
    if(isset($_POST['bath'])){ //風呂のボタンが押されたら
        $stmt=$db->prepare('INSERT INTO bath_clean (bathroom,room_number) VALUES (?,?)');
        if(!$stmt){
            die($db->error);
        }
        $stmt->bind_param('si',$name,$room_number);
        $success=$stmt->execute();
        if(!$success){
            die($db->error);
        }
        $_SESSION['bath_room'.$room_number]=$name;
        header('Location: room_table.php');
        exit();
    }elseif(isset($_POST['bed'])){
        $stmt=$db->prepare('insert into bed_clean (bedroom,room_number) values(?,?)');
        if(!$stmt){
            die($db->error);
        }
        $stmt->bind_param('si',$name,$room_number);
        $success=$stmt->execute();
        if(!$success){
            die($db->error);
        }
        $_SESSION['bed_room'.$room_number]=$name;
        header('Location: room_table.php');
        exit();
    }elseif($_POST['check']){
        $stmt=$db->prepare('insert into check_clean (checkroom,room_number) values(?,?)');
        if(!$stmt){
            die($db->error);
        }
        $stmt->bind_param('si',$name,$room_number);
        $success=$stmt->execute();
        if(!$success){
            die($db->error);
        }
        $_SESSION['check_room'.$room_number]=$name;
        header('Location: room_table.php');
        exit();
    }elseif($_POST['back']){
        header('Location: room_table.php');
        exit();   
    }

    if ($_POST['reset']) {
            $_SESSION['bath_room' . $room_number] = "";
            $_SESSION['bed_room' . $room_number] = "";
            $_SESSION['check_room' . $room_number] = "";
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
    <title>チェック</title>
    <link rel="stylesheet" href="../CSS/room_check.css">
</head>
<body>
    <p><?php echo $name; ?></p>
    <form action="" method="post">
        <input type="submit" name="bath" value="風呂">
        <input type="submit" name="bed" value="ベッド">
        <input type="submit" name="check" value="点検">
    </form>
    <form action="" method="post">
    <input type="submit" name="back" value="戻る">
    </form>
</body>
</html>
