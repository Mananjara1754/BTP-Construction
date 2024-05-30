
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion emp</h4><br>
        <form action="<?=site_url('Controller_emp/insert_emp') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Nom du emp</label>
            <input type="text" name="nom_emp" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification emp</h4><br>
          <form action="<?=site_url('Controller_emp/update_emp') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du emp</label>
              <input type="text" value="<?=$update['nom_emp'] ?>" name="nom_emp" class="form-control">
              <input type="hidden" name="id_emp" value="<?=$update['id_emp'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        
        <h4 class="bg-titre">Liste des emp</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-emp</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($emp as $b){?>
              <tr>
                <th scope="row"><?=$b['id_emp'] ?></th>
                <td><?=$b['nom_emp']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_emp/vers_crud_emp?id_emp='.$b['id_emp']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_emp/delete_emp/'.$b['id_emp']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


