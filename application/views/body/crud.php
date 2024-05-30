
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion produit</h4><br>
        <form action="<?=site_url('Controller_produit/insert_produit') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Prix du produit</label>
            <input type="number" name="prix_produit" class="form-control">
            <label class="label">Nom du produit</label>
            <input type="text" name="nom_produit" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        
        <h4 class="bg-titre">Liste des produit</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-produit</th>
            <th scope="col">Nom produit</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($produit as $b){?>
              <tr>
                <th scope="row"><?=$b['id_produit'] ?></th>
                <td><?=$b['prix_produit']?></td>
                <td><?=$b['nom_produit']?></td>
                <td class="function-crud"><a href=""><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href=""><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>  
            <?php } ?>
          </tbody>
        </table><br>
    </div>
</main>


