
<?php  $jsonData = json_encode($billet); ?>

<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'achat billet</h4><br>
        <form action="<?=site_url('Controller_billet/achat_billet') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Choix du film </label>
            <select name="id_film" id="film" class="form-control" onchange="afficherBillets()">
              <?php foreach($film as $f){ ?>
                <option value="<?=$f['id_film'] ?>"><?=$f['nom_film'] ?></option>
              <?php } ?>
            </select>
            <label class="label">Choix du Range </label>
            <select name="id_range" id="range" class="form-control" onchange="afficherBillets()">
              <?php foreach($range as $r){ ?>
              <option value="<?=$r['id_range'] ?>"><?=$r['nom_range'] ?></option>
              <?php } ?>
            </select>
            <label class="label">Choix du place </label>
            <select name="id_place" id="place" class="form-control" onchange="afficherBillets()">
              <?php foreach($place as $pl){ ?>
              <option value="<?=$pl['id_place'] ?>"><?=$pl['numero_place'] ?></option>
              <?php } ?>
            </select><br>
            <label class="label">Billet si disponible</label>
            <select name="id_billet" id="billet" class="form-control">
              
            </select>
            <label class="label">Nom du client</label>
            <input type="text" name="nom_client" class="form-control">
            <label class="label">date de naissance</label>
            <input type="date" name="dtn" id="dtn" class="form-control">
            <br>
            <div id="ticket">
              SAlle : <strong id="salle"></strong>
              Movie : <strong id="movie"></strong>
              Row : <strong id="row"></strong>
              Seat : <strong id="seat"></strong>
              time : <strong id="time"></strong>
              Date : <strong id="date"></strong>
              Price : <strong id="price"></strong>
            </div>
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
    
        <h4 class="bg-titre">Liste des billets</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-billet</th>
            <th scope="col">Prix</th>
            <th scope="col">Illustration</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($billet as $b){ ?>
              <option value="<?=$b['id_billet'] ?>"><?=$b['id_billet']." ".$b['nom_range']." ".$b['numero_place']." ".$b['nom_film'] ?></option>
              <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>
<script>
  var infosAssociees = <?php echo $jsonData; ?>;
  function addPdf(){
    var element = document.getElementById('ticket');
    element.style.padding='20px';
    element.style.fontSize="small";
    html2pdf(element);
  }
  function afficherBillets() {
        var filmSelect = document.getElementById("film");
        var placeSelect = document.getElementById("place");
        var rangeSelect = document.getElementById("range");
        var selectedFilmId = filmSelect.value;
        var selectedPlaceId = placeSelect.value;
        var selectedRangeId = rangeSelect.value;
        var billetSelect = document.getElementById("billet");
        

        var movie = document.getElementById("movie");
        var seat = document.getElementById("seat");
        var row = document.getElementById("row");
        var date = document.getElementById("date");
        var time = document.getElementById("time");
        var salle = document.getElementById("salle");
        var price = document.getElementById("price");
        var dtn = document.getElementById("dtn");


        billetSelect.innerHTML = ""; // Efface toutes les options précédentes
        for (var i = 0; i < infosAssociees.length; i++) {
            if (infosAssociees[i]['id_film'] === selectedFilmId && infosAssociees[i]['id_place'] === selectedPlaceId && infosAssociees[i]['id_range'] === selectedRangeId ) {
                var option = document.createElement("option");
                option.value = infosAssociees[i]['id_billet'];
                option.text = infosAssociees[i]['id_billet']+" "+infosAssociees[i]['nom_film']+" Range "+infosAssociees[i]['nom_range']+"Num "+infosAssociees[i]['numero_place']+" "; // Ou tout autre champ que vous souhaitez afficher
                movie.innerHTML= infosAssociees[i]['nom_film'];
                seat.innerHTML= infosAssociees[i]['numero_place'];
                row.innerHTML= infosAssociees[i]['nom_range'];
                salle.innerHTML= infosAssociees[i]['nom_salle'];
                time.innerHTML= infosAssociees[i]['debut_diffusion']+" a "+infosAssociees[i]['fin_diffusion'];
                date.innerHTML= infosAssociees[i]['date_diffusion'];
                // if(dtn){

                // }
                price.innerHTML= infosAssociees[i]['prix_billet'];
                if(infosAssociees[i]['etat_billet'] == 10){
                  billetSelect.style.backgroundColor = "red";
                  billetSelect.style.color = "white";
                }else{
                  billetSelect.style.backgroundColor = "white";
                  billetSelect.style.color = "#495057";
                }
                billetSelect.appendChild(option);
            }
        }
        addPdf();


    }
</script>


