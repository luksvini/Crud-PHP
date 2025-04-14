<?php 

include __DIR__.'/vendor/autoload.php';

// Usando a classe Vaga
use App\Entity\Vaga;

use App\Db\Pagination;

// Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING );

// Filtro de Status
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING );

$filtroStatus = in_array($filtroStatus,['s','n'])? $filtroStatus : null;


// Condiçoes SQL
$condicoes =[ 
    strlen($busca) ? 'titulo LIKE "%' . str_replace(' ', '%', $busca) . '%"' : null,
    strlen($filtroStatus) ? 'ativo ="'.$filtroStatus.'"':null
];
$condicoes = array_filter($condicoes); // Remove os valores nulos
// Clausula WHERE
$where = implode(' AND ', $condicoes);

$qtdVagas = Vaga::getQtdVagas($where);

$obPagination = new Pagination($qtdVagas, $_GET['pagina'] ?? 1, 5);

// Instancia da classe Vaga e utliza o método getVagas e obtem as vagas
$vagas = Vaga::getVagas($where, null, $obPagination->getLimit());

// /* Debug
// */
// echo "<pre>";
// print_r($obPagination->getLimit());
// echo "</pre>";
// die();

// Incluindo as paginas necessárias
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';


?>