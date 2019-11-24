<?php
include 'conection/connLocalhost.php';
if(!isset($_SESSION)) {
        session_start();
        
      }
if(isset($_POST['sent'])){
        //verificar que los campos esten llenos
        foreach ($_POST as $key => $value) {
                if ($value == "") {
                     $error[]= "The field $key is required";   
                }
        }
        if($_POST['password'] != $_POST['password2']){
                $error[] = "The password doesn't match";

        }
        if(isset($_POST['email']) && isset($_POST['email']) != "") {
                $queryValidateEmail = sprintf("SELECT id FROM userinfo WHERE email = '%s'",
                  mysqli_real_escape_string($connLocalhost, trim($_POST['email']))
                );
                // Ejecutamos el Query y obtenemos un recordset debido a que el query es de tipo SELECT
                $resQueryValidateEmail = mysqli_query($connLocalhost, $queryValidateEmail) or trigger_error("error_msg");
                // Contamos cuantos registros fueron devueltos por la consulta anterior, si obtenemos un numero distinto de 0 quiere decir que el correo ya está siendo utilizado
                if(mysqli_num_rows($resQueryValidateEmail) != 0) {
                  $error[] = "The email is already in use...";
                }
              }


        //Guardar datos en la BD
        if(!isset($error)) {
                // Definimos el query a ejecutar
                $queryUserAdd = sprintf("INSERT INTO userinfo (name, lastname, email, password, role) VALUES ('%s', '%s', '%s', '%s', '%s')",
                    mysqli_real_escape_string($connLocalhost,trim($_POST['name'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['lastname'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['email'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['password'])),
                    
                    mysqli_real_escape_string($connLocalhost,trim($_POST['role']))
                );
                // Ejecutamos el query y cachamos el resultado
                $resQueryUserAdd = mysqli_query($connLocalhost, $queryUserAdd) or trigger_error("The user insert query failed...");
                // Redireccionamos al usuario si todo salio bien
                if($resQueryUserAdd) {
                  header("Location: login.php?userAdd=true");
                }
              }
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  
  <title>Project</title>
  <link rel="stylesheet" href="include/assets/fonts/flat-icon/flaticon.css">
  <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="include/css/styles.css">
  <link rel="stylesheet" href="include/css/styles2.css">

  
</head>
<body>

<section  class="header header--bg">
    <div class="container about__container--narrow">
      
        <h2 class="page-section__title">Login</h2>
         
        
          <form action="userAdd.php" method="post">
    	    <table class="aliniamiento">
  		        <tr>
  			<td><label for="name" class="page-section__title2" >Name:*</label></td>
  			<td><input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="lastname"  class="page-section__title2">Last name:*</label></td>
  			<td><input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="email"  class="page-section__title2">E-mail:*</label></td>
  			<td><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></td>
  		        </tr>
                          <br>
  		        <tr>
  			<td><label for="password"  class="page-section__title2">Password:*</label></td>
  			<td><input type="password" name="password" /></td>
  		        </tr>
                <tr>
          <td><label for="password2" class="page-section__title2">Repeat password:*</label></td>
          <td><input type="password" name="password2" /></td>
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