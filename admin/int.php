       
       
       
       <?php
        include 'connect.php';

        // routs
        $tpl ='inclouds/templates/';  /// templet dirctory
        $lang ='inclouds/languages/';         // Languages directory 
        $func = 'inclouds/functions/';  // function directory
        $css ='layout/css/';         // css folder directory 
        $iconfont ='layout/fonts/css/';
        $js ='layout/js/';         // css folder directory 


        ////Incloud the Important Files
        include $func . "function.php";
        include $lang . "english.php";
        include $tpl . "header.php";


        /// Incloud NavBar On All page Expect the one with $nonavbar vairable
        if (!isset($noNavbar)){
            include $tpl . "navbar.php";

        }



        ?>