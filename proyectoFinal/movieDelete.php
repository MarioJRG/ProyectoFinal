<?php
include 'conection/connLocalhost.php';
if(!isset($_SESSION)) {
  session_start();
  if($_SESSION['role'] != "admin") header('Location: login.php?authError=true');
}

    
        $QueryMovieSearch= sprintf("SELECT * FROM movieinfo WHERE id = '%s'",
        mysqli_real_escape_string($connLocalhost,trim($_GET['movieId']))
    );
    $resQueryMovieSearch=mysqli_query($connLocalhost,$QueryMovieSearch) or trigger_error("The query failed..");
    $searchMovie = mysqli_fetch_assoc($resQueryMovieSearch);
    $mocie = $searchMovie['id'];
    
    
if (isset($_POST['back'])) {
    header('Location: indexUser.php?login=true');
  }

if(isset($_POST['sent'])){
        //verificar que los campos esten llenos
        foreach ($_POST as $key => $value) {
                if ($value == "") {
                     $error[]= "The field $key is required";
                }
        }
        
    
              

     
        //Guardar datos en la BD
        if(!isset($error)) {
          
        
        
                // Definimos el query a ejecutar
                $queryUserAdd = sprintf("DELETE FROM movieinfo WHERE id = '%d'",
                mysqli_real_escape_string($connLocalhost,trim($_POST['id']))
            );
                // Ejecutamos el query y cachamos el resultado
                $resQueryUserAdd = mysqli_query($connLocalhost, $queryUserAdd) or trigger_error("The user insert query failed...");
                // Redireccionamos al usuario si todo salio bien
                if($resQueryUserAdd) {
                  header("Location: ListMovie.php?movieDelete=true");
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

        <h2 class="page-section__title">Movie Delete</h2>

            
          
          <form action="movieDelete.php" method="post" enctype="multipart/form-data">
    	    <table class="aliniamiento">
            <tr>
            <td><input style="visibility: hidden" name="id" value="<?php echo $searchMovie['id']?>"></td>
            </tr>
            <tr>
            <td><img src="data:image/jpg;base64,<?php echo base64_encode($searchMovie['imgenRuta']);?>"width="250px" height="200px"/></td>
            </tr>
  		        <tr>
  			<td><label for="movieName" class="page-section__title2" >Nombre de la pelicula:</label></td>
  			<td><input type="text" disabled name="movieName" value="<?php echo $searchMovie['name']; ?>" /></td>
  		        </tr>
              <br>
  		        <tr>
  			<td><label for="actor"  class="page-section__title2">Actores:*</label></td>
  			<td><input type="text" name="actor" value="<?php  echo $searchMovie['actors']; ?>" /></td>
  		        </tr>
                          <br>
  		        
  		        <tr>
  			<td><label for="descripcion"  class="page-section__title2">Descripcion:*</label></td>
  			<td><textarea  name="descripcion" /><?php  echo $searchMovie['description']; ?></textarea></td>
  		        </tr>
<br>
                <tr>
              <td><input type="submit" class="bottom_save" value="Delete Movie" name="sent" /></td>
              <tr><td><input type="submit" name="back" value="BACK"></td></tr>
  			
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