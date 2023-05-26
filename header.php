<?php
if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $sql = "SELECT fname FROM users WHERE id='$id'";
    $result_header = $mysql->query($sql);
    $row_header = $result_header->fetch_assoc();
    $name = $row_header['fname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Project</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

</head>
<body>

<div class="header">
    <h1 class="display-4">Shop Project</h1>
        <div class="login-sec">
        <?php if (isset($_SESSION['userid'])): ?>
            <a href="logout.php" class="btn btn-primary">Logout</a>
            <?php echo $name; ?>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary">Products</a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

</body>
</html>
