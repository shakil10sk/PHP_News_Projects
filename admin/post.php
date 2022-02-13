<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $limit = 3;
                        $offset = ($page - 1) * $limit;

                        $sql = "SELECT * FROM post
                                LEFT JOIN category ON category.category_id = post.category
                                LEFT JOIN user ON user.user_id = post.author
                                ORDER BY post_id desc LIMIT {$offset},{$limit}";

                        $query  = mysqli_query($conn, $sql) or die("User data fetch query error");
                        if (mysqli_num_rows($query) > 0) {
                            $count = 0 + $offset;
                            while ($row = mysqli_fetch_assoc($query)) {

                        ?>
                                <tr>
                                    <td class='id'><?php echo ++$count; ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php echo $row['post_date']; ?></td>
                                    <td><?php echo $row['first_name'] . $row['last_name']; ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<p style='color:red;text-align: center;margin: 10px 0;'>No Data Exists. Please try Again</p>";
                        }

                        ?>
                    </tbody>
                </table>
                <?php
                $sql_page = "SELECT * FROM post";

                $page_result = mysqli_query($conn, $sql_page) or die("total Page count sql querry error");

                $total_rows = mysqli_num_rows($page_result);

                if ($total_rows > 0) {
                    $total_page = ceil($total_rows / $limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="post.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                        $active = $i == $page ? "active" : "";
                        echo "<li class='" . $active . "'><a href='post.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    if ($total_page > $page) {

                        echo '<li><a href="post.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
                <!-- <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>