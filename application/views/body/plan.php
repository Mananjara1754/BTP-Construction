
<style>
  .plan{
    border: 1px solid #7d7373;
    padding: 50px;
    /* display: flex; */
  }
  .ranger{
    display: flex;
  }
  .place{
    border: 1px solid #41caab;
    width: 58px;
    text-align: center;
    padding: 15px 0px;
  }
</style>
<main id="main" class="main">
    <div class="card-body" id="accueil">
      <h4 class="bg-titre">Plan selon diffusion</h4><br>
      <form action="<?=site_url('Controller_plan/vers_plan') ?>" method="post">
      <label class="label">Choix du diffusion </label>
        <select name="id_diffusion" class="form-control" id="">
          <?php foreach($diffusion as $diff){ ?>
          <option value="<?=$diff['id_diffusion'] ?>"><?=$diff['id_diffusion']." Film : ".$diff['nom_film']." Salle : ".$diff['nom_salle'] ?></option>
          <?php } ?>
        </select>
        <br>
        <input type="submit" value="Valider" class="btn">
      </form><br>
      <div class="plan">
        <?php if(isset($billet)){
          $div = true; 
          for($i=0;$i<count($billet);$i++){ 
            if($div == true){ ?>
              <div class="ranger">
            <?php } 
              $div = false;
            ?>
            <div class="place" <?php if($billet[$i]['etat_billet'] == 10){?> style="color:white;background-color: red;"<?php } ?> ><?=$billet[$i]['nom_range']."".$billet[$i]['numero_place'] ?></div>
              <?php if($i + 1 < count($billet)){
                if($billet[$i]['nom_range']!=$billet[$i+1]['nom_range'] ){ 
                  $div = true;  
                ?>
                </div><br>
               <?php }
              } ?>
            
            
        <?php } } ?>
    </div>
</main>
