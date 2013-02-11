<?php

// include a library
    require_once("vendors/Stomp/Stomp.php");
    // make a connection
    $con = new Stomp("tcp://127.0.0.1:61613");
    // connect
    $con->connect();
    // send a message to the queue
    $con->send("qaalo", "test");
    echo "Sent message with body 'test'\n";
    // subscribe to the queue
    /*
    $con->subscribe("deneme");
    // receive a message from the queue
    $msg = $con->readFrame();

    // do what you want with the message
    if ( $msg != null) {
        echo "Received message with body '$msg->body'\n";
        // mark the message as received in the queue
        $con->ack($msg);
    } else {
        echo "Failed to receive a message\n";
    }
*/
    // disconnect
    $con->disconnect();
?>
