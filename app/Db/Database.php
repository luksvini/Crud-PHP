<?php 

namespace App\Db;

use \PDOException;
use \PDO;
use App\Interface\DbInterface;

class Database implements DbInterface{

    // Variaveis do banco
    const HOST = 'localhost';

    const NAME = '_vagas';

    const USER = 'root';

    const PASS = '';

    private $table;
    private $connection; 

    // Construtor para criar uma tabela e utilizar o método setConnection
    public function __construct( $table = null){
        $this -> table = $table;
        $this -> setConnection();
        
    }

    // Método responsável por criar uma conexão com o banco de dados
    private function setConnection(){
        try{
            // Instancia do PDO para criar conexão com o banco
            $this -> connection = new PDO('mysql:host='.self::HOST.'; dbname='. self::NAME, self::USER, self::PASS);

            // Caso der algum erro
            $this -> connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Imprime a mensagem de erro
            die('Error: '. $e->getMessage());

        }
    }

    // Método responsável por executar queries dentro do banco de dados
    public function execute($query, $params = []){
        try{
            // Prepara a query
            $statement = $this->connection->prepare($query);

            // Executa a query
            $statement ->execute($params);

            // Retorna a query
            return $statement;

            // Se der algum erro
        }catch(PDOException $e){
            die('Error: '. $e->getMessage());
        }

    }

    // Método responsável por inserir dados no banco
    public function insert($v){
        //Dados da query
        $fields = array_keys($v); // Pega o que tem no array que vem na hora que o método é utilizado
        $binds = array_pad([] , count($fields), '?');  
    
        // Monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',',$binds).')'; // implode para inserir as variaveis que contem o array
        
        // Executa a query
        $this->execute($query, array_values($v));

        // Retorna o ID inserido
        return $this->connection->lastInsertId();
        
    }


    // Método responsável por realizar uma consulta no banco
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        // Dados da query
        $where = strlen($where) ? 'WHERE '. $where : '';
        $order = strlen($order) ? 'ORDER BY '. $order : '';
        $limit = strlen($limit) ? 'LIMIT '. $limit : '';

        // Monta a query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
        

        // Executa a query
        return $this->execute($query);

    }

    // Método responsável por executar atualizações no banco 
    public function update($where, $v){
        // Dados da query
        $fields = array_keys($v); //  Pega o que tem no array que vem na hora que o método é utilizado


        // Monta a query
        $query = 'UPDATE ' . $this->table . ' SET '.implode('=?,' , $fields).'=? WHERE ' .$where; // implode para inserir as variaveis que contem o array
        

        // Executar a query
        $this->execute($query, array_values($v));

        // Retorna verdadeiro
        return true;

    }

    // Método responsável por excluir dados do banco 
    public function delete($where){

        // Monta a query
        $query = 'DELETE FROM ' .$this->table . ' WHERE ' .$where;

        // Executar a query
        $this->execute($query);

        // Verifica se a tabela está vazia
        $queryCheck = 'SELECT COUNT(*) as total FROM ' . $this->table;
        $statement = $this->execute($queryCheck);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Se a tabela estiver vazia
        if($result['total'] == 0) {
            // Reseta o auto-increment
            $queryReset = 'ALTER TABLE ' . $this->table . ' AUTO_INCREMENT = 1';
            $this->execute($queryReset);
        }

        // Retorna true
        return true;
    }

 

}

?>