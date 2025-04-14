<main>


<!--Texto estático porque essa é a unica página que contém esse conteúdo -->
<h2 class="mt-3">Excluir vaga</h2>

  <form method="post">

    <div class="form-group">                   <!--Definindo o nome da vaga de forma dinâmica-->
      <p>Você deseja realmente excluir a vaga <strong><?=$obVaga->titulo?></strong>?</p>
    </div>

    <div class="form-group">
      <a href="index.php">
        <button type="button" class="btn btn-success">Cancelar</button>
      </a>

      <!--Botão que é verificado se existe na classe excluir.php-->
      <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
    </div>

  </form>



</main>