<?php
include "config.php";
session_start();
if (isset($_SESSION['username'])) {
    header("Location: {$hostname}/post.php");
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                    <?php
                    include "config.php";
                    if (isset($_POST['login'])) {
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

                        $sql = "SELECT user_id,username,role FROM user where username = '{$username}' and password = '{$password}'";
                        $query = mysqli_query($conn, $sql) or die("sql error to check username password");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                // if (!isset($_SESSION)) {
                                session_start();
                                // }
                                // else {
                                //     session_destroy();
                                //     session_start();
                                // }
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['role_id'] = $row['role'];

                                header("Location: {$hostname}/post.php");
                            }
                        } else {
                            echo "<p class='text-danger'> your user name and password did't match</p>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>