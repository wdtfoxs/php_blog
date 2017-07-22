<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($post->getId())) {
                    echo '<script src="/resources/js/posts.js" type="application/javascript"></script>';
                    ?>
                    <div class="post">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?php echo $post->getPicture() ?>" class="img-thumbnail big_pic">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="text-center"><?php echo $post->getTitle() ?></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><?php echo $post->getText() ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row footer">
                            <div class="col-md-offset-9 col-md-3">
                                <p class="text-right">published at <?php echo $post->getDate() ?> by
                                    <a class="title_a" href="/user/show/<?php echo $post->getUser()['id'] ?>"><?php echo $post->getUser()['name'] ?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <p class="bg-primary text-center dev_count_comment">Комментариев: <?php echo $counts ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-white post panel-shadow">
                                    <div class="post-footer">
                                        <form action="/comment/create" method="post">
                                            <div class="input-group">
                                                <input class="form-control input-lg" name="text" placeholder="Add a comment"
                                                       type="text">
                                                <input hidden name="post_id" value="<?php echo $post->getId() ?>">
                                                <input hidden name="parent_id" value="">
                                                <span class="input-group-addon"><button type="submit" class="btn btn-primary btn-sm"
                                                                                        name="submit"
                                                                                        value="send">Send</button></span>
                                            </div>
                                        </form>
                                        <div class="dev_comments">
                                            <?php printComments($post->getComments()) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<h1 class="text-center">Post not found</h1>';
                }
                ?>
            </div>
        </div>
    </div>
<?php
function printComments($comments)
{
    foreach ($comments as $comment) { ?>
        <ul class="comments-list">
            <li class="comment">
                <a class="pull-left" href="/user/show/<?php echo $comment['u_id'] ?>">
                    <img class="avatar" src="<?php echo $comment['u_avatar'] ?>"
                         alt="avatar">
                </a>
                <div class="comment-body">
                    <div class="comment-heading">
                        <h4 class="user"><?php echo $comment['u_name'] ?></h4>
                        <h5 class="time"><?php echo $comment['c_date'] ?></h5>
                        <h5 class="time dev_comment" comment-id="<?php echo $comment['c_id'] ?>" comment-name="<?php echo $comment['u_name'] ?>"><a class="answer">Ответить</a></h5>

                    </div>
                    <p><?php echo $comment['c_text'] ?></p>
                </div>
                <?php if (!empty($comment['children'])) {
                    printComments($comment['children']);
                } ?>
            </li>
        </ul>
    <?php }
}

?>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>