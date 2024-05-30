
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion de vente</h4><br>
        <form action="<?=site_url('Controller_vente/insert_vente')  ?>" method="post">
            <label class="label">Client</label>
            <select name="id_client" class="form-control">
              <?php foreach($client as $b){ ?>
                <option value="<?=$b['id_client'] ?>"><?=$b['nom_client'] ?> <?=$b['prenom_client'] ?></option>
              <?php } ?>
            </select>
            <label class="label">Billet</label>
            <select name="id_billet" id="" class="form-control">
              <?php foreach($billet as $b){ ?>
                <option value="<?=$b['id_billet'] ?>"><?=$b['id_billet'] ?> (<?=$b['prix_billet'] ?> Ar)</option>
              <?php } ?>
            </select>
            <label class="label">Axe de livraison</label>
            <select name="id_axe" id="" class="form-control">
              <?php foreach($axe as $b){ ?>
                <option value="<?=$b['id_axe'] ?>"><?=$b['id_axe'] ?></option>
              <?php } ?>
            </select>
            <label>Quantite</label>
            <input name="qte" type="number" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <form action="<?=site_url('Controller_vente/import_csv') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Fichier csv</label>
            <input type="file" name="file"/>
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <h4 class="bg-titre">Liste des ventes non payee</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-Billet</th>
            <th scope="col">ID-Etudiant</th>
            <th scope="col">Nom & Prenom</th>
            <th scope="col">Qte totale</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($non_vendu as $v){?>
              <tr>
                <th scope="row"><?=$v['id_billet'] ?></th>
                <td><?=$v['id_service'] ?></td>
                <td><?=$v['nom'] ?></td>
                <td style="text-align:right;"><?=$v['qte'] ?></td>
                <td class="function-crud"><a href="<?=site_url('Controller_vente/confirmer_vente/'.$v['id_vente']) ?>"><i class="fas fa-check-circle" id="update" style="font-size: 30px;"></i></a></td>
              </tr>  
            <?php } ?>
          </tbody>
        </table><br>
        <h4 class="bg-titre">Liste des ventes non payee</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-Billet</th>
            <th scope="col">ID-Etudiant</th>
            <th scope="col">Nom & Prenom</th>
            <th scope="col">Qte totale</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($vendu as $v){?>
              <tr>
                <th scope="row"><?=$v['id_billet'] ?></th>
                <td><?=$v['id_service'] ?></td>
                <td><?=$v['nom'] ?></td>
                <td style="text-align:right;"><?=$v['qte'] ?></td>
                
              </tr>  
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


