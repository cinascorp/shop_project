<?php
session_start();
if(isset($_SESSION['userid'])){
    header("location:index.php");
    die();
}
$msg="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    
</head>
<body>
    <?php
        include "includes/header.php";
        include "model/connection.php";
        if (isset($_POST['submit'])){
            if (empty($_POST["username"]) or empty($_POST["password"])){
                $msg="please fill all the blanks!";
            }
            else{
                $user=$_POST['username'];
                $pass=$_POST['password'];
                $sql="SELECT * FROM users WHERE username='$user' AND password='$pass'";
                $result=$mysql->query($sql);
                if ($result->num_rows>0){
                    $row=$result->fetch_assoc();
                    $id=$row['id'];
                    $_SESSION['userid']=$id;
                    header("location:index.php");
                    die();
                }else{
                    $msg="wrong username or password!";
                }
            }
        }
    ?>
    <form class="login-form" action="#" method="post">
        <label for="user">username: </label>
        <input type="text" name="username" id="user"><br>
        <label for="pass">password: </label>
        <input type="password" name="password" id="pass"><br>
        <input type="submit" value="Login" name="submit">
    </form>
    <p style="color:red;text-align:center"> <?php  echo $msg;    ?></p>
        <!-- Bootstrap JS -->
        <?php include "includes/footer.php"; ?>
</body>
</html>