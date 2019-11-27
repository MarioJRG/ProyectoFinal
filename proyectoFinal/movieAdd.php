<?php
include 'conection/connLocalhost.php';
if(!isset($_SESSION)) {
  session_start();
  if($_SESSION['role'] != "admin") header('Location: login.php?authError=true');
}

if(isset($_POST['sent'])){
        //verificar que los campos esten llenos
        foreach ($_POST as $key => $value) {
                if ($value == "") {
                     $error[]= "The field $key is required";
                }
        }
        
        if(isset($_POST['movieName']) && isset($_POST['movieName']) != "") {
                $queryValidateEmail = sprintf("SELECT id FROM movieinfo WHERE name = '%s'",
                  mysqli_real_escape_string($connLocalhost, trim($_POST['movieName']))
                );
                // Ejecutamos el Query y obtenemos un recordset debido a que el query es de tipo SELECT
                $resQueryValidateEmail = mysqli_query($connLocalhost, $queryValidateEmail) or trigger_error("error_msg");
                // Contamos cuantos registros fueron devueltos por la consulta anterior, si obtenemos un numero distinto de 0 quiere decir que el correo ya está siendo utilizado
                if(mysqli_num_rows($resQueryValidateEmail) != 0) {
                  $error[] = "The Movie Name is already in use...";
                }
              }
         if (isset($_POST['img'])) {
           $error[]="imagen no selected";
         }     

              

        //Guardar datos en la BD
        if(!isset($error)) {
          
        
        $imagen=addslashes(file_get_contents($_FILES['img']['tmp_name']));
                // Definimos el query a ejecutar
                $queryUserAdd = sprintf("INSERT INTO movieinfo (name, actors, description, category,classification, imgenRuta) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
                    mysqli_real_escape_string($connLocalhost,trim($_POST['movieName'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['actor'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['descripcion'])),
                    mysqli_real_escape_string($connLocalhost,trim($_POST['categoria'])),

                    mysqli_real_escape_string($connLocalhost,trim($_POST['clasificacion'])),
                    $imagen
                );
                // Ejecutamos el query y cachamos el resultado
                $resQueryUserAdd = mysqli_query($connLocalhost, $queryUserAdd) or trigger_error("The user insert query failed...");
                // Redireccionamos al usuario si todo salio bien
                if($resQueryUserAdd) {
                  header("Location: indexUser.php?userAdd=true");
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

        <h2 class="page-section__title">Movie Add</h2>


          <form action="movieAdd.php" method="post" enctype="multipart/form-data">
    	    <table class="aliniamiento">
  		        <tr>
  			<td><label for="movieName" class="page-section__title2" >Nombre de la pelicula:</label></td>
  			<td><input type="text" name="movieName" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" /></td>
  		        </tr>
              <br>
  		        <tr>
  			<td><label for="actor"  class="page-section__title2">Actores:*</label></td>
  			<td><input type="text" name="actor" value="<?php if(isset($_POST['actor'])) echo $_POST['actor']; ?>" /></td>
  		        </tr>
                          <br>
  		        
  		        <tr>
  			<td><label for="descripcion"  class="page-section__title2">Descripcion:*</label></td>
  			<td><textarea  name="descripcion" /></textarea></td>
  		        </tr>
                
          <td><label for="categoria"  class="page-section__title2">Categoria:</label></td>
                 <td>
          <select name="categoria">
            <option value="terror" selected="selected">Terror</option>
            <option value="comedia">Comedia</option>
            <option value="aventura">Aventura</option>
            <option value="romance">Romance</option>
            <option value="guerra">Guerra</option>
            <option value="cienciaFiccion">Ciencia Ficcion</option>
            <option value="musicales">Musicales</option>

            
          </select>
                </td>
                </tr>
                <td><label for="clasificacion"  class="page-section__title2">Clasificacion:</label></td>
                 <td>
          <select name="clasificacion">
            <option value="AA" selected="selected">AA</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="B15">B15</option>
            <option value="C">C</option>
            <option value="D">D</option>
            

            
          </select>
                </td>
                </tr>
                <tr><td><label for="img" class="page-section__title2">Seleccione Imagen</label> 
                <input type="file" name="img"/></td>
                </tr>
                <tr>
  			<td><input type="submit" class="bottom_save" value="Save Movie" name="sent" /></td>
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
