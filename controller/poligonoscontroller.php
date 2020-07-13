<?php 

/**
 * @author Paulo Miranda
 * Classe de controller responsavel pela chamada dos metodos para criacao de um poligono
 */

// Inclusao da classe de modelo para criacao de poligonos
require_once ("../model/poligonos.php");

class PoligonoController {


    function cadastrar($obj)
    {
        
        $poligono = new Poligono();
       
        return $poligono->cadastrarPoligono($obj);
      
    } // FIM cadastrar


    function somaAreas()
    {
        
        $poligono = new Poligono();
       
        return $poligono->somaAreas();
      
    } // FIM somaAreas
    
} // FIM classe Poligonos.php

?>

