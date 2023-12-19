<?php
    session_start();

    if(isset($_SESSION['Username'])){

        $pageTitle = 'Dashbord';
        include 'int.php';
        echo "welcom";
        include $tpl . "footer.php";


    }

    else {

        header('Location: index.php');

        exit();
    }
?>