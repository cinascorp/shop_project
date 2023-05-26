<?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        header("location:login.php");
        die();
    }
    include "model/connection.php";

    $pid = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$pid' ";
    $result = $mysql->query($sql);
    $row = $result->fetch_assoc();

    $error_msg = "";
    if (isset($_POST['submit'])) {
        if (empty($_POST['qnt1']))
            $error_msg = "Please input the quantity!";
        else if ($row['qnt'] < $_POST['qnt1']) {
            $error_msg = "Not enough products!";
        } else {
            $userid = $_SESSION['userid'];
            $new_qnt = $row['qnt'] - $_POST['qnt1'];
            $sql = "UPDATE products SET qnt='$new_qnt' WHERE id='$pid' ";
            $mysql->query($sql);

            $sql = "SELECT * FROM cart WHERE pid='$pid'";
            $result = $mysql->query($sql);
            $qnt3 = $_POST['qnt1'];
            if ($result->num_rows > 0) {
                $row2 = $result->fetch_assoc();
                $qnt_main_cart = $row2['qnt'];
                $new_qnt_cart = $qnt_main_cart + $qnt3;
                $sql = "UPDATE cart SET qnt='$new_qnt_cart' WHERE pid='$pid'";
                $mysql->query($sql);
            } else {
                $sql = "INSERT INTO cart (uid, pid, qnt) VALUES ('$userid', '$pid', '$qnt3')";
                $mysql->query($sql);
            }

            header("location:cart.php");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- Bootstrap CSS -->
</head>
<body>
    <?php include "includes/header.php"; ?>
     <img src="<?php echo $row['image']; ?>" alt="" width="400px" height="400px">
     <br>
     <p>Product name: <b><?php echo $row['pname']; ?></b></p>
     <p>Quantity: <?php echo $row['qnt']; ?></p>
     <p>Price: <?php echo $row['price']; ?></p>

     <form action="#" method="post" class="detail-form">
        <label for="qnt">Quantity</label>
        <input type="text" id="qnt" name="qnt1">
        <input type="submit" name="submit" value="Order Now!">
     </form>    
     <?php echo $error_msg; ?>
     
    <!-- Bootstrap JS -->
    <?php include "includes/footer.php"; ?>
</body>
</html>
