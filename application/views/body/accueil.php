<style>
    #accueil-admin{
        height: 500px;
        border-radius: 37px;
        background-size: cover;
    }
    .bg-titre{
        color: #6cc57c;

        font-size: -webkit-xxx-large;
        transition:1s;
    }
    .admin-contains{
        display: flex;
        justify-content: center;
    }
    
</style>
<main id="main" class="main">
    <div class="card-body admin-contains" id="accueil-admin" style="text-align: center;">
        <div style="    margin-top: 11%;">
            <h4 class="bg-titre"><?=$nom_service ?> BTP construction</h4><br>
            <a href="<?=site_url('Controller_Admin_devis/reset') ?>" class="btn">Reinitialiser database</a>
        </div>
    </div>
</main>


