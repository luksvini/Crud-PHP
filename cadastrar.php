<?php 

include __DIR__.'/vendor/autoload.php';

// Titulo de forma dinтmica porque a mesma pсgina pode ser utilizada por essa classe e editar.php
define('TITLE','Cadastrar vaga');

// Usando a classe Vaga
use \App\Entity\Vaga;


// Instanciando um novo objeto da classe Vaga
$obVaga = new Vaga();


//  Verificando se existe alguma informaчуo nos campos
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'] )){
    $obVaga ->titulo = $_POST['titulo'];
    $obVaga ->descricao = $_POST['descricao'];
    $obVaga ->ativo = $_POST['ativo'];

    // Se sim, utiliza o mщtodo de cadastrar
    $obVaga -> cadastrar();

    // Manda para o header  com status de succes
    header('location: index.php?status=success');
    exit;


}


// Incluindo as paginas necessсrias
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';


?>