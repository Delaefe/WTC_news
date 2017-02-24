<?php

/* * *****************************************************************************
 * Function to get all topics from the DB
 * Parameters: None
 * Return: Query results array with all topics fields and records.
 * **************************************************************************** */

function get_topics() {
    global $db;
    $query = "SELECT * FROM topics order by topicId";
    $statement = $db->prepare($query);

     try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $topics = $statement->fetchAll();
    $statement->closeCursor();

    return $topics;
}

/* * *****************************************************************************
 * Function to get the header of a  topics from the DB
 * Parameters: topic_id
 * Return: Query results string with the name of header image for the topic
 * **************************************************************************** */

function get_topic_by_id($topic_id) {
    global $db;
    $query = "SELECT * FROM topics WHERE topicId = :topic_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":topic_id", $topic_id);

     try {
        $statement->execute();
    } catch (Exception $ex) {

//redirect to an error page passing the error message
        header("location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }
    $topic = $statement->fetch();
    $statement->closeCursor();

    return $topic;
}




?>