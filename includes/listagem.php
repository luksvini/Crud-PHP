<?php 

 // Inicia uma váriavel de mensagem vazia
$mensagem ='';

// Se tiver um status (uma ação tiver sido executada e voltado para o index )
if(isset($_GET['status'])){

    // Caso desse status ter sido success, vai imprimir uma mensagem na tela informando
    switch($_GET['status']){
        case 'success':
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso! </div>';
            break;

            // Caso desse status ter sido error, vai imprimir uma mensagem na tela informando
        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada! </div>';
            break;
    }
}


// Inicia os resultados como vazio
$resultados = '';

// Percorre o array e imprime os resultados na tabela
foreach ($vagas as $vaga){
    $resultados .= '<tr>
    <td>'.$vaga->id.' </td>
    <td>'.$vaga->titulo.' </td>
    <td>'.$vaga->descricao.' </td>
    <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo' ).' </td>
    <td>'.date('d/m/Y  H:i', strtotime($vaga->data)).' </td>
    <td>
    <a href="editar.php?id='.$vaga->id.'">
    <button type="button" class="btn btn-primary">Editar</button>
    </a>

    <a href="excluir.php?id='.$vaga->id.'">
    <button type="button" class="btn btn-danger">Excluir</button>
    </a>

    
    </td>
    </tr>';
    
    
}

// Verifica se existem vagas cadastradas         / Se não existirem, imprime uma mensagem falando que não existem
$resultados = strlen($resultados) ? $resultados : '<tr> 
                                                        <td colspan="6" class="text-center">
                                                                Nenhuma vaga encontrada!
                                                        </td>
                                                    </tr>';

// GETS
unset($_GET['status']);
unset($_GET['pagina']);

$gets = http_build_query($_GET);


// Paginação                                                    
$paginacao = '';                           
$paginas = $obPagination->getPagesArray(); 
foreach($paginas as $key=>$pagina){
    $class = $pagina ['atual'] ? 'btn btn-primary' : 'btn btn-light';
    $paginacao .='<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                    <button type="button" class="btn'.$class.'">'.$pagina['pagina'].'</button>
                </a>';
}

?>

<main>

<!-- Imprime a mensagem caso haja um status -->
 <?=$mensagem?>

<section>
    <a href="cadastrar.php">
        <button class="btn btn-success">Nova vaga</button>
    </a>

    
</section>

<section>

<form action="" method="get">
    <div class="row my-4">
        <div class="col">
        <label for="">Buscar por titulo</label>
            <input type="text" name="busca" class="form-control" value="<?=$busca?>">
        </div>

        <div class="col"> 
            <label>Status</label>
            <select name= "filtroStatus" class = "form-control">
                <option value="">Ativa / Desativa</option>
                <option value="s" <?=$filtroStatus == 's' ? 'selected' : '' ?> >Ativa</option>
                <option value="n" <?=$filtroStatus == 'n' ? 'selected' : '' ?> >Desativa</option>
            </select>
        </div>

        <div class="col d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
</form>
</section>

    <section>

        <table class="table bg-white mt-3">

        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

        <!-- Imprime os resultados se existirem, ou imprime a mensagem definida para caso não haja -->
            <?=$resultados?>

        </tbody>
            
            </table>
            
        </section>

    <section>
    <?=$paginacao?>
    </section>
</main>