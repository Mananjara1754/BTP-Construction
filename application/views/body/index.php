<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href=" <?= base_url('assets/img/logo.png') ?>" rel="icon">
  <link href=" <?= base_url('assets/img/logo.png') ?>" rel="apple-touch-icon">
  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?=base_url('assets/dist/css/login.css') ?>" rel="stylesheet">
</head>

<body>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">

          <div class="row justify-content-center">

              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4"></div>
                <div class="card mb-3" style="box-shadow: none;border:none;">

                  <div class="card-body">

                    <div class="pt-4 pb-2" style="text-align: center;margin-top: 16px;">
                      <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="" style="width:100px;"><br>
                      <h5 class="card-title text-center pb-0 fs-4">Admin BTP-Project</h5>
                      <p class="text-center small">Bienvenue sur la plateforme d' E-BTP-Project</p>
                    </div>

                    <form action="<?php echo site_url('login-admin-btp'); ?>" style="padding: 14px 24px;" class="row g-3 needs-validation" novalidate method="post">
                    <strong style="color:red;"><?php if (isset($error)) {
                        echo $error;
                      } ?></strong>
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
                        <br>
                        <input class="btn btn-primary w-100" type="submit" value="Se connecter" id="boutton">
                      </div>
                    </form>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </section>

    </div>
  </main>

</body>

</html>
