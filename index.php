<?php 

include '/controller/poligonoscontroller.php';
include '/model/poligonos.php';

$metodo = $_GET['metodo'];
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);


if(empty($metodo)) 
{
    echo "metodo invalido";

    exit;
}    



if($metodo  == "criar")
{
    if(!empty($data))
    {  
         
         $obj = new Poligono();
         
         $obj->setNomePoligono($data->nomePoligono);
         $obj->setBase($data->base);
         $obj->setAltura($data->altura);


         $controllerPoligono = new PoligonoController();
         $retorno            = $controllerPoligono->cadastrar($obj);


         if($retorno)
         {
            echo json_encode(array('mensagem' => 'Poligono criado com sucesso'))
         }   

    } 
}    

if($metodo  == "calcularArea")
{
    $controllerPoligono = new PoligonoController();
    $controllerPoligono->somaAreas();
}




?>

