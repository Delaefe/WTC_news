<?php
include ("navbar.php");
?>

<main>
    <?php
    include("header.php");
    include("menu.php");
    ?>

    <script src="../jscript/home.js"></script>
    <script>
        $(document).ready(function () {



            $(".like-btn").click(function (e) {


                e.preventDefault();
<?php if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { ?>

                    id = $(this).attr("id");

                    id_counter = $(this).children("p").html();

                    if ($(this).hasClass("liked")) {
                        id_counter--;
                        $(this).children("p").html(id_counter);
                    } else {
                        id_counter++;
                        $(this).children("p").html(id_counter);
                    }

                    var xmlhttp = new XMLHttpRequest();

                    $(this).toggleClass("liked");
                    if (id.substring(0, 1) == 'a') {
                        id = id.substring(1);
                    }

                    xmlhttp.open("GET", "<?php echo $role; ?>?action=like&new_id=" + id, true);
                    xmlhttp.send();
<?php } ?>



            });
        });
    </script>




    <div class="container">

        <?php if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { ?>
            <div class="form-group">
                <div class="row-fluid">
                    <div class="span12 add-article-button">
                        <form action="<?php echo $role; ?>" method="POST">
                            <input type="hidden" name="action" value="add_article_form">
                            <input class='send btn-submit' type="submit" value="SEND ARTICLE">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($news as $article) { ?>

            <div  class="row-fluid articles">

                <div class="span11 article article--m">
                    <span class="avatar avatar--m">

                        <img width="30px" height="30px" src="../images/News/<?php echo $article['img']; ?>" alt="photo" >

                    </span>

                    <header class="header article-header">
                        <h1>
                            <a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $article['newId']; ?>" name = "new_id" > <?php echo $article['title']; ?></a>
                        </h1>				
                    </header>


                    <div class="article-body">
                        <div class="article-description">
                            <p><?php echo $article['description']; ?></p>
                        </div>
                    </div>

                    <div class="article-footer">
                        <p style="float: left; margin-left: 10px;"><a href="" class="fa fa-comment"> <?php echo count(get_comments_for_article($article['newId'])); ?></a></p>
                        <p><?php echo $article['date']; ?> | <a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $article['author']; ?>" name="author"><?php
                                echo
                                $article['author'];
                                ?></a></p>

                    </div>

                    <span class="box-aside box-aside--m">
                        <span class="box-views">
                            <p class="views-count"><?php echo $article['views']; ?></p>
                            <p class="views">views</p>
                        </span>

                        <?php
                        if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") {
                            if (check_like($article['newId'], $_SESSION['login_user'])['status'] == 1) {
                                $liked = "liked";
                            } else {
                                $liked = "";
                            }
                        }
                        ?>

                        <span class="box-like">
                            <span id ="a<?php echo $article['newId']; ?>" class="like-btn <?php echo $liked; ?>" >&#10084; <p class="like-counter"><?php echo $article['likes']; ?></p>
                            </span>

                        </span>
                    </span>
                </div>


            </div> <br>
        <?php } ?>
    </div>


</main>
<?php
include("../view/footer.php");
?>
