<?php
if(!isset($_SESSION)) {
    session_start();
  }
  $id = $_SESSION['userId'];
include("conection/connLocalhost.php");

if ($_POST['description'] !="") {
    if(isset($_POST['name'])){
        $name =$_POST['name'];
        $description=$_POST['description'];
        $query="INSERT INTO comentarios(nameUser,comentario,idUser) VALUE('$name','$description','$id')";
        $resQueryInsertcoment = mysqli_query($connLocalhost, $query);
        if (!$resQueryInsertcoment) {
            die('Query Failed.');
        }
        echo 'Task Added Soccess';
    }
}

?>