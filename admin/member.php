<?php
/*
===================================================
== Maneg Members pages
== You Can Add | Delete Members From Here
====================================================

*/
      session_start();
      if(isset($_SESSION['Username']))
      {
         $pageTitle = 'edit';
         include 'int.php';
         $do = isset($_GET['do']) ? $_GET['do'] : 'manage'; // start manage pages
            if ($do == 'manage'){ // manage member pages 
                  // select all users excapet admin
            $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1");
            //execute the statment
            $stmt->execute();
            //assign to varible
            $rows = $stmt->fetchAll();                
            ?> 
                  <h1 class="text-center" style="margin: 30px 0;">Manage Members</h1>
              <div class="container">
                  <table class="table table-dark text-center table-bordered">
                  <thead>
                        <tr>
                              <th scope="col">#ID</th>
                              <th scope="col">UserName</th>
                              <th scope="col">Email</th>             
                              <th scope="col">FullName</th>                                  
                              <th scope="col">Register Date</th>
                              <th scope="col">Control</th                                                                                            >
                        </tr>                      
               </thead>
               <?php
                  foreach($rows as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['UserID'] . "</td>";
                        echo "<td>" . $row['Username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['FullName'] . "</td>";
                        echo "<td></td>";
                        echo "<td>
                        <a type='button' href='member.php?do=edit&userid=" . $row['UserID'] . "' class='btn btn-success'>edit</a>
                        <a type='button' href='member.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'>Delete</a>
                        </td>";
                        echo "</tr>";
                  }                                          
                  ?>                                                                                                
                        </table>                          
                                  <a class="btn btn-primary" href="member.php?do=Add">Add New Member<a>
                  </div>

            

         <?php   }elseif($do == 'Add') { // Add members pages?>
                  
            <h1 class="text-center" style="margin: 30px 0;">Add Member</h1>
            <div class="container">
                                      
            <form class="form-horizontal" action="?do=Insert" method="POST">                                                              
                                          <!-- End password field -->
                                          
                                                <div class="form-group mb-3 row">
                                                <label  class="col-sm-2 col-form-label">password</label>
                                                <div class="col-sm-10">
                                                <input type="password" class="form-control password"  name="password" autocomplete="new-password" placeholder="Inpout your password stronger">
                                                <i class="show-pass fa fa-eye fa-2x"></i>

                                                </div>
                                                </div>
                                                                  
                                          <!-- End password field -->
                                          <!-- End Email field -->
                                          
                                                <div class="form-group mb-3 row">
                                                <label  class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                <input type="Email" class="form-control"  name="Email" required="required" placeholder="Inpout your Email">
                                                </div>
                                                </div>
                                                                  
                                          <!-- End Email field -->
                                          
                                          <!-- End Fullname field -->
                                          
                                                <div class="form-group-lg mb-3 row">
                                                <label  class="col-sm-2 col-form-label">Fullname</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control"  name="Fullname" required="required" placeholder="Inpout your Full Name">
                                                </div>
                                                </div>
                                                                  
                                          <!-- End Fullname field -->
                                    
                                          
                                                      <div class="col-sm-ofset-2 col-sm-10">
                                                      <input type="submit"  value="save" class="btn btn-primary">
                                                      
                                                      </div>
                                                                  
                                          <!-- End Fullname field -->
                                          </from>
                                       </form>                            
                                          
             </div>                               


            <?php } elseif($do == 'Insert') {

                        // insert member pages
                       
                  if ($_SERVER['REQUEST_METHOD'] =='POST') {

                        echo "<h1 class='text-center' style='margin: 30px 0;'> Update Member</h1> ";
                        echo "<div class='container'>";

                        // Get variables from the form 
                        $user=       $_POST['username'];
                        $pass=   $_POST['password']; 
                        $email=      $_POST['Email'];
                        $name =      $_POST['Fullname'];

                        $hashpas = sha1($_POST['password']);


                        // validate the form
                        $formErros = array();

                        if (strlen($user) < 4)  {
                              $formErros [] = 'User name cant be less than 4 characters';
                        } 
                        if (strlen($user) > 20)  {
                              $formErros [] = 'User name cant be Mor than 20 characters';
                        }  
                        
                        if (empty($user))  {
                              $formErros [] = ' User Name Cant Be Empty!';
                        } 
                        if (empty($pass))  {
                              $formErros [] = ' password Cant Be Empty!';
                        } 
                     
                        if (empty($email))  {
                              $formErros [] = 'Emai Cant Be Empty!';
                        } 
                        if (empty($name))  {
                              $formErros [] = 'Full Name Cant Be Empty!';
                        } 

                        // loop into errors arry and echo 
                        foreach ($formErros as $error) {
                              echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        }

                        // check if thers  no error recourd the Update operation
                        if (empty($formErros)) { 
                              
                              //Insert user info in database 
                              $stmt = $con->prepare("INSERT INTO users (Username, PassWord, email, FullName)
                              VALUES (:zuser, :zpass, :zemail, :zfullname)");
                             $stmt->execute(array('zuser' =>$user,'zpass' => $hashpas, 'zemail' => $email, 'zfullname' => $name ));
                       
                              

                              echo "<div class='alert alert-success'role='alert'>" . $stmt->rowCount() . 'Recourd Insert <div/>' ;
                        }     

                  }
                        
                  
            else {
                  $errorMsg ="Erorr in pages Update Not Found";
                  RedirectHome ($errorMsg, 4);
            }

            echo  "<div/>";

            
            }elseif ($do == 'edit'){

                        // check if get request userid is numeric & get the integer value of it 
                        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

                        // Select all data Debend on this ID  
                         $stmt = $con->prepare("SELECT * FROM users WHERE USerID = ? LIMIT 1");
                         // Execute Query 
                        $stmt->execute(array($userid));
                        // fetch Data
                        $row = $stmt->fetch();
                        // the Row count 
                        $count = $stmt->rowCount();

                              if ($stmt->rowCount() > 0) { ?>
                                  <h1 class="text-center" style="margin: 30px 0;">Edit Member</h1>
                                    <div class="container">
                                       <form class="form-horizontal" action="?do=update" method="POST">
                                          <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                                         <!-- start user name field -->
                                          <from class="form-horizontal">
                                                <div class="form-group mb-3 row">
                                                <label  class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" name="Username" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required">
                                                </div>
                                                </div>
                                                                  
                                          <!-- End user name field -->
                                          
                                          <!-- End password field -->
                                          
                                                <div class="form-group mb-3 row">
                                                <label  class="col-sm-2 col-form-label">password</label>
                                                <div class="col-sm-10">
                                                <input type="hidden" name="oldpassword" value="<?php echo $row['PassWord'] ?>">
                                                <input type="password" class="form-control"  name="newpassword" autocomplete="new-password">

                                                </div>
                                                </div>
                                                                  
                                          <!-- End password field -->
                                          <!-- End Email field -->
                                          
                                                <div class="form-group mb-3 row">
                                                <label  class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                <input type="Email" class="form-control" value="<?php echo $row['email'] ?>" name="Email" required="required">
                                                </div>
                                                </div>
                                                                  
                                          <!-- End Email field -->
                                          
                                          <!-- End Fullname field -->
                                          
                                                <div class="form-group-lg mb-3 row">
                                                <label  class="col-sm-2 col-form-label">Fullname</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $row['FullName'] ?>" name="Fullname" required="required">
                                                </div>
                                                </div>
                                                                  
                                          <!-- End Fullname field -->
                                    
                                          
                                                      <div class="col-sm-ofset-2 col-sm-10">
                                                      <input type="submit"  value="save" class="btn btn-primary">
                                                      
                                                      </div>
                                                                  
                                          <!-- End Fullname field -->
                                          </from>
                                       </form>
                                         
                                          
                                    </div>                    
                                <?php 
                              } else {
                                    $errorMsg= "Not found this Id ";
                                    RedirectHome($errorMsg, 4);
                              }

            } elseif ($do == 'update') {
                  echo "<h1 class='text-center' style='margin: 30px 0;'> Update Member</h1> ";
                  echo "<div class='container'>";
                  if ($_SERVER['REQUEST_METHOD'] =='POST') {
                        $id =     $_POST['userid'];
                        $user=    $_POST['Username'];
                        $email=    $_POST['Email'];
                        $name =    $_POST['Fullname'];

                        // password trick
                        $pass = empty ($_POST['newpassword']) ?$pass = $_POST['oldpassword'] : $pass = sha1($_POST['newpassword']) ;

                        // validate the form
                        $formErros = array();

                        if (strlen($user) < 4)  {
                              $formErros [] = 'User name cant be less than 4 characters';
                        } 
                        if (strlen($user) > 20)  {
                              $formErros [] = 'User name cant be Mor than 20 characters';
                        }  
                        
                        if (empty($user))  {
                              $formErros [] = ' User Name Cant Be Empty!';
                        } 
                     
                        if (empty($email))  {
                              $formErros [] = 'Emai Cant Be Empty!';
                        } 
                        if (empty($name))  {
                              $formErros [] = 'Full Name Cant Be Empty!';
                        } 

                        // loop into errors arry and echo 
                        foreach ($formErros as $error) {
                              echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        }

                        // check if thers  no error recourd the Update operation
                        if(empty($formErros)) { 
                              
                              //update the database with this info  
                              $stmt= $con->prepare("UPDATE users SET Username = ?, email = ?, Fullname = ?, password = ? WHERE UserID = ? ");
                              $stmt->execute(array($user, $email ,$name, $pass, $id ));
                              

                              echo "<div class='alert alert-success'role='alert'>" . $stmt->rowCount() . 'Recourd Updated <div/>' ;
                        }     

                  }
                        
                  
            else {
                  $errorMsg= "Erorr in pages Update Not Found";
                  RedirectHome($errorMsg, 4);
            }

            echo  "<div/>";
      }elseif($do = 'Delete') { // delete page
            
            echo "<h1 class='text-center' style='margin: 30px 0;'> Update Member</h1> ";
                  echo "<div class='container'>";


                           // check if get request userid is numeric & get the integer value of it 
                           $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

                           // Select all data Debend on this ID  
                           $stmt = $con->prepare("SELECT * FROM users WHERE USerID = ? LIMIT 1");
                           // Execute Query 
                           $stmt->execute(array($userid));
                                                    
                           // the Row count 
                           $count = $stmt->rowCount();
   
                                 if ($stmt->rowCount() > 0) { 


                                    $stmt= $con->prepare("DELETE FROM users WHERE UserID = :zuser");
                                    $stmt->bindparam(":zuser",$userid);
                                    $stmt->execute();
                                    echo "<div class='alert alert-success'role='alert'>" . $stmt->rowCount() . 'Deleted Updated <div/>' ;


                                 }else {
                                    $errorMsg= "This Id IS Not Found";
                                    RedirectHome($errorMsg, 4);
                                 }                  

                  echo  "<div/>";         

       }

                   include $tpl . "footer.php";
}


    else {

         header('Location: index.php');

         exit();
      }
      

   