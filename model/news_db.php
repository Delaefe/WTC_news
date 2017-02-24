<?php

/* * *****************************************************************************
 * Function to get all news  from DB
 * Parameters: 
 * Return: Query array of all news 
 * **************************************************************************** */

function get_news() {
    global $db;
    $query = "SELECT * FROM news ORDER BY date";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $allnews = $statement->fetchAll();
    $statement->closeCursor();

    return $allnews;
}

/* * *****************************************************************************
 * Function to get front page news  from DB
 * Parameters: 
 * Return: Query array of front page news 
 * **************************************************************************** */

function get_frontpage_news() {
    global $db;
    $query = "SELECT * FROM news WHERE frontpage=1 ORDER BY date";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $frontpage = $statement->fetchAll();
    $statement->closeCursor();

    return $frontpage;
}

/* * *****************************************************************************
 * Function to get all news by topic from DB
 * Parameters: $topic_id
 * Return: Query array of all news for this topic_id
 * **************************************************************************** */

function get_news_by_topic($topic_id) {
    global $db;
    $query = "SELECT * FROM news WHERE topic = :topic_id ORDER BY newId DESC";
    $statement = $db->prepare($query);
    $statement->bindValue(":topic_id", $topic_id);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $news = $statement->fetchAll();
    $statement->closeCursor();

    return $news;
}

/* * *****************************************************************************
 * Function to get the most viewed news from the DB
 * Parameters: 
 * Return: Query array of most viewed news 
 * **************************************************************************** */

function get_most_viewed_news() {
    global $db;
    $query = "SELECT * FROM news ORDER BY views DESC";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $news = $statement->fetchAll();
    $statement->closeCursor();

    return $news;
}

/* * *****************************************************************************
 * Function to get the most popular news from the DB
 * Parameters: 
 * Return: Query array of most popular news 
 * **************************************************************************** */

function get_most_popular_news() {
    global $db;
    $query = "SELECT * FROM news ORDER BY likes DESC";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $news = $statement->fetchAll();
    $statement->closeCursor();

    return $news;
}

/* * *****************************************************************************
 * Function to get a particular article from DB
 * Parameters: $new_id
 * Return: Singular article from DB
 * **************************************************************************** */

function get_article($new_id) {
    global $db;
    $query = "SELECT * FROM news WHERE newId = :new_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $article = $statement->fetch();
    $statement->closeCursor();

    return $article;
}

/* * *****************************************************************************
 * Function to get all news for a particular user
 * Parameters: $username
 * Return: Query array of all news for an user
 * **************************************************************************** */

function get_articles_by_username($username) {
    global $db;
    $query = "SELECT * FROM news WHERE author = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $articles = $statement->fetchAll();
    $statement->closeCursor();

    return $articles;
}




/* * *****************************************************************************
 * Function to add an article in the DB
 * Parameters: $title, $description, $topic, $content, $image, $author
 * Return: nothing
 * **************************************************************************** */

function add_article($title, $description, $topic, $content, $img, $author, $date) {
    global $db;
    $query = "INSERT INTO news (title, description, content, topic, img, author, date) VALUES (:title, :description, :content, :topic, :img, :author, :date)";

    $statement = $db->prepare($query);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":content", $content);
    $statement->bindValue(":topic", $topic);
    $statement->bindValue(":img", $img);
    $statement->bindValue(":author", $author);
    $statement->bindValue(":date", $date);




    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}

/* * ****************************************************************************
 * Function to update an article to the DB
 * Paramenters: 
 * Return: nothing
 * **************************************************************************** */

function update_article($new_id, $title, $description, $content, $topic, $date) {
    global $db;

    $query = 'UPDATE news SET title = :title, description = :description , content = :content, topic = :topic , date = :date WHERE newId = :new_id';
    $statement = $db->prepare($query);
    $statement->bindValue('new_id', $new_id);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":content", $content);
    $statement->bindValue(":topic", $topic);
    $statement->bindValue(":date", $date);

    try {
        $statement->execute();
    } catch (Exception $ex) {

        //redirect to an error page passing the error message
        header("location:../view/error.php?msg = " . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}

/* * *****************************************************************************
 * Function to update the views of an article
 * Parameters: $new_id
 * Return: nothing
 * **************************************************************************** */

function update_views($newId , $views) {
    global $db;
    $query = 'UPDATE news SET views = :views WHERE newId = :newId';

    $statement = $db->prepare($query);
    $statement->bindValue(":newId", $newId);
    $statement->bindValue(":views", $views);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}



/* * *****************************************************************************
 * Function to count the amount of articles for a topic
 * Parameters: topicId
 * Return: total articles for a topic
 * **************************************************************************** */

function get_count_for_topic($topicId) {
    global $db;

    $query = "SELECT count(*) FROM news WHERE topic= :topicId";
    $statement = $db->prepare($query);
    $statement->bindValue(":topicId", $topicId);
    $statement->execute();
    $total = $statement->fetchColumn();

    $statement->closeCursor();

    
    return $total;
}

/* * *****************************************************************************
 * Function to switch the value "frontpage" of an article to add the article to the frontpage view
 * Parameters: $new_id , $value
 * Return: nothing
 * **************************************************************************** */

function switch_frontpage($new_id, $value) {
    global $db;

    $query = 'UPDATE news SET frontpage = :value WHERE newId = :new_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);
    $statement->bindValue(":value", $value);
    $statement->execute();
    
    $statement->closeCursor();
}

/* * *****************************************************************************
 * Function to update the value "likes" of an article 
 * Parameters: $new_id , $value
 * Return: nothing
 * **************************************************************************** */

function update_likes($new_id, $value) {
    global $db;

    $query = 'UPDATE news SET likes = :value WHERE newId = :new_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);
    $statement->bindValue(":value", $value);
    $statement->execute();
    
    $statement->closeCursor();
}

/* * ****************************************************************************
 * Function to delete a article by new ID from the DB
 * Paramenter: new_id
 * Return: nothing
 * **************************************************************************** */

function delete_article($new_id) {

    global $db;

    $query = "DELETE FROM news WHERE newId = :new_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);

    try {
        $statement->execute();
    } catch (Exception $ex) {

        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}


?>

