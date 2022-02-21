
<?php 
    include "./config.php";

    $page = basename($_SERVER['PHP_SELF']);

    switch($page){
        case "single.php":
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM post where post_id = {$_GET['id']}";
                $title_query = mysqli_query($conn,$sql_title) or die("title show query error");
                $row = mysqli_fetch_assoc($title_query);
                $page_title = $row['title'];
            }else{
                $page_title = "No Post found";
            }
            break;
        case "category.php":
            if(isset($_GET['cat_id'])){
                $sql_title = "SELECT * FROM category where category_id = {$_GET['cat_id']}";
                $title_query = mysqli_query($conn,$sql_title) or die("title show query error");
                $row = mysqli_fetch_assoc($title_query);
                $page_title = $row['category_name'];
            }else{
                $page_title = "No category found";
            }
            break;
        case "author.php":
            if(isset($_GET['auth_id'])){
                $sql_title = "SELECT * FROM user where user_id = {$_GET['auth_id']}";
                $title_query = mysqli_query($conn,$sql_title) or die("title show query error");
                $row = mysqli_fetch_assoc($title_query);
                $page_title = $row['first_name'] . " " . $row['last_name'];
            }else{
                $page_title = "No author found";
            }
            break;
        case "search.php":
            if(isset($_GET['search'])){
                $sql_title = "SELECT * FROM user where user_id = {$_GET['search']}";
                
                $page_title = $_GET['search'];
            }else{
                $page_title = "No search found";
            }
            break;
        default:
        $page_title = "Bangla News Site";
        break;
    }


    $logo_sql = "SELECT * FROM settings";
    $logo_query = mysqli_query($conn,$logo_sql) or die("logo show query faild");
    $logo_image = mysqli_fetch_assoc($logo_query);
    $logo = $logo_image['logo'];
    $footerdesc = $logo_image['footerdesc'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- <title>Bangla News |</title> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="<?php echo $hostname; ?>/admin/images/<?php echo $logo; ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <?php
                        include "./config.php";                            

                        if(isset($_GET['cat_id'])){
                            $catid = $_GET['cat_id'];
                            $home_active = "";
                        }else{
                            $home_active = "active";
                            $catid = 0;
                        }

                        echo "<li><a class='{$home_active}' href='{$hostname}'>Home</a></li>";

                        $sql = "SELECT * FROM category where category.post > 0";

                        $query = mysqli_query($conn,$sql) or die("categoyr select Error in category.php file");

                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_assoc($query)){
                                if($row['category_id'] == $catid ){
                                    $active = "active";
                                }else{
                                    $active = "";
                                }
                                
                                echo "<li><a href='category.php?cat_id={$row['category_id']}' class='{$active}'>{$row['category_name']}</a></li>";
                            }
                        }
                        mysqli_close($conn);
                    ?>
                    <!-- <li><a href='category.php'>Business</a></li>
                    <li><a href='category.php'>Entertainment</a></li>
                    <li><a href='category.php'>Sports</a></li>
                    <li><a href='category.php'>Politics</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
