<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
    <div class="container">
        <div class="col-md-12">
            <?php
            if (!is_null($user->getId())){ ?>
                       <div class="post">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo $user->getAvatar() ?>" class="img-thumbnail big_pic">
                                <h2 class="text-center"><?php echo $user->getName() ?></h2>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h2 class="text-center"><?php echo $user->getName() ?>'s posts</h2>
                                        <?php foreach ($user->getPosts() as $post){ ?>
                                                <div class="post">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a class="title_a" href="/post/show/<?php echo $post->getId() ?>"><img src="<?php echo $post->getPicture() ?>" class="img-thumbnail small_pic"></a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3 class="text-center"><a class="title_a" href="/post/show/<?php echo $post->getId() ?>"><?php echo $post->getTitle() ?></a></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p><?php echo $post->getText() ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php } else{
                echo '<h1 class="text-center">User not found</h1>';
            }
            ?>
        </div>
    </div>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>