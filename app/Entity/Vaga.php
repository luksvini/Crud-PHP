<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;
use App\Interface\Implementacao;

// Encapsulamento implementando uma interface
class Vaga implements  Implementacao {

    // Variaveis da vaga
    public $id;
    public $titulo;
    public $descricao;
    public $ativo;
    public $data;


    // Método responsável por cadastrar uma nova vaga no banco
    public function cadastrar(){
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        // Instancia de um novo objeto de Database
        $obDataBase = new Database('vagas');
        //INSERIR A VAGA NO BANCO
        $this->id = $obDataBase ->insert([
                                        'titulo' => $this->titulo,
                                        'descricao'=>$this->descricao,
                                        'ativo'=>$this->ativo,
                                        'data'=>$this->data,
                                        ]);

          return true;
          
        }

        // Método responsável por excluir a vaga no banco
        public function excluir(){
            // Retorna a criação de um objeto Database utilizando o método delete
            return (new Database('vagas'))->delete('id = '. $this->id);
        }
        
     
        // Metódo responsável por atualizar a vaga no banco 
        public function atualizar(){
            // Retorna a criação de um objeto Database utilizando o método update
            return (new Database('vagas'))->update('id = '. $this->id, [
                                            'titulo' => $this->titulo,
                                            'descricao'=>$this->descricao,
                                            'ativo'=>$this->ativo,
                                            'data'=>$this->data,

                                             ]);

    
        }


    //  Método responsável por obter as vagas do banco de dados
    public static function getVagas($where = null, $order = null, $limit = null){

        // Retorna a criação de um objeto Database utilizando o método select
        return (new Database('vagas'))->select($where,$order,$limit)
                                    
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
                                  
    }

    //  Método responsável por obter a quantidade das vagas do banco de dados
    public static function getQtdVagas($where = null){

    // Retorna a criação de um objeto Database utilizando o método select
    return (new Database('vagas'))->select($where, null, null, 'COUNT(*) as qtd')
                                
                              ->fetchObject()
                              ->qtd;
                              
}

   //  Método responsável por buscar uma vaga com base em seu Id
    public static function getVaga($id){
        // Retorna a criação de um objeto Database utilizando o método select utilizando o id
        return (new Database('vagas'))->select(' id = ' .$id )
                                    ->fetchObject(self::class);

    }

}