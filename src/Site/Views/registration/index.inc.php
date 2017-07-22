<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" action="/registration" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="reg[name]" placeholder="Name">
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
                        <input type="password" class="form-control" name="reg[password]" placeholder="Password">
                    </div>
                    <?php
                    if (isset($notices['password'])) {
                        echo '<div style="color: red">' . $notices['password'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">RePassword</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="reg[matchingPassword]"
                               placeholder="RePassword">
                    </div>
                    <?php
                    if (isset($notices['matchingPassword'])) {
                        echo '<div style="color: red">' . $notices['matchingPassword'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="avatar" class="col-sm-2 control-label">Load avatar</label>
                    <div class="col-sm-8">
                        <input type="file" id="avatar" name="avatar">
                    </div>
                    <?php
                    if (isset($notices['avatar'])) {
                        echo '<div style="color: red">' . $notices['avatar'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-block" name="submit" value="reg">Sign up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>