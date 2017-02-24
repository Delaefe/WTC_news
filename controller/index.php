<?php

date_default_timezone_set('UTC');

session_start();
$_SESSION['login_user'] = "";
$_SESSION['user_type'] = "0";
$role = 'index.php';

/*
 * This is the controller php file.
 * It has possible passed values of $action and $category_id
 * 
 * 1) None - this is the inex page so show the default category ($category_id=1)
 * 2) POST input
 * 3) GET input
 */

//Need the files to connect to the DB and to make functions available
require ("../model/database.php");
require ("../model/topics_db.php");
require ("../model/news_db.php");
require ("../model/users_db.php");
require ("../model/comments_db.php");
require ("../model/likes_db.php");





/* A variable 'action' is needed, it can be passed by POST, GET or not at all
 * If not at all, then make action = default of list_products
 */

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

/* ---------------------------------------------------------------------------- */

switch ($action) {
    case 'home':

        $topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);

        if ($topic_id != NULL && $topic_id != false) {

            $news = get_news_by_topic($topic_id);
            $topic = get_topic_by_id($topic_id);

            $header = $topic['header'];
            $topic_name = $topic['topicName'];
        } else {
            $news = get_frontpage_news();
            $header = "main.jpg";
            $topic_name = "What's the Craic?";
        }

        $topics = get_topics();
        include('../view/home.php');
        break;



    case 'show_article':

        $new_id = filter_input(INPUT_GET, 'new_id', FILTER_VALIDATE_INT);
        if ($new_id == NULL || $new_id == false) {

            include('../view/error.php');
        } else {

            $topics = get_topics();


            $article = get_article($new_id);
            $views = $article['views'];
            update_views($new_id, $views + 1);

            $comments = get_comments_for_article($new_id);

            $topic = get_topic_by_id($article['topic']);
            $related_articles = get_news_by_topic($topic['topicId']);
            $topicName = $topic['topicName'];
            include('../view/article.php');
        }

        break;

    case 'view_profile':

        $username = filter_input(INPUT_GET, 'username');

        $user = get_user_by_username($username);
        $articles = get_articles_by_username($username);
        $comments = get_comments_by_username($username);

        include ('../view/view_profile.php');



        break;


    case 'most_viewed':

        $header = "most_viewed2.jpg";

        $topic_name = "Most Viewed";
        $topics = get_topics();
        $news = get_most_viewed_news();
        include("../view/home.php");

        break;


    case 'most_popular':

        $header = "most_pop.jpg";

        $topic_name = "Most Popular";
        $topics = get_topics();
        $news = get_most_popular_news();
        include("../view/home.php");

        break;

    /*     * *************************************************************************************************************** */

    case 'register':

        $username = filter_input(INPUT_POST, "username");
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");

        $password1 = filter_input(INPUT_POST, "password");
        $password2 = filter_input(INPUT_POST, "password2");



        if ($password1 !== $password2) {
            $error_message = "Your passwords need to match!";
            include('../view/error.php' );
        } else {

            $queryUsername = "SELECT username FROM users WHERE username= :username";
            $statement1 = $db->prepare($queryUsername);
            $statement1->bindValue(":username", $username);
            $statement1->execute();
            $check_username = $statement1->fetchAll();
            $statement1->closeCursor();
            $total = count($check_username);

            if ($total != 0) {
                $error_message = "ERROR: The username already exists. Choose another username";
                include('../view/error.php' );
            } else {
                $query = "INSERT INTO users (username, password, name, lastname ) VALUES (:username,:password1, :name, :lastname)";
                $statement = $db->prepare($query);
                $statement->bindValue(":username", $username);
                $statement->bindValue(":password1", $password1);
                $statement->bindValue(":name", $name);
                $statement->bindValue(":lastname", $lastname);

                try {
                    $statement->execute();
                } catch (Exception $ex) {
                    //redirect to an error page passing the error message
                    exit();
                }
                $statement->closeCursor();

                $_SESSION['login_user'] = $username;
                $_SESSION['user_type'] = 1;

                switch ($_SESSION['user_type']) {

                    case 1:
                        //USER
                        $role = 'index_user.php';
                        $_SESSION['role'] = $role;
                        break;
                    case 2:
                        //ADMIN
                        $role = 'index_admin.php';
                        $_SESSION['role'] = $role;
                        break;
                }
                header("location:" . $role);
            }
        }



        break;

    case 'login':

        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");


        $queryUsername = "SELECT * FROM users WHERE username= :username and password = :password";
        $statement1 = $db->prepare($queryUsername);
        $statement1->bindValue(":username", $username);
        $statement1->bindValue(":password", $password);
        try {
            $statement1->execute();
        } catch (Exception $ex) {
            //redirect to an error page passing the error message
            exit();
        }
        $check_user = $statement1->fetchAll();
        $count = count($check_user);

        if ($count == 1) {

            $_SESSION["login_user"] = $username;
            $_SESSION['user_type'] = $check_user[0]["user_type"];

            switch ($_SESSION['user_type']):

                case 1:
                    //USER
                    $role = 'index_user.php';
                    $_SESSION['role'] = $role;
                    break;
                case 2:
                    //ADMIN
                    $role = 'index_admin.php';
                    $_SESSION['role'] = $role;
                    break;

            endswitch;
            header("location:" . $role);
        } else {
            $error_message = "There was an issue with your login: Username or Password";
            include('../view/error.php' );
        }

        $statement1->closeCursor();

        break;


    case 'check_username':

        $username = $_REQUEST["username"];

// lookup all hints from array if $q is different from "" 
        if ($username !== "") {

            $exists = check_username($username);
            if ($exists) {
                echo "fa fa-ban";
            } else {
                echo "fa fa-check-circle";
            }
        }
        break;

    case 'about_us':
        include('../view/about_us.php');


        break;


    default:
        $topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);

        if ($topic_id != NULL && $topic_id != false) {

            $news = get_news_by_topic($topic_id);
            $topic = get_topic_by_id($topic_id);

            $header = $topic['header'];
            $topic_name = $topic['topicName'];
        } else {
            $news = get_frontpage_news();
            $header = "main.jpg";
            $topic_name = "What's the Craic?";
        }

        $topics = get_topics();
        include('../view/home.php');
        break;
}

