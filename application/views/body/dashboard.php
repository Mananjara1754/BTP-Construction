

<?php 
//Date d'aujourdhui
$u = date('Y-m-d');
//echo $u; ?>
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h3 class="bg-titre">Dashboard BTP construction</h3><br>
        <div id="livraison_a_faire">
          <h4 class="bg-titre">Tous les devis faits</h4><br>
          <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-devis</th>
            <th scope="col">Maison</th>
            <th scope="col">Finition</th>
            <th scope="col">Date devis</th>
            <th scope="col">Debut</th>
            <th scope="col">Fin travaux</th>
            <th scope="col">Montant devis</th>
            <th scope="col">Montant Payee</th>
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
                <td style="text-align: right;"><?=number_format($b['montant_payee'], 2, '.', ' ')?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
        <div>

        <table class="table table-sm table-bordered" style="width: 500px;">
          <tr>
            <td>Total Paiements effectues :</td>
            <td style="text-align: right;"><strong><?php if(isset($total_devis[0]['payee'])) echo  number_format($total_devis[0]['payee'], 2, '.', ' ') ?></strong></td>
          </tr>
          <tr>
            <td>Total sans finition: </td>
            <td style="text-align: right;"><strong><?php if(isset($total_devis[0]['total_sans'])) echo number_format($total_devis[0]['total_sans'], 2, '.', ' ') ?></strong></td>
          </tr>
          <tr>
            <td>Total : </td>
            <td style="text-align: right;"><strong><?php if(isset($total_devis[0]['total'])) echo number_format($total_devis[0]['total'], 2, '.', ' ') ?></strong></td>
          </tr>
          </table>
        </div>
        </div>
        <!-- <button class="btn" id="btn" style="float: right;" onclick="addPdf()">Generate to Pdf livraison</button> -->
        <canvas id="myChart" width="250" height="250"></canvas><br>
        <form action="<?=site_url('dashboard-btp') ?>" method="post">
                <input type="number" name="annee" id="" class="form-control"><br>
                <input type="submit" class="btn">
        </form>

        <!-- <form action="<?=site_url('dashboard-btp') ?>" method="post">
          <input type="date" name="mois" id="" class="form-control"><br>
          <input type="submit" class="btn">
        </form> -->
        <!-- <div class="box" style="    display: flex;
    justify-content: space-around;">
          <div>
          <h4 class="bg-titre">Statistique vente de produit</h4><br>
          <canvas id="myChart2" width="250" height="250"></canvas>
          </div>
          <div>
          <h4 class="bg-titre">Film le plus vue</h4><br>
          <canvas id="myChart3" width="250" height="250"></canvas>
          </div>
        </div> -->
        
        <br>
        <!-- <button class="btn" id="btn" style="float: right;" onclick="exportToExcel()">Generate to xls livraison</button> -->

    </div>
    <h3>Histogramme devis par mois</h3>
    <canvas id="histogramme_mois"></canvas><br>
    <h3>Histogramme devis par annee</h3>
    <!-- <canvas id="histogramme_annee"></canvas> -->
</main>
<script src="<?=base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script>
    // Données exemple par mois
    const dataParMois = {
     <?php 
      $b = true;
      for ($i=1; $i < count($mois); $i++) { 
              foreach($montant_mois as $m){
               if($i == $m['mois']){
                  echo $mois[$i].":".$m['montant'].",";
                  $b=true;
                  break;
                }else{
                  $b = false;
                }
              }
              if($b == false){
                echo $mois[$i].": 0 ,"; 
              }
            } 
      ?>

    };

    // Extraire les mois et les valeurs
    const mois = Object.keys(dataParMois);
    const valeurs = Object.values(dataParMois);

    // Créer un nouveau histogramme_mois
    const ctx = document.getElementById('histogramme_mois').getContext('2d');
    const histogramme = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: mois,
        datasets: [{
          label: 'Données par mois',
          data: valeurs,
          backgroundColor: 'rgba(54, 162, 235, 0.5)', // Couleur de fond des barres
          borderColor: 'rgba(54, 162, 235, 1)', // Couleur de bordure des barres
          borderWidth: 1,
          barPercentage :1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
    // Données exemple par annee
    const dataParAnnee = {
      <?php 
      $b = true;
      for ($i=2019; $i < 2025; $i++) { 
        foreach($montant_annee as $m){
          if($i == $m['annee']){
            echo $i.":".$m['montant'].",";
            $b=true;
            break;
          }else{
            $b = false;
          }
        }
        if($b == false){
          echo $i.": 0 ,"; 
        }
      }  
      ?>

    };

    // Extraire les mois et les valeurs
    const annee = Object.keys(dataParAnnee);
    const valeur = Object.values(dataParMois);

    // Créer un nouveau histogramme_mois
    const ctxAnnee = document.getElementById('histogramme_annee').getContext('2d');
    const histogrammeAnnee = new Chart(ctxAnnee, {
      type: 'bar',
      data: {
        labels: annee,
        datasets: [{
          label: 'Données par annee',
          data: valeur,
          backgroundColor: 'rgba(54, 162, 235, 0.5)', // Couleur de fond des barres
          borderColor: 'rgba(54, 162, 235, 1)', // Couleur de bordure des barres
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
<script>
  // function exportToExcel() {
  //   // Récupérer la table HTML
  //   var htmlTable = document.getElementById('myTable');
  //   // Créer un nouveau Workbook
  //   var wb = XLSX.utils.table_to_book(htmlTable);
  //   // Sauvegarder le Workbook au format XLSX
  //   XLSX.writeFile(wb, 'table_export.xlsx');
  // }
  // function addPdf(){
  //   var element = document.getElementById('livraison_a_faire');
  //   element.style.padding='20px';
  //   element.style.fontSize="small";
  //   html2pdf(element);
  // }
    // var data = {
      
    //   labels: [
    //     <?php foreach($stat_vente_film as $sm){ ?>
    //     "<?=$sm['nom_film']." ".$sm['date_diffusion'] ?>",
    //     <?php } ?>
    //   ],
    //   datasets: [{
    //     label: "Qte",
    //     backgroundColor: [
    //       <?php foreach($stat_vente_film as $sm){ ?>
    //         'rgba(<?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>)',
    //       <?php } ?>
    //     ],
    //     borderWidth: 1,
    //     data: [
    //       <?php foreach($stat_vente_film as $sm){ ?>
    //         <?=$sm['qte'] ?>,
    //       <?php } ?>
    //     ],
    //   }]
    // };
    // var options = {
    //   responsive: false, // Désactiver la réponse automatique
    //   maintainAspectRatio: false // Désactiver le maintien du ratio d'aspect
    // };
    // // Création du graphique camembert
    // var ctx = document.getElementById('myChart').getContext('2d');
    // var myChart = new Chart(ctx, {
    //   type: 'doughnut',
    //   data: data,
    //   options: options
    // });
    // //------------22

    // var data = {
      
    //   labels: [
    //     <?php foreach($stat_produit as $sm){ ?>
    //     "<?=$sm['nom_produit'] ?>",
    //     <?php } ?>
    //   ],
    //   datasets: [{
    //     label: "Qte",
    //     backgroundColor: [
    //       <?php foreach($stat_produit as $sm){ ?>
    //         'rgba(<?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>)',
    //       <?php } ?>
    //     ],
    //     borderWidth: 1,
    //     data: [
    //       <?php foreach($stat_produit as $sm){ ?>
    //         <?=$sm['qte'] ?>,
    //       <?php } ?>
    //     ],
    //   }]
    // };
    // var options = {
    //   responsive: false, // Désactiver la réponse automatique
    //   maintainAspectRatio: false // Désactiver le maintien du ratio d'aspect
    // };
    // // Création du graphique camembert
    // var ctx = document.getElementById('myChart2').getContext('2d');
    // var myChart = new Chart(ctx, {
    //   type: 'doughnut',
    //   data: data,
    //   options: options
    // });
    // //----------
    // var data = {
      
    //   labels: [
    //     <?php foreach($vue as $sm){ ?>
    //     "<?=$sm['nom_film'] ?>",
    //     <?php } ?>
    //   ],
    //   datasets: [{
    //     label: "Qte",
    //     backgroundColor: [
    //       <?php foreach($vue as $sm){ ?>
    //         'rgba(<?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>, <?=rand(0,255) ?>)',
    //       <?php } ?>
    //     ],
    //     borderWidth: 1,
    //     data: [
    //       <?php foreach($vue as $sm){ ?>
    //         <?=$sm['qte'] ?>,
    //       <?php } ?>
    //     ],
    //   }]
    // };
    // var options = {
    //   responsive: false, // Désactiver la réponse automatique
    //   maintainAspectRatio: false // Désactiver le maintien du ratio d'aspect
    // };
    // // Création du graphique camembert
    // var ctx = document.getElementById('myChart3').getContext('2d');
    // var myChart = new Chart(ctx, {
    //   type: 'doughnut',
    //   data: data,
    //   options: options
    // });

</script>



</body>


