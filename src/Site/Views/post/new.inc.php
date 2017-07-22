<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
    <div class="container">
        <h2 class="text-center">Create own post</h2>
        <div class="col-md-12">
            <form class="form-horizontal" enctype="multipart/form-data" action="/post" method="post">
                <div class="form-group">
                    <input type="text" name="post[title]" class="form-control" placeholder="Title">
                    <?php
                    if (isset($notices['title'])) {
                        echo '<div style="color: red">' . $notices['title'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-2">
                            <p class="text-left"">Load picture</p>
                        </div>
                        <div class="col-md-5">
                            <input type="file" id="avatar" name="picture">
                        </div>
                        <?php
                        if (isset($notices['picture'])) {
                            echo '<div style="color: red">' . $notices['avatar'] . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="post[text]" id="post" rows="10"></textarea>
                    <?php
                    if (isset($notices['text'])) {
                        echo '<div style="color: red">' . $notices['text'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" name="submit" value="add" class="btn btn-success btn-block">Create post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>