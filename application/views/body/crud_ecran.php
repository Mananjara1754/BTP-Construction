
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion ecran</h4><br>
        <form action="<?=site_url('Controller_ecran/insert_ecran') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Nom du ecran</label>
            <input type="text" name="nom_ecran" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification ecran</h4><br>
          <form action="<?=site_url('Controller_ecran/update_ecran') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du ecran</label>
              <input type="text" value="<?=$update['nom_ecran'] ?>" name="nom_ecran" class="form-control">
              <input type="hidden" name="id_ecran" value="<?=$update['id_ecran'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        
        <h4 class="bg-titre">Liste des ecran</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-ecran</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($ecran as $b){?>
              <tr>
                <th scope="row"><?=$b['id_ecran'] ?></th>
                <td><?=$b['nom_ecran']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_ecran/vers_crud_ecran?id_ecran='.$b['id_ecran']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_ecran/delete_ecran/'.$b['id_ecran']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


