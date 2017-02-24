<?php


 session_start();
 $role = $_SESSION['role'];

date_default_timezone_set('UTC');

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


switch ($action) {
	case 'home':

	$topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);

	if ($topic_id != NULL && $topic_id !=false) {

		$news = get_news_by_topic($topic_id);
		$topic = get_topic_by_id($topic_id);

		$header = $topic['header'];
		$topic_name = $topic['topicName'];

	}else{
		$news = get_frontpage_news();
		$header = "main.jpg";
		$topic_name = "What's the Craic?";
	}

	$topics = get_topics();
	include('../view/home.php');
	break;


	case 'log_out':


	$_SESSION['login_user'] = "";
	$_SESSION['user_type'] = "";
	session_destroy();

	echo("<script>window.location.replace('index.php');</script>");  // redirect  
	
	break;


	case 'show_article':

	$new_id = filter_input(INPUT_GET, 'new_id', FILTER_VALIDATE_INT);
	if ($new_id == NULL || $new_id == false) {

		include('../view/error.php');
	}else{

		$topics = get_topics();


		$article = get_article($new_id);
		$views = $article['views'];
		update_views($new_id, $views+1);

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

	/******************************************************************************************************************/


	case 'add_article_form':
	$topics = get_topics();
	include ( "../view/add_article_form.php");
	break;

	case 'add_article':

	$title = filter_input(INPUT_POST, 'title');
	$description = filter_input(INPUT_POST, 'description');
	$topic = filter_input(INPUT_POST, 'topic', FILTER_VALIDATE_INT);
	$content = filter_input(INPUT_POST, 'content');
	$img = filter_input(INPUT_POST, 'image');
	$author = "delafuente";
	$date = date("y-m-d H:i:sa");

	if ($title == NULL || $description == NULL || $topic == NULL || $topic == false || $content == NULL || $img == NULL || $date == NULL || $author == NULL) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	} else {
		add_article($title, $description, $topic, $content, $img, $author, $date);
		header("Location: .?topic_id=$topic");
	}		

	break;

	case 'update_article_form':

	$new_id = filter_input(INPUT_POST, 'new_id');
	$title = filter_input(INPUT_POST, 'title');
	$description = filter_input(INPUT_POST, 'description');
	$topic = filter_input(INPUT_POST, 'topic', FILTER_VALIDATE_INT);
	$content = filter_input(INPUT_POST, 'content');


	$topics = get_topics();
	include ( "../view/update_article_form.php");
	break;

	case 'update_article':

	$new_id = filter_input(INPUT_POST, 'new_id');
	$title = filter_input(INPUT_POST, 'title');
	$description = filter_input(INPUT_POST, 'description');
	$topic = filter_input(INPUT_POST, 'topic', FILTER_VALIDATE_INT);
	$content = filter_input(INPUT_POST, 'content');
	$date = date("Y-m-d H:i:sa");


	if ($title == NULL || $description == NULL || $topic == NULL || $topic == false || $content == NULL || $date == NULL) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	} else {
		update_article($new_id, $title, $description, $content,$topic, $date);
		header("Location: .?action=show_article&new_id=$new_id");
	}		

	break;




	case 'add_comment':
	$newId = filter_input(INPUT_POST, 'new_id', FILTER_VALIDATE_INT);
	$author = filter_input(INPUT_POST, 'author');
	$text = filter_input(INPUT_POST, 'text');
	$date = date('d/m/y - H:ia');

	if ($newId == NULL || $newId == false || $text == NULL || $author == NULL || $author == NULL) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	} else {
		add_comment($newId, $author, $text, $date);
		header("Location: index_admin.php?action=show_article&new_id=$newId");
	}			


	break;

	case 'like_article':

	$new_id = filter_input(INPUT_GET, 'new_id', FILTER_VALIDATE_INT);
	$username;


	$article_liked = get_article_liked($new_id, $username);

	if ($new_id == NULL || $new_id == false || $username == NULL) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	}else{

		if ($article_liked == NULL) {
			like_article($new_id,$username, 1);
		}
		elseif ($article_liked != NULL){

			if ($article_liked['status'] == 0) {
				switch_like($new_id,$username, 1);

			}elseif ($article_liked['status'] == 1) {
				switch_like($new_id,$username, 0);
			}
		}
	}

	break;


	/*****************************************************************************************************************/


	case 'delete_comment':


	$comment_id = filter_input(INPUT_GET, 'comment_id', FILTER_VALIDATE_INT);


	if ($comment_id == NULL || $comment_id == false) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	} else {
		delete_comment($comment_id);
	}

	break;

	case 'delete_article':


	$new_id = filter_input(INPUT_GET, 'new_id', FILTER_VALIDATE_INT);


	if ($new_id == NULL || $new_id == false) {
		$error_message = "Invalid data. Please check all the fields";
		include('../view/error.php' );
	} else {
		delete_article($new_id);
	}

	break;
        
        case 'like':

	$new_id = filter_input(INPUT_GET, 'new_id', FILTER_VALIDATE_INT);
	$username = $_SESSION['login_user'];

	$like = check_like($new_id, $username);
	$article = get_article($new_id);

	

	if ($like != NULL) {
		

		if ($like['status'] == 0) {
			switch_like($like['likeId'], 1);
			update_likes($article['newId'], $article['likes'] + 1);

		}
		elseif ($like['status'] == 1){
			switch_like($like['likeId'], 0);
			update_likes($article['newId'], $article['likes'] - 1);

		}

	}
	else{
		add_like($new_id, $username, 1);
		update_likes($article['newId'], $article['likes'] + 1);


	}
		$count = get_article($new_id)['likes'];

		
		break;


    case 'about_us':
        include('../view/about_us.php');


        break;


	default:
	$topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_VALIDATE_INT);

	if ($topic_id != NULL && $topic_id !=false) {

		$news = get_news_by_topic($topic_id);
		$topic = get_topic_by_id($topic_id);

		$header = $topic['header'];
		$topic_name = $topic['topicName'];

	}else{
		$news = get_frontpage_news();
		$header = "main.jpg";
		$topic_name = "What's the Craic?";
	}

	$topics = get_topics();
	include('../view/home.php');
	break;
}

?>