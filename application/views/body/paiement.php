

<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion Paiement</h4><br>
        <!-- action="<?=site_url('Controller_paiement/insertPaiement') ?>" -->
        <form  method="post" enctype="multipart/form-data">
            <label class="label">Montant a paye</label>
            <input type="text" id="montant_payee" name="montant_payee" class="form-control">
            <label class="label">Date du paiement</label>
            <input type="date" id="date_paiement" name="date_paiement" class="form-control">
            <input type="hidden" id="id_devis" name="id_devis" value="<?=$id_devis ?>" class="form-control">
            <br>
            <input  value="Valider" class="btn" id="okey" onclick="paiement()">
        </form>
        <br>
        <strong id="succes" style="color: green;"></strong>
        <stong id="erreur" style="color:red;font-weight: bold;"></stong>
        <br>
        
        <h4 class="bg-titre">Liste des paiements</h4><br>
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
            <?php foreach($paiement as $b){?>
              <tr>
                <th scope="row"><?=$b['id_paiement'] ?></th>
                <td style="text-align:right;"><?=number_format($b['montant_payee'], 2, '.', ' ')?></td>
                <td><?=$b['date_paiement']?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>
<script>
  function paiement(){
    var boutton = document.getElementById("okey");
    var succes = document.getElementById("succes");
    var erreur = document.getElementById("erreur");
    var id_devis = document.getElementById("id_devis").value;
    var montant_payee = document.getElementById("montant_payee").value;
    var date_paiement = document.getElementById("date_paiement").value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST','<?=site_url('controller_paiement/insertPaiement') ?>',true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload =function(){
      if(xhr.status >= 200 && xhr.status <300){
        var response = JSON.parse(xhr.responseText);
        if (response.response == true) {
          //alert("Succes");
          boutton.classList.remove("erreur");
          boutton.classList.add("succes");
          setTimeout(function() {
          self.location = self.location;
        }, 1500); // Attendre 1 seconde (1000 millisecondes)
        }else{
          erreur.innerHTML=response.response;
          boutton.classList.add("erreur");
          alert(response.response);
        }
      }else{
        alert('Erreur : '+xhr.status);
      }
    };
    xhr.onerror = function(){
      alert("erreru de connexion");
    };
    xhr.send('date_paiement='+encodeURIComponent(date_paiement)+'&montant_payee='+encodeURIComponent(montant_payee)+'&id_devis='+encodeURIComponent(id_devis));
  }
</script>


