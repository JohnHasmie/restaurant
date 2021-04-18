<?php

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../index.php"); //redirect to index 
}
