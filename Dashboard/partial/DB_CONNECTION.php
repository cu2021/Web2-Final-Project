<?php


$connection = mysqli_connect('localhost', 'root', '', 'project');
if (!$connection) {
    die('Error' .
        mysqli_connect_error());
}