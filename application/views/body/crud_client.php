
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion client</h4><br>
        <form action="<?=site_url('Controller_client/insertClient') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Nom du client</label>
            <input type="text" name="nom_client" class="form-control">
            <label class="label">Nom de l' utilisateur</label>
              <input type="text" name="utilisateur" class="form-control">
            <label class="label">Mot de passe</label>
            <input type="text" name="mdp" class="form-control">
            <label class="label">Date de naissance</label>
            <input type="date" name="dtn" class="form-control">
            <label class="label">Sexe</label>
            <input type="radio" name="sexe" value="1" checked> Male <br>
            <input type="radio" name="sexe" value="0" style="margin-left:10px;"> Female<br>
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification client</h4><br>
          <form action="<?=site_url('Controller_client/update_client') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du client</label>
              <input type="text" value="<?=$update['nom_client'] ?>" name="nom_client" class="form-control">
              <label class="label">Nom de l' utilisateur</label>
              <input type="text" value="<?=$update['utilisateur'] ?>" name="utilisateur" class="form-control">
              <label class="label">Nouveau mdp</label>
              <input type="text" value="<?=$update['mdp'] ?>" name="mdp" class="form-control">
              <label class="label">Date de naissance</label>
              <input type="date" name="dtn" value="<?=$update['dtn_client'] ?>" class="form-control">
              <label class="label">Sexe</label>
              <input type="radio" name="sexe" value="1" <?php if($update['sexe'] == 1){ echo "checked";} ?>> Male <br>
              <input type="radio" name="sexe" value="0" style="margin-left:10px;" <?php if($update['sexe'] == 0){ echo "checked";} ?>> Female<br>
              <input type="hidden" name="id_client" value="<?=$update['id_client'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        
        <h4 class="bg-titre">Liste des client</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-client</th>
            <th scope="col">Nom client</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($client as $b){?>
              <tr>
                <th scope="row"><?=$b['id_client'] ?></th>
                <td><?=$b['nom_client']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_client/versCrudClient?id_client='.$b['id_client']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_client/delete_client/'.$b['id_client']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


