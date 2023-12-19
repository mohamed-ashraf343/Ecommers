<?php
    session_start();
    $noNavbar = ''; 
    $pageTitle = 'login';
    if(isset($_SESSION['Username'])){
        header('Location: dashbord.php');   /// Redirect to dashbord page
     }
    include 'int.php ';
    //check if user comin from  HTTP POST Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashpass = sha1($password);
        

        //// check user this is database
        $stmt = $con->prepare("SELECT UserID,
                                  Username, 
                               PassWord FROM users 
                               WHERE Username = ?
                                AND Password = ? 
                                AND GroupID = 1");
        $stmt->execute(array($username, $hashpass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        // if count > 0 this mean the database contain  record about this username
        if($count > 0) {
            $_SESSION['Username'] = $username;   /// Register session Name
            $_SESSION['id'] = $row['UserID'];
            header('Location: dashbord.php');   /// Redirect to dashbord page
            exit();

        }          
              
    }; 
   

    


 ?>

   <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control inpout-lg" type="text" name="user" placeholder="Username" autocomplete="off" />
    <input class="form-control inpout-lg" type="password" name="pass" placeholder="password" autocomplete="off" />
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="login" />


   </form>

<?php
    include $tpl . "footer.php";
   

?>