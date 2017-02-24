<?php

/* * *****************************************************************************
 * Function to get all votes for a particular comment
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

?>