<?php
/*
**titel function that echo the page titel  in case the page 
**has the variable $pagetitel And echo defult titel for other pages   
*/
function getTitle() {

   global $pageTitle;

    if (isset($pageTitle))

     {
        echo  $pageTitle;
    }
    else {
        echo 'Defaule';
    }

}


/*
    /// Home Redirect function  
    $Erorr mesg = echo the Erorr mesg
    $seconds = second Before Redirecting
*/
function RedirectHome($errorMsg, $second = 3) {
    echo "<div class='alert alert-danger'>$errorMsg </div>";
    echo "<div class='alert alert-info'>You Will Be Redirect To Homepage After $second Seconds </div>";
    header("refresh:$second;url=index.php");
    exit();

}