<?php 

/**
 * @author Paulo Miranda
 * Classe de conexao ao banco de dados
 */

class ConnDB {

    private $host     = "localhost";
    private $dbName   = "formas_geometricas";
    private $username = "root";
    private $password = "root";
    

    public $conn;

    // Retorna a conexao com o banco de dados
    public function getConnection() {
        
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            
        
        } catch (PDOException $exception) {
            echo " Ocorreu um erro ao conectar com o banco de dados ". $exception->getMessage();
        }

        return $this->conn;
    } // FIM getConnection




} // FIM class ConnDB

?>

