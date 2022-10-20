<?php

    include_once 'userSession.php';

    $userSession = new UserSession();
    $userSession->closeSession();
    header("location: ../../main.html");
?>