<?php
include 'conection/connLocalhost.php';

  if (isset($_POST['id'])) {
      $id=$_POST['id'];
      $nameCo=$_POST['nameC'];
      $userIdC=$_POST['userIdC'];
      $query="DELETE FROM comentarios WHERE idUser = $userIdC and id=$id";
      $resul=mysqli_query($connLocalhost,$query);
      if (!$resul) {
         die('Query Failed'); 
      }else{
          echo'Task delete soccefully';
      }

  }
?>