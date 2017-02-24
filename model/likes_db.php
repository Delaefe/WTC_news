<?php



/* * *****************************************************************************
 * Function to get all likes  from DB
 * Parameters: 
 * Return: Query array of all likes 
 * **************************************************************************** */

function get_likes() {
    global $db;
    $query = "SELECT * FROM likes ";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $likes = $statement->fetchAll();
    $statement->closeCursor();

    return $likes;
}

/* * *****************************************************************************
 * Function to get all likes for a particular user
 * Parameters: $username
 * Return: Query array of all likes for an user
 * **************************************************************************** */

function get_likes_by_username($username) {
    global $db;
    $query = "SELECT * FROM likes WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);


    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $likes = $statement->fetchAll();
    $statement->closeCursor();

    return $likes;
}

/* * *****************************************************************************
 * Function to add a like in the DB
 * Parameters: $new_id, $username, $status
 * Return: nothing
 * **************************************************************************** */

function add_like($new_id, $username, $status) {
    global $db;
    $query = "INSERT INTO likes (newId, username, status) VALUES (:new_id, :username, :status)";

    $statement = $db->prepare($query);
    $statement->bindValue(":new_id", $new_id);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":status", $status);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

}
    /* * *****************************************************************************
 * Function to switch the value "status" of a like
 * Parameters: $likeId , $value
 * Return: nothing
 * **************************************************************************** */

function switch_like($like_id, $value) {
    global $db;

    $query = 'UPDATE likes SET status = :value WHERE likeId = :like_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":like_id", $like_id);
    $statement->bindValue(":value", $value);
    $statement->execute();
    
    $statement->closeCursor();
}

/* * *****************************************************************************
 * Function to check a like exists
 * Parameters: likeId
 * Return: return the like if exists
 * **************************************************************************** */

function check_like($newId, $username) {
    global $db;

    $query = "SELECT * FROM likes WHERE newId= :newId AND username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":newId", $newId);
    $statement->bindValue(":username", $username);

    $statement->execute();
    $like = $statement->fetch();

    $statement -> closeCursor();
    
    return $like;
}








?>