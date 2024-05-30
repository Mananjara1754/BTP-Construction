<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inscription</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href=" <?= base_url('assets/img/logo.png') ?>" rel="icon">

  <link href=" <?= base_url('assets/img/logo.png') ?>" rel="apple-touch-icon">
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
<style>
  *{
    font-family: Poppins;
  }
  #i{
    margin-right: 10px;
  }
  label{
    font-size: small;
    opacity: 0.7;
  }
  .label{
    font-size: small;
    opacity: 0.7;
  }
  #boutton{
    background-color: #193948;
    border: none;
    margin-right: 13px;
}
#image{
    height: 500px;
    width: 500px;
    margin-top: 48px;
    background-color: white;
    margin-left: -17px;
}
</style>
  <!-- Template Main CSS File -->
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>

<body style="background-color: #4FADC0;">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">

          <div class="row justify-content-center">

              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                  <n href="<?php echo site_url('index'); ?>" class="logo d-flex align-items-center w-auto">
                    <!-- <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt=""> -->
                    <!-- <span class="d-none d-lg-block">Ressources Humaines</span> -->
                  </n>
                </div><!-- End Logo -->

                <div class="card mb-3" style="box-shadow: none;border:none;">
                  <div class="card-body">
                    <div class="pt-4 pb-2" style="text-align: center;margin-top: 16px;">
                      <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="" style="width:60px;">
                      <h5 class="card-title text-center pb-0 fs-4">Inscription Billet-Project</h5>
                      <p class="text-center small">Entrer vos informations</p>
                    </div>

                    <form action="<?php echo site_url('Controller_login/inscription'); ?>" style="padding: 14px 24px;" class="row g-3 needs-validation" novalidate method="post">
                      <strong style="color:red;"><?php if (isset($error)) {
                        echo $error;
                      } ?></strong>
                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Nom & Prenom</label>
                        <div class="input-group has-validation">
                        <input type="text" name="nom" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">veuillez entrer votre Nom et Prenom.</div>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Nom utilisateur</label>
                        <div class="input-group has-validation">
                        <input type="text" name="utilisateur" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">veuillez entrer votre Nom utilisateur.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Mot de Passe</label>
                        <input type="password" name="mdp" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Veuillez entrer votre mot de passe</div>
                      </div>
                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Verification Mot de Passe</label>
                        <input type="password" name="verif" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Veuillez entrer votre mot de passe</div>
                      </div>
                      
                      <div class="col-12">
                        <br>
                        <input class="btn btn-primary w-100" type="submit" value="S'inscrire" id="boutton">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
          </div>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

</body>

</html>
