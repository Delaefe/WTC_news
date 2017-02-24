<?php
include ("navbar.php");

$comment_number = 0;
?>

<script>

    $(document).ready(function () {
        $("#related-article").slideDown(800);
        $("#stadisctics-count").fadeIn(1000);

        });</script>

    <main class="article-page">
        <?php
        include("menu.php");
        ?>

        <div class='container'>
            <div class="row-fluid">
                <div class="span12 article-page-header">

                    <h1 class="article-page-title"><?php echo $article['title']; ?></h1>

                    <h4><?php echo $article['description']; ?></h4>

                </div>
            </div>

            <div class="row-fluid">
                <div class="span12 article-page-author">
                    <h4> <p style="font-style: italic;"><?php echo $article['date']; ?></p> | <a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $article['author']; ?>"><?php echo $article['author']; ?></a></h4>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span8 article-page-img">
                    <img width="800" height="533" src="../images/News/<?php echo $article['img']; ?>" alt="">
                </div>




                <div class="span4 related-nbox">
                    <div class="article-stadisctics">

                        <div id="stadisctics-count">
                            <span class="fa fa-heart"></span> <p>  <?php echo $article['likes']; ?></p> 
                            <span class="fa fa-search"></span> <p> <?php echo $article['views']; ?></p>
                            <span class="fa fa-comment"></span> <p> <?php echo count(get_comments_for_article($article['newId'])); ?></p><br>
                        </div>

                        <?php if ($_SESSION['login_user'] == $article['author']) { ?>

                            <form class="form-group" action="<?php echo $role; ?>" method="POST">
                                <input type="hidden" name="new_id" value="<?php echo $article['newId']; ?>">
                                <input type="hidden" name="title" value="<?php echo htmlentities($article['title'], ENT_QUOTES); ?>">
                                <input type="hidden" name="description" value="<?php echo htmlentities($article['description'], ENT_QUOTES); ?>">
                                <input type="hidden" name="content" value="<?php echo htmlentities($article['content'], ENT_QUOTES); ?>">
                                <input type="hidden" name="topic" value="<?php echo $article['topic']; ?>">
                                <input type="hidden" name="image" value="<?php echo $article['img']; ?>">


                                <input type="hidden" name="action" value="update_article_form">
                                <input class='send btn-submit' type="submit" value="EDIT">
                            </form>

                        <?php } ?>

                        <hr>

                    </div>

                    <div class="article-related-news">

                        <h3 class="related-news-header"><?php echo $topicName ?></h3>

                        <div id="related-article">

                            <?php
                            $i = 0;
                            foreach ($related_articles as $r_article) {
                                ?>

                                <?php if ($article['newId'] != $r_article['newId']) { ?>


                                    <div class="related-article">

                                        <h5><a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $r_article['newId']; ?>"><?php echo $r_article['title']; ?></a></h5>

                                    </div>

                                    <?php if (++$i == 5) break; ?>	

                                <?php } ?>
                            <?php } ?>


                        </div>
                    </div>				
                </div>
            </div>

            <div class="row-fluid">

                <div class="span8">
                    <p class="article-page-content" style="margin-top: 30px"><?php echo stripcslashes(nl2br($article['content']));
                        ?>
                    </p>	
                </div>

            </div>
            <hr>

            <div class="row-fluid">
                <span class="12">
                    <h2><?php echo count(get_comments_for_article($article['newId'])); ?> Comments</h2>	
                </span>
            </div>


            <div class="row-fluid">
                <div class="span7">

                    <?php foreach ($comments as $comment) { ?>
                        <div class="comment">
                            <p class="comment-author">
                                <span class="comment-username">
                                    <a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $comment['author']; ?>"><?php echo $comment['author']; ?></a>
                                </span>
                            </p>

                            <strong class="comment_n">
                                <a href="">#<?php
                        $comment_number +=1;
                        echo $comment_number;
                        ?></a>
                            </strong>

                            <span class="comment-date">
                                <?php echo $comment['date']; ?>
                            </span>
                            <p class="comment-text"><?php echo $comment['text']; ?></p>



                            <div class="interact">
                                <div class="rate-comment">
                                    <p>

                                        <a href="" class="positive fa fa-arrow-up"></a>

                                        <a href="" class="negative fa fa-arrow-down"></a>

                                        <span><?php echo $comment['votes']; ?></span>
                                    </p>

                                </div>

                            </div>
                        </div>


                    <?php } ?> 

                </div>


                <div class="span5 add-comment">


                    <h4 class='add-title'>Add a comment</h4>
                    <?php if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { ?>

                        <form class='formAddComment' action="<?php echo $role; ?>" method="POST"><br/>

                            <input type="hidden" name="action" value="add_comment">
                            <input type="hidden" name="new_id" value="<?php echo $article['newId']; ?>">
                            <input type="hidden" name="author" value="<?php echo $_SESSION['login_user']; ?>">

                            <textarea name="text" rows="4" placeholder="What's on your mind ?" class='status-box'
                                      name="text"></textarea><br/>

                            <div class="button-group">
                                <p class="counter">140</p>
                                <p><input type="submit" id ="submit-comment" class="btn btn-primary" value="Post"/>
                            </div>


                        </form>

                    <?php } elseif ($_SESSION['login_user'] == NULL || $_SESSION['login_user'] == "") { ?>

                        <h4 style="text-align: center;">You have to be logged to comment.</h4>

                      
                    <?php } ?>
                </div>



            </div>



        </div>

        <script src="../jscript/add_comment.js"></script>

    </main>

    <?php
    include ("../view/footer.php");
    ?>