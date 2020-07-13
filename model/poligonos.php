<?php 

/**
 * @author Paulo Miranda
 * Classe responsavel pela criacao de poligonos e obtencao das suas medidas (areas)
 */

// Inclusao da classe de conexao com o banco de dados
require_once ("db/conexaoDB.php");

class Poligono {

    
   /*
    * Atributos da classe
    */
    private $nomePoligono;
    private $base;
    private $altura;


    private $conn;

   /*
    * Metodo Construtor
    */
    
    public function __construct() {
        
        // Instancia a conexao ao banco de dados
        $db  = new ConnDB();
        
        $this->conn = $db->getConnection();
    
    } // FIM __construct


   /*
    * Getters e Setters
    */

    public function setNomePoligono($nome)
    {
         $this->nomePoligono = $nome;
    } // FIM setNomePoligono

    public function setBase($base)
    {
         $this->base = $base;
    } // FIM setBase


    public function setAltura($altura = "")
    {
        $this->altura = $altura;
    } // FIM setAltura

    

    public function getNomePoligono()
    {
       return $this->nomePoligono;
    } // FIM getNomePoligono

    public function getBase()
    {
       return $this->base;
    } // FIM getBase


    public function getAltura()
    {
       return $this->altura;
    } // FIM getAltura

   

   /**
    * Cria um poligono no banco de dados
    * @param obj - Representacao de um objeto de poligono
    *
    */

    public function cadastrarPoligono($obj) 
    {
        
        // query para inserir o registro
        $query = " INSERT INTO poligonos (nomePoligono,base,altura) VALUES (:nomePoligono,:base,:altura) ";


        // Prepara a query
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nomePoligono", $obj->nomePoligono);

        $stmt->bindParam(":base", $obj->base);

        
        $stmt->bindParam(":altura", $obj->altura);


       
       

        // executa a query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } // FIM cadastrarPoligono


   /**
    * Retorna a soma de todas as areas de poligonos cadastrados
    * 
    *
    */
    
    public function somaAreas()
    {
        $query =  "SELECT area = case when poligonos.nome = 'retangulo' then sum(base *altura)
                                      when poligonos.nome = 'triangulo' then sum(base *altura)/2
                                      else 0
                                 end
                   FROM poligonos ";
        
        // Prepara a query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } // FIM somaAreas
   

} // FIM classe Poligonos.php

?>

