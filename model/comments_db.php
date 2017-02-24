<?php

/* * *****************************************************************************
 * Function to get all comments  from DB
 * Parameters: 
 * Return: Query array of all comments 
 * **************************************************************************** */

function get_comments() {
    global $db;
    $query = "SELECT * FROM comments ";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $comments = $statement->fetchAll();
    $statement->closeCursor();

    return $comments;
}

/* * *****************************************************************************
 * Function to get all comments for an article  from DB
 * Parameters: $new_id
 * Return: Query array of all comments for an article 
 * **************************************************************************** */

function get_comments_for_article($new_id) {
    global $db;
    $query = "SELECT * FROM comments WHERE newId = :new_id ORDER BY commentId ASC";
    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $comments = $statement->fetchAll();
    $statement->closeCursor();

    return $comments;
}

/* * *****************************************************************************
 * Function to get all news for a particular user
 * Parameters: $username
 * Return: Query array of all news for an user
 * **************************************************************************** */

function get_comments_by_username($username) {
    global $db;
    $query = "SELECT * FROM comments WHERE author = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $comments = $statement->fetchAll();
    $statement->closeCursor();

    return $comments;
}

/* * *****************************************************************************
 * Function to add a comment in the DB
 * Parameters: $new_id, $author, $text, $date
 * Return: nothing
 * **************************************************************************** */

function add_comment($new_id, $author, $text, $date) {
    global $db;
    $query = "INSERT INTO comments (newId, author, text, date) VALUES (:new_id, :author, :text, :date)";

    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);
    $statement->bindValue(":author", $author);
    $statement->bindValue(":text", $text);
    $statement->bindValue(":date", $date);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

}

/* * ****************************************************************************
 * Function to delete a comment by comment ID from the DB
 * Paramenter: comment ID
 * Return: nothing
 * **************************************************************************** */

function delete_comment($comment_id) {

    global $db;

    $query = "DELETE FROM comments WHERE commentId = :comment_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":comment_id", $comment_id);

    try {
        $statement->execute();
    } catch (Exception $ex) {

        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $statement->closeCursor();
}



?>