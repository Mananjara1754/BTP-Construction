
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'insertion client</h4><br>
        <form action="<?=site_url('Controller_client/insertClient') ?>" method="post">
            <label class="label">Nom Client</label>
            <input type="text" name="nom_client" class="form-control">
            <label class="label">Prenom </label>
            <input type="text" name="prenom_client" class="form-control">
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>
        <h4 class="bg-titre">Liste des clients</h4><br>
        <table class="table table-sm table-bordered">
          <thead>
          <tr>
            <th scope="col">ID-Client</th>
            <th scope="col">Nom & Prenom</th>
            <th scope="col">Date d'inscri</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($client as $c){?>
              <tr>
                <th scope="row"><?=$c['id_client'] ?></th>
                <td><?=$c['nom_client']." ".$c['prenom_client'] ?></td>
                <td><?=$c['date_inscription'] ?></td>
                <td class="function-crud"><a href=""><i class="nav-icon fas fa-marker" id="update"></i></a></td>
                <td class="function-crud"><a href=""><i class="nav-icon fas fa-trash" id="delete"></i></a></td>
              </tr>  
            <?php } ?>
          </tbody>
        </table>
    </div>
</main>


