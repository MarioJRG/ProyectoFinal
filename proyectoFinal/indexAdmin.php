<?php
// Iniciamos o retomamos la sesión
if(!isset($_SESSION)) {
  session_start();
}
// Incluimos la conexión a la BD
include("conection/connLocalhost.php");
if(isset($_POST['salir'])){
    session_destroy();
    header('Location: index.php?logOut=true');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
    <link rel="stylesheet" href="include/assets/fonts/flat-icon/flaticon.css">
  <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="include/css/styles.css">
  <link rel="stylesheet" href="include/css/styles2.css">
<body>
  <?php
  $role = $_SESSION['role'];
  $fullname = $_SESSION['userFullname'];
  $id = $_SESSION['userId'];
  $email = $_SESSION['userEmail'];

  ?>
<section  class="header header--bg">
    
    <div class="container emp-profile">
            <form method="post">
            <div class="row">

                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="cambiar_text2">
                        <div class="profile-head">
                                    
                                        <?php
                                        echo "<h5>$fullname </h5>";
                                        ?>
                                    
                                    <h6>
                                      
                                        Web Developer and Designer
                                       
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                           
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                
                    <div class="col-md-8">
                    
                        <div class="tab-content profile-tab" id="myTabContent">
                        <div class="cambiar_text">
                            <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$id </p>";
                                        ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$fullname </p>";
                                        ?>
                                            </div>
                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$email </p>";
                                        ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Role</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$role</p>";
                                        ?>
                                            </div>
                                        </div>
                                        </div>
                                        <tr>
  			<input type="submit" value="LogOut" name="salir" >
  			
  		</tr>
                            </div>
                            
                        
                    </div>
                </div>
            </form>           
        </div>
    
</section>

<?php

include "include/footer.php";
      print_r($_SESSION);
      $role = $_SESSION['role'];
      echo "<br>";
      print_r($role)
  ?>
</body>
</html>