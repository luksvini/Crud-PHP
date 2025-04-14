<?php 

include __DIR__.'/vendor/autoload.php';

// Titulo de forma dinâmica porque a mesma página pode ser utilizada por essa classe e cadastrar.php
define('TITLE','Editar vaga');

// Usando a classe Vaga
use \App\Entity\Vaga;


// Verifica se existe um Id que vem da vaga, se não existir ou não for númerico
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){

    // manda para o index com status de error
    header('location: index.php?status=error');
    exit;
}

/* Cria uma instancia de classe Vaga e faz 
Consulta se existe a vaga atráves do Id (utilizando o método getVaga)
*/
$obVaga = Vaga::getVaga($_GET['id']);

// Debug
// echo "<pre>";
// print_r($obVaga);
// echo "</pre>";
// die();
 

// Verifica se a vaga não for uma instancia da classe (o Id não existir)
if(!$obVaga instanceof Vaga){
    // manda para o index com status de error
    header('location: index.php?status=error');
    exit;

}


// Verifica se os campos de titulo, descrição e ativo existem
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'] )){
    
    // Atualizando a vaga
    $obVaga ->titulo = $_POST['titulo'];
    $obVaga ->descricao = $_POST['descricao'];
    $obVaga ->ativo = $_POST['ativo'];

    // Método para atualizar
    $obVaga -> atualizar();
    


    // Envia para o index com status de sucesso
    header('location: index.php?status=success');
    exit;


}

// Incluindo as paginas necessárias
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';


?>