<?php

include 'conection/connLocalhost.php';
if(!isset($_SESSION)) {
    session_start();
  }
if(isset($_POST['sent'])) {
    // validamos campos vacios
    foreach ($_POST as $calzon => $caca) {
      if($caca == "") $error[] = "The field $calzon is required";
    }
    
    if(!isset($error)) {
        // Armamos la consulta con datos sanitizados
        $queryLoginUser = sprintf("SELECT id, name, lastname, email,role FROM userinfo WHERE email = '%s' AND password = '%s'",
            mysqli_real_escape_string($connLocalhost, trim($_POST['email'])),
            mysqli_real_escape_string($connLocalhost, trim($_POST['password']))
        );
        // Ejecutamos el query
        $resQueryLoginUser = mysqli_query($connLocalhost, $queryLoginUser) or trigger_error("The query for user validation has failed");
        //Evaluamos el resultado, si es exitoso, creamos los indices de sesión
        if(mysqli_num_rows($resQueryLoginUser)) {
          // Hacemos un fetch del resultset
          $userData = mysqli_fetch_assoc($resQueryLoginUser);
          // Definimos los indices de sesión
          $_SESSION['userId'] = $userData['id'];
          $_SESSION['userEmail'] = $userData['email'];
          $_SESSION['userFullname'] = $userData['name'].' '.$userData['lastname'];
          $_SESSION['role'] = $userData['role'];
          
          // Una vez definidos los indices de sesion realizamos una redirección hacia Control Panel

          header("Location: indexUser.php?login=true");
          
        }
    }else {
        $error[] = "Identification error";
      }
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
</head>
<body>
<section  class="header header--bg">
    <div class="container about__container--narrow">
    
    <h1 class="page-section__title">Login</h1>
    
    <form action="login.php" method="post">
  	
      <table class="login">
  		<tr>
  			<td><label for="email">E-mail:*</label></td>
  			<td><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></td>
  		</tr>
          
  		<tr>
  			<td><label for="password">Password:*</label></td>
  			<td><input type="password" name="password" /></td>
  		</tr>
               <br>
          <br>    
  		<tr>
  			<td><input type="submit" value="Login" name="sent" /></td>
  			<td>&nbsp;</td>
  		</tr>
  	</table>
  </form>
    </div>
</section>
<?php 
    if(isset($error)){
   foreach ($error as $key => $value) {         
        echo "<div class=\"error_msg\">$value</div>";     

   }
    } 
  ?>
    <?php
include 'include/footer.php';
    ?>
</body>
</html>