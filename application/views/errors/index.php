<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur</title>
</head>
<style>
    .titre_erreur{
        background-color: #f34444;
        padding: 2px 31px;
        color: #f6f0f0;
    }
    h3{
        color: cadetblue;
    }
    p,table{
        margin-left: 35px;
    }
    td{
        border: 0.5px solid #d8d8d8;
        padding: 10px;
    }
    .back{
        background-color: white;
        text-decoration: none;
        padding: 13px;
        border-radius: 15px;
        color: red;
        float: right;
        margin-top: -71px;
    }
</style>
<body style="
    font-family: poppins;padding: 14px 55px;">
    <div class="titre_erreur">
        <h1>OUPS! , il y a une erreur</h1>
        <!-- <a href="<?=site_url('Controller_login/versAccueil')?>" class="back">Retour</a> -->
        <a href="#" onclick="history.back(); return false;" class="back">Retour</a>
    </div>

    <?php if(isset($error)){ ?>
    <div class="designation">
        <h3>Voici l'erreur : </h3>
        <p><?=$error ?></p>
    </div>
    <?php } ?>

    <?php if(isset($csv_error)){ ?>
        <h3>Les Erreurs lors de l'importation du csv</h3>
        <p>
            <table>
            <thead>
            <tr>
                <th scope="col">Designation de l'Erreur</th>
            </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < count($csv_error); $i++) {?>
                <tr>
                    <td><?=$csv_error[$i] ?></td>
                </tr>  
                <?php } ?>
            </tbody>
            </table>
        </p>
    <?php } ?>
    
</body>
</html>


