

<main id="main" class="main">
    <div class="card-body" id="accueil">
 
      <div id="pdf">
        <h4 class="bg-titre">Liste des Travaux</h4><br>
        <!-- Ajoutez ceci à la fin de votre vue -->
        <table class="table table-sm table-bordered" >
          <thead>
          <tr>
            <th scope="col">code travaux</th>
            <th scope="col">Designation</th>
            <th scope="col">U</th>
            <th scope="col">Q</th>
            <th scope="col">PU</th>
            <th scope="col">Total</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($details as $b){?>
              <tr>
                <th scope="row"><?=$b['code_travaux'] ?></th>
                <td><?=$b['nom_travaux']?></td>
                <td><?=$b['nom_unite']?></td>
                <td style="text-align: right;"><?=$b['qte']?></td>
                <td style="text-align: right;"><?=number_format($b['prix_unitaire'], 2, '.', ' ')?></td>
                <td style="text-align: right;"><?=number_format($b['montant_travaux'], 2, '.', ' ')?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
        <table class="table table-sm table-bordered" style="width: 500px;">
          <tr>
            <td>Totale sans finition:</td>
            <td style="text-align: right;"><strong><?php if (isset($details[0])) {
              echo number_format($details[0]['montant_devis_sans'], 2, '.', ' ');
            } ?></strong></td>
          </tr>
          <tr>
            <td>Total avec finition : </td>
            <td style="text-align: right;"><strong><?php if (isset($details[0])) {
              echo number_format($details[0]['montant_devis'], 2, '.', ' ');
            } ?></strong></td>
          </tr>
          </table>
          <h4 class="bg-titre">Liste des paiements</h4><br>
          <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-paiement</th>
            <th scope="col">Prix</th>
            <th scope="col">Date paiement</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($paiement as $b){?>
              <tr>
                <th scope="row"><?=$b['id_paiement'] ?></th>
                <td style="text-align:right;"><?=number_format($b['montant_payee'], 2, '.', ' ')?></td>
                <td><?=$b['date_paiement']?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <table class="table table-sm table-bordered" style="width: 500px;">
          <tr>
            <td>Totale payee:</td>
            <td style="text-align: right;"><strong><?php if (isset($somme_payee[0]['somme_payee'])) {
              echo number_format($somme_payee[0]['somme_payee'], 2, '.', ' ');
            } ?></strong></td>
          </tr>
          
          </table>
          <br>
        </div>
        <button class="btn" id="btn" style="float: right;" onclick="addPdf()">Generate to Pdf livraison</button>
    </div>
</main>
<script src="<?=base_url('assets/js/html2pdf.bundle.min.js') ?>"></script>
<script>
    function addPdf(){
      var element = document.getElementById('pdf');
      element.style.padding='20px';
      element.style.fontSize="small";
      html2pdf(element);
  //     var opt = {
  //   filename:     'document.pdf',
  //   image:        { type: 'jpeg', quality: 0.98 },
  //   html2canvas:  { scale: 2 },
  //   jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
  // };

  // html2pdf().from(element).set(opt).save();

    }
</script>
