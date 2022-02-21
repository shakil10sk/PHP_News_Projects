<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>       
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>       
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
            include "./config.php";

            $limit = 3;

            $sql = "SELECT post.post_id,post.title,post.description,category.category_name,
                        post.post_img, post.post_date,post.category,post.author
                            FROM post
                                LEFT JOIN category ON category.category_id = post.category                                
                                    ORDER BY post_id DESC LIMIT {$limit}";

            $query  = mysqli_query($conn, $sql) or die("User data fetch query error");

            if (mysqli_num_rows($query) > 0) {               

                while ($row = mysqli_fetch_assoc($query)) {    
                    ?>
                    <div class="recent-post">
                        <a class="post-img" href="">
                            <img src="<?php echo $hostname; ?>/admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                        </a>
                        <div class="post-content">
                            <h5><a href="single.php?id=<?php echo $row['post_id'];?>"><?php  echo $row['title']; ?></a></h5>
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href='category.php?cat_id=<?php echo $row['category'] ?>'><?php echo $row['category_name']; ?></a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo $row['post_date']; ?>
                            </span>
                            <a class="read-more" href="single.php?id=<?php echo $row['post_id'];?>">read more</a>
                        </div>
                    </div>
                    <?php
        
                }
            }else{
                echo "<h1 class='text-danger'>No Data Fount</h1>";
            }
        ?>

    </div>
    <!-- /recent posts box -->
</div>
