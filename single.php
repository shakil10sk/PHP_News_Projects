<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  <?php
                  include "./config.php";

                    if (isset($_GET['id'])) {
                        $post_id = $_GET['id'];
                    }else{
                        header("Location: {$hostname}/"); 
                    }

                    $sql = "SELECT post.post_id,post.title,post.description,category.category_name,
                                concat(user.first_name,' ',user.last_name) as name,post.post_img ,post.post_date,post.category,post.author
                                    FROM post
                                        LEFT JOIN category ON category.category_id = post.category
                                        LEFT JOIN user ON user.user_id = post.author
                                            where post.post_id = {$post_id}";

                    $query  = mysqli_query($conn, $sql) or die("User data fetch query error");

                    if (mysqli_num_rows($query) > 0) {
                        
                        while ($row = mysqli_fetch_assoc($query)) {   
                    ?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cat_id=<?php echo $row['category'] ?>'><?php echo $row['category_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?auth_id=<?php echo $row['author']; ?>'><?php echo $row['name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="./admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                            <?php echo $row['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                        }
                    }else{
                        echo "<h1 class='text-danger'>No Data Fount</h1>";
                    }
                    ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
