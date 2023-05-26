<?php
    session_start();
    if (!isset($_SESSION['userid'])){
        header("location:login.php");
        die();
    }
    include "model/connection.php";
    if (isset($_POST['delete'])){
        $pid=$_POST['pid'];
        $sql="DELETE FROM cart WHERE pid='$pid' ";
        $mysql->query($sql);

        $sql="SELECT qnt FROM products WHERE id='$pid' ";
        $result=$mysql->query($sql);
        $row=$result->fetch_assoc();

        $min_qnt=$row['qnt'];
        $qnt=$_POST['old_qnt'];
        $final_qnt=$min_qnt+$qnt;

        $sql="UPDATE products SET qnt='$final_qnt' WHERE id='$pid'";
        $mysql->query($sql);
    }
    $userid=$_SESSION['userid'];
    $sql="SELECT products.pname,products.brand,products.price,cart.qnt,cart.pid
    FROM cart INNER JOIN products ON cart.pid=products.id 
    WHERE cart.uid='$userid' ";
    $result=$mysql->query($sql);
?>
<html>
<head>
<title>Document</title>
 <!-- Bootstrap CSS -->
</head>
<body>
    <div>
    <?php include "includes/header.php"; ?>
    <?php
        $row=$result->fetch_assoc();
        $ebox=0;
        while($row){
            $ebox+=($row['price'] * $row['qnt']);
    ?>
        <p>Product name: <?php echo $row['pname']; ?></p>
        <p>Product brand: <?php echo $row['brand']; ?></p>
        <p>Product price: <?php echo $row['price']; ?></p>
        <p>Product quantity: <?php echo $row['qnt']; ?></p>
        <form action="#" method="post">
            <input type="submit" value="Delete" name="delete">
            <input type="submit" value="Edit" name="edit">
         
            <input type="text" name="new_qnt" id="">
            <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
            <input type="hidden" name="old_qnt" value="<?php echo $row['qnt']; ?>">
        </form>
        <hr>
    <?php
        $row=$result->fetch_assoc();
    }
    ?>

    <h2>Total price: <?php echo $ebox; ?></h2>
    <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Continue Shopping</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='payment.php'">Payment</button>
    </div>
    <!-- Bootstrap JS -->
    <?php include "includes/footer.php"; ?>
</body>
</html>
