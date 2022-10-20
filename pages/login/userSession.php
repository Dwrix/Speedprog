<?php

    class UserSession{

        public function __construct(){

            session_start();
        }

        public function setCurrentUser($user){

            $_SESSION['user'] = $user;

        }

        public function getCurrentUser(){
            return $_SESSION['user'];
        }

        //cerrando y limpiando la session
        public function closeSession(){
            session_unset();
            session_destroy();
        }

    }


?>