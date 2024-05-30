

<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion de devis de Construction BTP</h4><br>
        <form action="<?=site_url('Controller_devis/insertDevis') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Choix du maison</label><br>
            <div style="display: flex;justify-content: space-around;">
            <?php foreach($maison as $m){?>
              <div class="maison">
              <input type="radio" name="id_maison" value="<?=$m['id_maison'] ?>"> <strong><?=$m['nom_maison'] ?></strong>
              <p>Description :</p>
              <p style="font-size:small;"><?=$m['description'] ?></p>
              </div>
            <?php } ?>
            
            </div>
            <label class="label">Choix du finition</label>
            <select name="id_finition" id="" class="form-control">
            <?php foreach($finition as $m){?>
              <option value="<?=$m['id_finition'] ?>"><?=$m['nom_finition'] ?></option>
            <?php } ?>
            </select>
            <label class="label">Choix du lieu</label>
            <select name="id_lieu" id="" class="form-control">
            <?php foreach($lieu as $m){?>
              <option value="<?=$m['id_lieu'] ?>"><?=$m['nom_lieu'] ?></option>
            <?php } ?>
            </select>
            <label class="label">Date debut chantier</label>
            <input type="date" name="date_debut" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <h4 class="bg-titre">Liste des devis BTP</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <button class="btn"><?=$pagination?></button>
        <br><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-devis</th>
            <th scope="col">Maison</th>
            <th scope="col">Finition</th>
            <th scope="col">Date devis</th>
            <th scope="col">Debut</th>
            <th scope="col">Fin</th>
            <th scope="col">Montant devis</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($devis as $b){?>
              <tr>
                <th scope="row"><?=$b['id_devis'] ?></th>
                <td><?=$b['nom_maison']?></td>
                <td><?=$b['nom_finition']?></td>
                <td><?=$b['date_devis']?></td>
                <td><?=$b['date_debut']?></td>
                <td><?=$b['date_fin']?></td> 
                <td style="text-align: right;"><?=number_format($b['montant_devis'], 2, '.', ' ')?></td>
                <td><a href="<?=site_url('info-devis-client-btp-'.$b['id_devis'].'.html') ?>"><i class="nav-icon fas fa-download" id="update"></i></a></td>
                <td><a href="<?=site_url('paiement-devis-client-btp-'.$b['id_devis'].'.html') ?>"><i class="nav-icon fas fa-shopping-cart" id="update"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


