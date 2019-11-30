<?php
include 'conection/connLocalhost.php';
$query= "SELECT * FROM comentarios";

$rerQueryComent = mysqli_query($connLocalhost, $query);
if (!$rerQueryComent) {
   die('MY sql query failed'.mysqli_error($connLocalhost));
}
$json=array();
while($row= mysqli_fetch_array($rerQueryComent)){
    $json[]=array(
        'nameUser' =>$row['nameUser'],
        'description'=>$row['comentario'],
        'idUser'=>$row['idUser'],
        'id'=>$row['id']
    );
}
$jsonString =json_encode($json);
echo $jsonString;
?>