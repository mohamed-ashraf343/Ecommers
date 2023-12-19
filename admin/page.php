<?php
/*
    categories => [ maneg | Edit | Update | Add | Insert |  Delete | stats ]
*/
$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

// if the page is main
if ($do== 'manage') {
    echo 'welcome you are in manage category page';
    echo '<a href="page.php?do=Add">Add New Category +</a>';
}
elseif ($do=='Add') {
    echo 'welcome you are in Add cateogry page';

}
else {
    echo'Error \' Not Page Found THis Name';
}
