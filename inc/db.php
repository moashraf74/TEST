<?php
session_start();

$servername='localhost';
$username= 'root';
$password ='';
$dbname='cms_project_blog';

$connection = mysqli_connect($servername,$username,$password,$dbname);

