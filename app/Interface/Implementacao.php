<?php 

namespace App\Interface;

interface Implementacao{

    // Métodos da interface para serem utilizados na classe
    public function cadastrar();

    public static function getVagas($where = null, $order = null, $limit = null);

    public static function getVaga($id);

    public function atualizar();

    public function excluir();



}

?>