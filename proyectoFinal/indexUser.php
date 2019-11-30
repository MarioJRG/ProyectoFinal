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
    <link rel="stylesheet" href="include/css/styles.css">
  <link rel="stylesheet" href="include/css/styles2.css">
    <link rel="stylesheet" href="include/assets/fonts/flat-icon/flaticon.css">
  <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">

<body>
  <?php
  $role = $_SESSION['role'];
  $fullname = $_SESSION['userFullname'];
  $id = $_SESSION['userId'];
  $email = $_SESSION['userEmail'];
  $querySelectuserImg=sprintf("SELECT * FROM userimg  WHERE idUser = '%d' ORDER by id desc LIMIT 1",
  mysqli_real_escape_string($connLocalhost,trim("$id"))
  
 );

 $resQuerySelecUserImg = mysqli_query($connLocalhost, $querySelectuserImg) or trigger_error("The query for user validation has failed");

  if(isset($_POST['enviar'])){
    if(isset($_FILES['img'])){
        $nombreimg=$_FILES['img']['name'];
        $ruta=$_FILES['img']['tmp_name'];
        $imagen=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $destino="proyectoFinal/".$nombreimg;

            $queryUserimg = "INSERT INTO userimg (idUser,nombre,ruta) VALUES ('$id','$nombreimg','$imagen')";
        $resQueryUserAdd = mysqli_query($connLocalhost, $queryUserimg);

        if ($resQueryUserAdd) {
            echo '<script type="text/javascript">alert("Agregado Correctamente");window.location="indexUser.php";</script>';
        }else{
            die("Error".mysqli_error($connLocalhost));
        }

    }
  }
  
 
    if(isset($_POST["buscar"])){
        if ($_POST["nombrePeli"]=="") {
            $error[]="searh no define";
        }
        $queryMovieSearch = sprintf("SELECT * FROM movieinfo WHERE name = '%s'",
            mysqli_real_escape_string($connLocalhost, trim($_POST["nombrePeli"]))
        );
        // Ejecutamos el query
        $resQueryMovieSearch = mysqli_query($connLocalhost, $queryMovieSearch) or trigger_error("The query for user validation has failed");
        if (mysqli_num_rows($resQueryMovieSearch) == 0) {
            $error[]="Titulo no encontrado";
        }
        if (!isset($error)) {
            $_SESSION["nombre"]=$_POST["nombrePeli"];
            header("Location: viewMovie.php?view=true");
        }
        
        }
  
 

  ?>
<section  class="header header--bg">

    <div class="container emp-profile">
            <form method="post" action="indexUser.php" enctype="multipart/form-data" >
            <div class="row">

                    <div class="col-md-4">
                        <div class="profile-img">
                        <?php

                               $data=mysqli_fetch_assoc($resQuerySelecUserImg)
                                    ?>

                                    <img src="data:image/jpg;base64,<?php echo base64_encode($data['ruta']);?>"width="350px" height="300px"/>
                                    

                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="img"/>
                                <input type="submit" value="aceptar" name="enviar"/>
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

                                        Web Developer and Designer;

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

                            </div>


                    </div>

                </div>
            </form>
            <?php
                if ($role == "usuario") {


            ?>
            <form action="indexUser.php" method="post">
                <div class="letra_tamno">
                    <label class="cambiar_text" >Ingrese el nombre de la pelicula</label>
            <tr><input type="text"></tr>
            <tr><input type="submit" value="Buscar" name="buscar" ></tr>
            <h4><li><a href="userEdit.php" style="color:#000000;">Editar tu perfil</a></li></h4>
                    </div>

            <br>
            <tr><input type="submit" value="LogOut" name="salir" ></tr>


            </form>
            <?php
               }
            ?>
            <?php
            
            
                if ($role == "admin") {


            ?>
            <form action="indexUser.php" method="post">
                <div class="">
                    <ul>
                    <h4><li><a href="userAdd.php" style="color:#000000;">Agregar nuevo Admin</a></li></h4>
                    <h4><li><a href="movieAdd.php" style="color:#000000;">Agregar Nueva pelicula</a></li></h4>
                    <h4><li><a href="userEdit.php" style="color:#000000;">Editar tu perfil</a></li></h4>
                    <h4><li><a href="#" style="color:#000000;">Ver reportes</a></li></h4>
                    <div class="letra_tamno">
                    <label class="cambiar_text" >Ingrese el nombre de la pelicula</label>
            <tr><input type="text" name="nombrePeli"></tr>
            
            <tr><input type="submit" value="Buscar" name="buscar" ></tr>
                    </div>


                    </ul>



                    </div>
                    <tr><input type="submit" value="LogOut" name="salir" ></tr>
            <br>



            </form>
            <?php
               }
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
</body>
</html>
