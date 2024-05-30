
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion reference</h4><br>
        <form action="<?=site_url('Controller_reference/insert_reference') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Nom du reference</label>
            <input type="text" name="nom_reference" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification reference</h4><br>
          <form action="<?=site_url('Controller_reference/update_reference') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du reference</label>
              <input type="text" value="<?=$update['nom_reference'] ?>" name="nom_reference" class="form-control">
              <input type="hidden" name="id_reference" value="<?=$update['id_reference'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        
        <h4 class="bg-titre">Liste des reference</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-reference</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($reference as $b){?>
              <tr>
                <th scope="row"><?=$b['id_reference'] ?></th>
                <td><?=$b['nom_reference']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_reference/vers_crud_reference?id_reference='.$b['id_reference']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_reference/delete_reference/'.$b['id_reference']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


