<?php

$user = '';
$pass = '';

$db = '';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

echo (select * from account);

?>﻿
