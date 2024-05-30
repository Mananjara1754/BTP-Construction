
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion marque</h4><br>
        <form action="<?=site_url('Controller_marque/insert_marque') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Nom du marque</label>
            <input type="text" name="nom_marque" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification marque</h4><br>
          <form action="<?=site_url('Controller_marque/update_marque') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du marque</label>
              <input type="text" value="<?=$update['nom_marque'] ?>" name="nom_marque" class="form-control">
              <input type="hidden" name="id_marque" value="<?=$update['id_marque'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        
        <h4 class="bg-titre">Liste des marque</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-marque</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($marque as $b){?>
              <tr>
                <th scope="row"><?=$b['id_marque'] ?></th>
                <td><?=$b['nom_marque']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_marque/vers_crud_marque?id_marque='.$b['id_marque']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_marque/delete_marque/'.$b['id_marque']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


