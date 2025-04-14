<?php 

include __DIR__.'/vendor/autoload.php';


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

// Verifica se existe o botão de excluir
if(isset($_POST['excluir'] )){
   
    // Utiliza o método de excluir
    $obVaga -> excluir();

    // Manda para o index com status de success
    header('location: index.php?status=success');
    exit;


}


// Incluindo as paginas necessárias
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar_exclusao.php';
include __DIR__.'/includes/footer.php';


?>