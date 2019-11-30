<?php
// Iniciamos o retomamos la sesión
if(!isset($_SESSION)) {
  session_start();
}
$nombrePeli=$_SESSION["nombre"];
// Incluimos la conexión a la BD
include("conection/connLocalhost.php");
$queryLoginUser = sprintf("SELECT * FROM movieinfo WHERE name = '%s'",
            mysqli_real_escape_string($connLocalhost, trim($nombrePeli))
        );
        // Ejecutamos el query
        $resQueryLoginUser = mysqli_query($connLocalhost, $queryLoginUser) or trigger_error("The query for user validation has failed");
        $movieData = mysqli_fetch_assoc($resQueryLoginUser);
        
$movieId=$movieData['id'];
$movieName=$movieData['name'];
$movieActors=$movieData['actors'];
$movieCategory=$movieData['category'];
$movieClassification=$movieData['classification'];
$movieDescription=$movieData['description'];
$movieRuta=$movieData['imgenRuta'];
$fullname = $_SESSION['userFullname'];
$id = $_SESSION['userId'];
if (isset($_POST['back'])) {
  header('Location: indexUser.php?login=true');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="include/css/styles.css">
  <link rel="stylesheet" href="include/css/styles2.css">
    <link rel="stylesheet" href="include/assets/fonts/flat-icon/flaticon.css">
  <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">

<body>
 
<section  class="header header--bg">

    <div class="container emp-profile">
            <form method="post" action="indexUser.php" enctype="multipart/form-data" >
            <div class="row">

                    <div class="col-md-4">
                        <div class="profile-img">
                        <br>
                       

                        <img src="data:image/jpg;base64,<?php echo base64_encode($movieData['imgenRuta']);?>"width="350px" height="300px"/>
                                    

                           
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="cambiar_text2">
                        <div class="profile-head">

                                   <h2>Movie Information</h2>  
                                   <div class="row">
                                            <div class="col-md-6">
                                                <label>Movie Id</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p> $movieId </p>";
                                        ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Movie Name</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$movieName </p>";
                                        ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Actors</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$movieActors</p>";
                                        ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$movieDescription</p>";
                                        ?>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label>category</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$movieCategory</p>";
                                        ?>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label>Classification</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                        echo "<p>$movieClassification</p>";
                                        ?>
                                        
                                            </div>
                                            

                                        </div>  

                        </div>
                    </div>
                    </div>
                </div>
                
            </form>
            
            <form action="viewMovie.php" method="post" id="task-form">
            <br>
            <div class="row">

                    <div class="col-md-7">
                    <tr>
                    <input style="visibility: hidden" id="id" value="<?php echo $id?>"> 
                    <br>
  			<td><label for="comentario"  class="letra">Comentario:*</label></td>
             <td><input type="text" id="name" disabled value="<?php echo $fullname?> "/></td> 
  			<td><textarea  id="description" name="comentario" /></textarea></td>
              <td><input type="submit" value="addComent" name="coment"></td>
  		        </tr>
                        <div class="#" id="comentario">
                        <div class="cambiar_text">
                        
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Comentario</td>
                            </tr>
                                </thead>   
                                <tbody id="task">
                                
                                </tbody>                             
                            </table>
                                        
                                           
                                            
                                        </div>
                                        
                            </div>

                            
                    </div>
                        
                </div>
            </form>
            <form action="viewMovie.php" method="post">
            <div class="row">

                    <div class="col-md-7">
            <tr><input type="submit" value="Back" name="back" ></tr>
            </div>
            </div>
            </form>
            
                    </div>
                    
            <br>



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
include "include/footer.php";
      
  ?>
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>
</html>

</body>
</html>