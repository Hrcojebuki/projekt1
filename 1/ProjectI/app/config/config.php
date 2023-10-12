<?php

//Contains config data for the index.php to load. 
//For example, this is how 'TITLE' constant is defined to be loaded into runtime: 
define('TITLE', 'Project I - PHP');
define("DB_HOST", "localhost"); //keep localhost with 'solace.ist.rit.edu' since localhost is the only allowed/registered name to be used by Solace 
define("DB_USER", "mb1591");      //replace with data found in .my.cnf if hosted on Solace
define("DB_PASS", "Lucretia4#pieris");     //replace with data found in .my.cnf if hosted on Solace
define("DB_NAME", "mb1591");    //replace this with your rit username
define('URL_ROOT', 'http://' . $_SERVER['SERVER_NAME'] . pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) . '/');