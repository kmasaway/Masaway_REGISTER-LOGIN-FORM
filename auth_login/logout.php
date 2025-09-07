<?php

require 'Database.php';
require 'Auth.php';

$db = (new Database())->connect();
$auth = new Auth($db);

$auth->logout();
header("Location: login.php");
exit;

?>