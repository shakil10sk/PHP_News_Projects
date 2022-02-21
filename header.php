
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
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
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
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

                        echo "<li><a class='{$home_active}' href='{$hostname}/index.php'>Home</a></li>";

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
