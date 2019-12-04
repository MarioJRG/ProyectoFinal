<?php
include 'conection/connLocalhost.php';
if(!isset($_SESSION)) {
    session_start();
    if(!isset($_SESSION['userId'])) header('Location: login.php?authError=true');
  }

  $resQueryUserEdit = "SELECT * FROM userinfo WHERE id ='".$_SESSION['userId']."'";
  $resul=mysqli_query($connLocalhost,$resQueryUserEdit) or trigger_error("There was an error recovering the user data...");
  $valores = mysqli_fetch_assoc($resul);
  print_r($_SESSION['userId']);
  if(isset($_POST['sent'])){
        //verificar que los campos esten llenos
        foreach ($_POST as $key => $value) {
                if ($value == "") {
                     $error[]= "The field $key is required";   
                }
        }
        
        if ($valores['password']!=$_POST['password']) {
            $error[]="password does not mach";
        }


        //Guardar datos en la BD
        if(!isset($error)) {
                // Definimos el query a ejecutar
                $queryUserAdd = sprintf("UPDATE userinfo SET name = '%s', lastname = '%s' WHERE id = ".$_SESSION['userId'],
                    mysqli_real_escape_string($connLocalhost,trim($_POST['name'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['lastname']))    
                    
                );
                // Ejecutamos el query y cachamos el resultado
                $resQueryUserAdd = mysqli_query($connLocalhost, $queryUserAdd) or trigger_error("The user insert query failed...");
                // Redireccionamos al usuario si todo salio bien
                if($resQueryUserAdd) {
                    if($_POST['name'] != $valores['name'] OR $_POST['lastname'] != $valores['lastname']) {
                        $_SESSION['userFullname'] = $_POST['name']." ".$_POST['lastname'];
                      }
                  header("Location: indexUser.php?userEdit=true");
                }
              }
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  
  <title>Project</title>
  

  
</head>
<body>

<section  class="header header--bg">
    <div class="container about__container--narrow">
      
        <h2 class="page-section__title">Editar Cuenta</h2>
         
        
          <form action="userEdit.php" method="post">
    	    <table class="aliniamiento">
  		        <tr>
  			<td><label for="name" class="page-section__title2" >Name:*</label></td>
  			<td><input type="text" name="name" value="<?php echo $valores['name']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="lastname"  class="page-section__title2">Last name:*</label></td>
  			<td><input type="text" name="lastname" value="<?php  echo $valores['lastname']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="email"  class="page-section__title2">E-mail:*</label></td>
  			<td><input type="text" name="email" disabled value="<?php echo $valores['email']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="password"  class="page-section__title2">Password:*</label></td>
  			<td><input type="password" name="password" /></td>
  		        </tr>
              
          <td><label for="role"  class="page-section__title2">Role:</label></td>
                 <td>
          <select name="role">
                  <?php
                        if ($_SESSION['role']=="admin") {
                               
                        
                  ?>
            <option value="admin" selected="selected">Admin</option>

            <?php
                        }
?>
            <option value="usuario">User</option>
          </select>
                </td>
                </tr>     
  		        <tr>
  			<td><input type="submit" class="bottom_save" value="Save user" name="sent" /></td>
  			<td>&nbsp;</td>
  		        </tr>
   	 </table>
     </form>
     <?php 
    if(isset($error)){
   foreach ($error as $key => $value) {         
        echo "<div class=\"error_msg\">$value</div>";     

   }
    } 
  ?>
    </div>
     </section>




      <?php
include 'include/footer.php';
    ?>
</body>
</html>