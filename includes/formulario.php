<main>

<section>
    <a href="index.php">
        <button class="btn btn-success">Voltar</button>
    </a>
</section>

<!--Texto dinâmico porque essa pagina pode ser utilizada para cadastrar ou editar uma vaga-->
<h2 class="mt-3"><?=TITLE?></h2>

<form method="POST">

<div class="form-group">
    <label>Titulo</label>                                <!--Se for editar, e existir um titulo-->
    <input type="text" class="form-control" name="titulo" required value="<?=$obVaga->titulo?>">
</div>

<div class="form-group">
    <label>Descricao</label>                                  <!--Se for editar, e existir uma descrição-->
    <textarea class="form-control" name="descricao" rows="5" required><?=$obVaga->descricao?></textarea>
</div>

<div class="form-group">
    <label>Status</label>
    
    <div>
          <div class="form-check form-check-inline">
            <label class="form-control">
              <input type="radio" name="ativo" value="s" checked> Ativo
            </label>
          </div>

          <div class="form-check form-check-inline">
            <label class="form-control">                 <!--Se for editar, e o valor tiver sido colocado como 'n' na hora de criar a vaga-->
              <input type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : ''?>> Inativo
            </label>
          </div>
      </div>

    </div>

<div class="form-group">
    <button type="submit" class="mt-3 btn btn-success">Enviar</button>
</div>



</form>

</main>