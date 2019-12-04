<?php
include 'conection/connLocalhost.php';
    if(!isset($_SESSION)) {
        session_start();
        if(!isset($_SESSION['userId'])) header('Location: login.php?authError=true');
      }

$query ="SELECT * FROM movieinfo";
$resul= mysqli_query($connLocalhost,$query) or trigger_error("Error Query");
$numMovie= mysqli_num_rows($resul);
$movieDetails=mysqli_fetch_assoc($resul);
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
<section  class="header header--bg">
    <div class="container about__container--narrow">
        <h1>List Movie</h1>
        <h2>Actualmente se cuanta con <?php echo $numMovie?> Sinopsis en la Base de Datos</h2>
<?php
do {
    

?>
    <ul class="cambiar_text"> 
        <li>
        <p><img src="data:image/jpg;base64,<?php echo base64_encode($movieDetails['imgenRuta']);?>"width="55px" height="50px"/></p> 
    <p class="nombreUsuario">Nombre: <?php echo $movieDetails['name'].' | Actores: '.$movieDetails['actors'].' | Categoria: '.$movieDetails['category'].' | Clasificacion: '.$movieDetails['classification'] ?></p>
      <p class="accionesUsuario"><a href="ListMovieEdit.php?movieId=<?php echo $movieDetails['id'];?>">Edit</a> | <a href="movieDelete.php?movieId=<?php echo $movieDetails['id'];?>">Delete</a></p>
    
    </li>
    </ul>
    <?php
} while ($movieDetails = mysqli_fetch_assoc($resul));
    ?>
    </div>
</section>


    <?php
    include "include/footer.php";
    ?>
</body>
</html>