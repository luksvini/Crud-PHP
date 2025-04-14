<?php 

namespace App\Interface;

interface DbInterface{



    // Métodos da interface para serem utilizados na classe
    
    public function insert($v);

    public function execute($query, $params = []);

    public function select($where = null, $order = null, $limit = null);

    public function update ($where, $v);

    public function delete($where);
    

    

    

}


?>