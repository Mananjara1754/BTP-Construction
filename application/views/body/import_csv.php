
<main id="main" class="main">
    <div class="card-body" id="accueil">
        <h4 class="bg-titre">Formulaire d'import de donnee</h4><br>
        <form action="<?=site_url('Controller_csv/importCsvTrav') ?>" method="post" enctype="multipart/form-data">
            <label class="label">Fichier csv pour travaux & maison</label><br>
            <input type="file" name="file_trav"/>
            <br>
            <label class="label">Fichier csv pour Devis</label><br>
            <input type="file" name="file_devis"/>
            <br><br>
            <input type="submit" value="Valider" class="btn">
        </form>

        <h4 class="bg-titre">Formulaire d'import CSV Paiement </h4><br>
        <form action="<?=site_url('Controller_csv/importCsvPaiement') ?>" method="post" enctype="multipart/form-data">
        <label class="label">Fichier csv</label>
            <input type="file" name="file"/>
            <br>
            <input type="submit" value="Valider" class="btn">
        </form>
        <br>

    </div>
</main>


