<?php
$data = file_get_contents("php://input");
$url = "https://apisgratis.com/cp/colonias/cp/?valor=$data";
$Json = json_decode(file_get_contents($url), true);
foreach ($Json as $datos) {
    $respuesta = array (
        "Ciudad"=>$datos["Ciudad"],
        "Colonia"=>$datos["Colonia"]
    );
    break;
}

echo json_encode($respuesta);

//var_dump($Json);
// echo json_encode($respuesta);
