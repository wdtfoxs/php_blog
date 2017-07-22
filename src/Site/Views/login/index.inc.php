<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" action="/login" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <?php
                    if (isset($notices['name'])) {
                        echo '<div style="color: red">' . $notices['name'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <?php
                    if (isset($notices['password'])) {
                        echo '<div style="color: red">' . $notices['password'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-block" name="submit" value="login">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>