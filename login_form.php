<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="bootstrap\css\font-awesome-5.8.1.css">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
    <link rel="stylesheet" href="bootstrap\css\mdb.css">
    <link rel="stylesheet" href="bootstrap\css\style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>PHP</title>
</head>

<body>
   <!-- Nav bar-->

   <nav class="navbar navbar-expand-sm navbar-dark bg-teal fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand">
                <i class="fa fa-plane-departure"></i> PHP</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#travel-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="travel-navbar">
                <ul class="navbar-nav ml-auto">
                    

                    <li class="nav-item px-3">
                        <a href="registration_user.html" class="nav-link">
                            <h4>Registration</h4>
                        </a>

                        <li class="nav-item px-3">
                        <a href="loginn.html" class="nav-link">
                            <h4>login</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
 <!-- Main Footer -->
 <footer class="p-3 mt-3 bg-teal text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                <?php 
                   session_start();
                   include_once 'connection.php';
                  
                   $conn = oci_connect("work","work", "localhost/XE");
                  
                   if (!$conn) {
                       $e = oci_error();
                       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                   }
                  
                 
                           if(isset($_POST['submit'])){
                           $user = $_POST['username'];
                           $pass = $_POST['password'];
                           $s = oci_parse($conn, "select username,user_password,flag from user_account where username='$user' and user_password='$pass'");       
                           oci_execute($s);
                           $row = oci_fetch_array($s, OCI_ASSOC);

                           if($user=="test" and $pass=="test"){  

                              
                               echo '<table  width="600" height="100" border="1" cellpadding="1" cellspacing="1">
                               <tr> 
                               <th>name</th>
                               <th>email</th>
                               <th>condition</th>
                               
                               </tr>';

                               $stid = oci_parse($conn, 'SELECT unique username,user_email,flag FROM user_account');
                                 oci_execute($stid);
                                 
                               while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)
                               {
                                   if($row[2]!=1){
                                    
                                   
                                    $_SESSION['favcolor']=$row[0]; 
                                     $_SESSION['animal']=$row[1];
                                   echo "<tr>";
                                   echo "<td>$row[0]</td>"  ;  
                                    echo "<td>$row[1]</td>";
                                  
                                   echo '<td>
                                   
                                   
                                
                                   <form  action ="some.php" method="post">
                                   
                                   <button type="submit"  name="accept"><h6><div style="color:brown">Accept</div></h6></button>
                               <button type="submit"  name="ignore"><h6><div style="color:brown">Ignore</div></h6></button>
                                  
                                 
                               </form>
                                       </td>';
                                   
                                      echo "</tr>";

                                     
                                    
                                     
                                      
                                   }

                           }
                                       
                           echo'<a href="loginn.html" class="nav-link">
                                       <h4>logout</h4>';            
                                
                       }
                           else if($row){
                              
                               $stid = oci_parse($conn,  "select username,user_password,flag from user_account where username='$user' and user_password='$pass'");
                               oci_execute($stid);
                               
                               while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                                   
                                   if($row[2]==1){
                                       echo "successfully logged in";
                                       echo'<a href="loginn.html" class="nav-link">
                                       <h4>logout</h4>';
                                       
                                   }
                                   else
                                   {
                                       echo "Thanks for
                                       doing registration. We are now reviewing your application. We will send you a mail once your
                                       account is accepted and verified by the website Admin";
                                   }
                               }
                           }

                           }

                   

                    
                ?>
               

                </div>
            </div>
        </div>
    </footer>

    <!-- Contact Section -->
   

    
    


    <!-- bootstrap Js file -->
    <script src="bootstrap\js\jquery.js"></script>
    <script src="bootstrap\js\popper.min.js"></script>
    <script src="bootstrap\js\bootstrap.js"></script>
    <script src="bootstrap\js\mdb.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 3200,
            pause: 'hover'
        });
    </script>
    <script type="text/javascript">
        AOS.init({
            duration: 1500,
        })
    </script>
</body>

</html>