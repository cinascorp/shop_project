<?php
session_start();
include "model/connection.php";
$sql = "SELECT id, pname, image FROM products";
$result = $mysql->query($sql);
?>
<html>
<head>
    <title>Document</title>
        <!-- Bootstrap CSS -->
</head>
<body>
    <?php include "includes/header.php"; ?>
    <br>
    <div class="container">
        <h2>Product List</h2>
        <br>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 mb-3">
                <a href="details.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['image']; ?>" alt="" class="img-fluid">
                </a>
                <p><?php echo $row['pname']; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <?php include "includes/footer.php"; ?>
</body>
</html>
