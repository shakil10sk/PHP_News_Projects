<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>
                <?php 
                    if(isset($footerdesc)){
                        echo $footerdesc;
                    }else{
                        echo '© Copyright 2019 News | Powered by <a href="http://yahoobaba.net/">Yahoo Baba</a>';
                    }
                ?>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
