<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    session_start();

    $host = $_SERVER['HTTP_HOST']; // localhost
    $path = rtrim(dirname($_SERVER['PHP_SELF']), "/"); 
    $base = "http://" . $host . $path . "/";
    
    define("PATH_CSS", $base . "view/css/");
    define("PATH_IMG", $base . "view/img/");
    define("PATH_JS", $base . "view/js/");

    require_once "controller/MainController.class.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NanoTest</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="<?=PATH_CSS?>header.css">
        <link rel="stylesheet" href="<?=PATH_CSS?>body.css">
        <script src="<?=PATH_JS?>general-fn.js"></script>
    </head>
    <body>
        <div id="page">
            <header>
                 <h1>NANO TEST</h1>
            </header>
            <?php
                //$controlMain=new MainController();
                //$controlMain->processRequest();

                if (isset($_SESSION['name'])) {
                    (new MainController())->processRequest();
                }
                else {
                    $controlLogin=new UserController();
                    $controlLogin->processRequest();
                }
            ?>
        </div>
    </body>
</html>