<?php 
include "header.php";
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                    <!-- Form for show edit-->
<?php
    include "config.php";
    // if(isset($_GET['id'])){
        $id =  $_GET['id'];
        $sql = "SELECT * FROM post WHERE post.post_id = {$id}";

        $query1 = mysqli_query($conn,$sql) or die("Sql Query Error");
           
            $val =  mysqli_fetch_assoc($query1);
?>
                    <div class="for m-group">
                        <input type="hidden" name="post_id" class="form-control" value="<?php echo $val['post_id']; ?>"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                            value="<?php echo $val['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" id="summernote" class="form-control" required rows="5">
                            <?php echo trim($val['description']," "); ?>
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <option disabled> Select Category</option>
                            <?php

                                $selectSql = "SELECT category_name,category_id FROM category";
                                $selectQuery = mysqli_query($conn, $selectSql) or die("Select category Sql error");

                                if (mysqli_num_rows($selectQuery) > 0) {
                                    while ($selectrow = mysqli_fetch_assoc($selectQuery)) {
                                        $selected = '';
                                        if($val['category'] == $selectrow['category_id']){
                                            $selected = "selected";
                                        }
                                        echo "<option {$selected} value='" . $selectrow['category_id'] . "'> " . $selectrow['category_name'] . " </option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new-image">
                        <img src="upload/<?php echo $val['post_img']; ?>" height="150px">
                        <input type="hidden" name="old_image" value="<?php echo $val['post_img']; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
<?php
include "footer.php"; 
?>