<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                        include "./config.php";
                        
                        if(isset($_GET['search'])){
                            $search_term = mysqli_real_escape_string($conn,$_GET['search']);

                        }
                        
                        if(empty($search_term)){
                            header("Location: {$hostname}/index.php");
                            session_start();
                            $_SESSION['error'] = "<h1 class='text-danger'>No Search Item Given..</h1>";
                            echo "<h1 class='text-danger'>No Search Item Given..</h1>";
                        }
                        
                            echo "<h2 class='page-heading'>Search : {$search_term}</h2>";

                            if (isset($_GET['page'])) {
                                $page = ($_GET['page'] > 0) ? $_GET['page'] : 1;
                            } else {
                                $page = 1;
                            }

                            $limit = 3;
                            $offset = ($page - 1) * $limit;

                            $sql = "SELECT post.post_id,post.title,post.description,category.category_name,
                                        concat(user.first_name,' ',user.last_name) as name,post.post_img ,post.post_date,post.author,post.category
                                            FROM post
                                                LEFT JOIN category ON category.category_id = post.category
                                                LEFT JOIN user ON user.user_id = post.author
                                                    Where post.title LIKE '%{$search_term}%'
                                                    OR post.description LIKE '%{$search_term}%'
                                                    ORDER BY post_id desc LIMIT {$offset},{$limit}";

                            $query  = mysqli_query($conn, $sql) or die("User data fetch query error");

                            if (mysqli_num_rows($query) > 0) {
                                    $count = 0 + $offset;
                                    while ($row = mysqli_fetch_assoc($query)) {    
                            
                    ?>  
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="<?php echo $hostname; ?>/admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo $row['title'];  ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cat_id=<?php echo $row['category'] ?>'><?php echo $row['category_name']?></a>
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
                                    <p class="description">
                                    <?php echo substr($row['description'],0,150) . "..." ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                        <?php
                                }
                            }else{
                                echo "<h1 class='text-danger'>No Data Found</h1>";
                            }
                    
                            $sql_page = "SELECT * FROM post 
                                            WHERE post.title LIKE '%{$search_term}%'
                                            OR post.description LIKE '%{$search_term}%'";

                            $page_result = mysqli_query($conn, $sql_page) or die("total Page count sql querry error");

                            $total_rows = mysqli_num_rows($page_result);
                            
                            if ( $total_rows > 0) {

                                $total_page = ceil($total_rows / $limit);

                                echo "<ul class='pagination'>";
                                if ($page > 1) {
                                    $prev_page = $page - 1;
                                    echo "<li><a href='search.php?search={$search_term}&page={$prev_page}'>Prev</a></li>";
                                }

                                for ($i = 1; $i <= $total_page; $i++) {
                                    $active = $i == $page ? "active" : "";
                                    echo "<li class='{$active}'><a href='search.php?search={$search_term}&page={$i}'>{$i}</a></li>";
                                }
                                if ($total_page > $page) {
                                    $next_page = $page + 1;

                                    echo "<li><a href='search.php?search={$search_term}&page={$next_page}'>Next</a></li>";
                                }
                                echo "</ul>";
                            }
                        ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
