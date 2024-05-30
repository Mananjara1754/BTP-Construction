
<main id="main" class="main">
    <div class="card-body" id="accueil">
        
        <br>
        <?php if(isset($update)){ ?>
          <h4 class="bg-titre">Formulaire de modification travaux</h4><br>
          <form action="<?=site_url('Controller_travaux/updateTravaux') ?>" method="post" enctype="multipart/form-data">
              <label class="label">Nom du travaux</label>
              <input type="text" value="<?=$update['nom_travaux'] ?>" name="nom_travaux" class="form-control">
              <label class="label">Code travaux</label>
              <input type="text" value="<?=$update['code_travaux'] ?>" name="code_travaux" class="form-control">
              <label class="label">Prix unitaire</label>
              <input type="text" value="<?=$update['prix_unitaire'] ?>" name="prix_unitaire" class="form-control">
              <label class="label">Unite</label>
              <select name="id_unite" id="" class="form-control">
              <?php foreach($unite as $m){?>
                <option value="<?=$m['id_unite'] ?>" <?php if($m['id_unite'] ==$update['id_unite'] ){echo "selected";} ?>><?=$m['nom_unite'] ?></option>
              <?php } ?>
              </select>
              <input type="hidden" name="id_travaux" value="<?=$update['id_travaux'] ?>">
              <br>
              <input type="submit" value="Valider" class="btn">
          </form>
          <br>
        <?php } ?>
        <h4 class="bg-titre">Liste des travaux</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">Code-travaux</th>
            <th scope="col">Nom travaux</th>
            <th scope="col">prix unitaire</th>
            <th scope="col">Unite</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($travaux as $b){?>
              <tr>
                <th scope="row"><?=$b['code_travaux'] ?></th>
                <td><?=$b['nom_travaux']?></td>
                <td style="text-align: right;"><?=number_format($b['prix_unitaire'],2,'.',' ')?></td>
                <td><?=$b['nom_unite']?></td>
                <td class="function-crud"><a href="<?=site_url('modification-travaux-btp-'.$b['id_travaux'].'.html') ?>"><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href="<?=site_url('Controller_travaux/deleteTravaux/'.$b['id_travaux']) ?>"><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


