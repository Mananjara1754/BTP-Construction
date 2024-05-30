
<main id="main" class="main">
    <div class="card-body" id="accueil">
        
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification finition</h4><br>
          <form action="<?=site_url('Controller_finition/updateFinition') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du finition</label>
              <input type="text" value="<?=$update['nom_finition'] ?>" name="nom_finition" class="form-control">
              <label class="label">Taux finition</label>
              <input type="text" value="<?=$update['augmentation'] ?>" name="augmentation" class="form-control">
              <label class="label">Prix unitaire</label>
              <input type="hidden" name="id_finition" value="<?=$update['id_finition'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        <h4 class="bg-titre">Liste des finition</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-finition</th>
            <th scope="col">Nom</th>
            <th scope="col">Augmentation</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($finition as $b){?>
              <tr>
                <th scope="row"><?=$b['id_finition'] ?></th>
                <td><?=$b['nom_finition']?></td>
                <td><?=$b['augmentation']?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_finition/versCrudFinition?id_finition='.$b['id_finition']) ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('modification-finition-btp-'.$b['id_finition'].'.html') ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


