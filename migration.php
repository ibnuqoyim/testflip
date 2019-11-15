<?php
  include_once 'config/config.php';
  
  $host=HOSTNAME;
  $user=USERNAME;
  $pass = PASSWORD ; 
  $dbname = DB_NAME;
  $tablename = TABLE_NAME;

  $db=mysqli_connect($host,$user,$pass);
  //create database if not exists
  $sql ="CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
  $message = mysqli_query($db,$sql);
  if ($message) {
    print_r("Create database success.\n");
  }

  $sql="USE `$dbname`";
  $message = mysqli_query($db,$sql);
  if ($message) {
    print_r("Choose database success.\n");
  }

  //create table if not exists
  $sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
             `id` int(11) NOT NULL AUTO_INCREMENT,
             `time_served` char(50) DEFAULT NULL,
             `id_disburs` char(50) DEFAULT NULL,
             `receipt` varchar(250) DEFAULT NULL,
             `status_disburs` varchar(250) DEFAULT NULL,
             `response` text,
             `request` text,
             `api` varchar(200) DEFAULT NULL,
             `created_at` datetime DEFAULT NULL,
             `updated_at` datetime DEFAULT NULL,
              PRIMARY KEY (`id`)
          );";
  $message = mysqli_query($db,$sql);
  if (!$message) { 
    print_r(mysqli_error($db)."\n");
  } else {
    print_r("Create table success.\n");
  }

  mysqli_query($db,$sql);
  
?>