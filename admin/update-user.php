<?php include "header.php"; ?>
<?php
if (isset($_POST['submit'])) {
    include "config.php";

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($fname == '' && $user == '') {
        echo "<p style='color:red;text-align: center;margin: 10px 0;'>Please give us Your valid Information</p>";
        die();
    } else {
        $sql = "UPDATE user SET first_name = '{$fname}',last_name = '{$lname}',username = '{$user}',role = '{$role}' WHERE user_id = $user_id";

        $query = mysqli_query($conn, $sql) or die("update User Sql Query Error");

        if ($query) {
            header("Location: {$hostname}/users.php");
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                include "config.php";
                $id = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id = $id";
                $query = mysqli_query($conn, $sql) or die("Edit User Query Error");
                if (mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_assoc($query)) {
                ?>
                        <!-- Form Start -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $result['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $result['first_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $result['last_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $result['username']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role">
                                    <option value="0" <?php echo $result['role'] == 0 ?? "selected" ?>>normal User</option>
                                    <option value="1" <?php echo $result['role'] == 1 ?? "selected"; ?>>Admin User</option>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                }
                mysqli_close($conn);
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>