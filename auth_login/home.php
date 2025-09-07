<?php

require 'Database.php';
require 'Auth.php';

$db = (new Database())->connect();
$auth = new Auth($db);

if(!$auth->check()) {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="card">
        <h2>Welcome <?php echo htmlspecialchars($auth->student());?></h2>

        <a href="logout.php">Logout</a>
    </div>
    
</body>
</html>