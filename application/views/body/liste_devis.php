

<main id="main" class="main">
    <div class="card-body" id="accueil">

        
        <h4 class="bg-titre">Liste des devis</h4><br>
        <button class="btn"><?=$pagination?></button>
        <br><br>

        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-devis</th>
            <th scope="col">ID-Client</th>
            <th scope="col">Maison</th>
            <th scope="col">Finition</th>
            <th scope="col">Date devis</th>
            <th scope="col">Debut</th>
            <th scope="col">Fin</th>
            <th scope="col">Montant devis</th>
            <th scope="col">Montant Payee</th>
            <th scope="col">Paiement</th>
            <th scope="col">Pourcentage</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($devis as $b){?>
              <tr>
                <th scope="row"><?=$b['id_devis'] ?></th>
                <td><?=$b['numero_client']?></td>
                <td><?=$b['nom_maison']?></td>
                <td><?=$b['nom_finition']?></td>
                <td><?=$b['date_devis']?></td>
                <td><?=$b['date_debut']?></td>
                <td><?=$b['date_fin']?></td>
                <td style="text-align: right;"><?=number_format($b['montant_devis'], 2, '.', ' ')?></td>
                <td style="text-align: right;"><?=number_format($b['montant_payee'], 2, '.', ' ')?></td>
                <td><?=$b['verif_paiement']?></td>
                <td style="text-align: right;;background-color: <?php if(number_format($b['pourcentage'],2)!=50){ echo $b['color_pourcentage'].";text-align: right;color:white;";}?>"><?=number_format($b['pourcentage'],2)?>%</td>
                <td><a href="<?=site_url('info-devis-admin-btp-'.$b['id_devis'].'.html') ?>"><i class="nav-icon fas fa-download" id="update"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


