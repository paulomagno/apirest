<?php 

// Inclusao das classes 
include './controller/poligonoscontroller.php';
include './model/poligonos.php';

$metodo = '';

// Identifica a requisicao feita na url
if(isset($_REQUEST))
{
     // Recupera o valor informado na URl 
     $partesURL = explode("/",$_REQUEST['url']);
     $metodo    = $partesURL[1];
}


// Valida se o metodo foi informado na url
if(empty($metodo)) 
{
    echo "metodo invalido";
    exit;
}    

 
// Cadastra um poligono no banco de dados
if($metodo  == "criarPoligono")
{
    $data = file_get_contents('php://input');
    $obj =  json_decode($data);

    if(!empty($data))
    {  
         
         $objetoPoligono = new Poligono();
         
         $objetoPoligono->setNomePoligono($data->nomePoligono);
         $objetoPoligono->setBase($data->base);
         $objetoPoligono->setAltura($data->altura);


         $controllerPoligono = new PoligonoController();
         $retorno            = $controllerPoligono->cadastrar($objetoPoligono);


         if($retorno)
         {
            echo json_encode(array('mensagem' => 'Poligono criado com sucesso'));
         }   

    } 
}    

// Retorna a soma de todas as areas dos poligonos cadastrados
if($metodo  == "calcularArea")
{
    $controllerPoligono = new PoligonoController();
    $dadosCadastrados   = $controllerPoligono->somaAreas();
    $somaAreas          = 0;

    foreach ($dadosCadastrados as $indice ) 
    {
        $somaAreas += $dadosCadastrados[$indice]['area'];

         echo json_encode(array('mensagem' => 'Soma das areas dos poligonos '.$somaAreas));
    }
}




?>

