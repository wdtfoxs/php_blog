<?php include_once SITE_PATH . "/Views/inc/header.inc.php" ?>
<script>
    jQuery(function($) {
        var items = $('.post');

        var numItems = items.length;
        var perPage = 2;

        items.slice(perPage).hide();

        $('#pagination-page').pagination({
            items: numItems,
            itemsOnPage: perPage,
            cssStyle: 'dark-theme',

            onPageClick: function(pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;

                items.hide().slice(showFrom, showTo).show();
            }
        });
        function checkFragment() {
            var hash = window.location.hash || "#page-1";
            hash = hash.match(/^#page-(\d+)$/);

            if(hash) {
                $("#pagination-page").pagination("selectPage", parseInt(hash[1]));
            }
        }
        $(window).bind("popstate", checkFragment());
        checkFragment();
    });
</script>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-4">
                <div id="pagination-page" class="pagination"></div>
            </div>
        </div>
        <div class="col-md-offset-1 col-md-10">
            <?php
            foreach ($posts as $post) {
                echo '
                       <div class="post">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="/post/show/'.$post->getId().'"><img src="'.$post->getPicture().'" class="img-thumbnail big_pic"></a>
                            </div>
                            <div class="col-md-8 post_body">
                                <div class="row">
                                    <div class="col-md-12">
                                       <h2 class="text-center"><a class="title_a" href="/post/show/'.$post->getId().'">'.$post->getTitle().'</a></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>'.$post->getText().'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row footer">
                            <div class="col-md-offset-9 col-md-3">
                                <p class="text-right">published at '.$post->getDate().' by <a class="title_a" href="/user/show/'.$post->getUser()['id'].'">'.$post->getUser()['name'].'</a></p>
                            </div>
                        </div>
                    </div>
                    ';
            }
            ?>
        </div>
    </div>
<?php include_once SITE_PATH . "/Views/inc/footer.inc.php" ?>