<?php

/* * *****************************************************************************
 * Function to get all users  from DB
 * Parameters: 
 * Return: Query array of all users 
 * **************************************************************************** */

function get_users() {
    global $db;
    $query = "SELECT * FROM users ";
    $statement = $db->prepare($query);

    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $users = $statement->fetchAll();
    $statement->closeCursor();

    return $users;
}

/* * *****************************************************************************
 * Function to get a user by username from DB
 * Parameters: userame
 * Return: Query a users 
 * **************************************************************************** */

function get_user_by_username($username) {
    global $db;
    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);



    try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $user = $statement->fetch();
    $statement->closeCursor();

    return $user;
}

/* * *****************************************************************************
 * Function to delete a user from the DB
 * Parameters: $username
 * Return: nothing 
 * **************************************************************************** */

function delete_user($username) {
    global $db;

    $query = "DELETE FROM users WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);

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
 * Function to check if a username exists the in the DB
 * Parameters: $username
 * Return: true if exists, false if not 
 * **************************************************************************** */

function check_username($username) {
    global $db;

    $query = "SELECT * FROM users WHERE username= :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);

    $statement->execute();
    $user = $statement->fetch();
     $statement -> closeCursor();

    if ($user != NULL){
        return true;
    }
    else{
        return false;
    }    
}

?>