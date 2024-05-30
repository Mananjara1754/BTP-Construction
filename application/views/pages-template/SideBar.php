<!-- Sidebar -->
  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: white;border-bottom: 1px solid #dee2e6">
      <img src="<?=base_url('assets/img/logo.png')?>" alt="AdminLTE Logo" class="brand-image" style="margin-top: -10px;    max-height: 45px;">
      <span class="brand-text font-weight" style="font-weight: 700;color: #1e1e33;">BTP Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: white;">
        <ul aria-current="page" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Profil</li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="unique"> 
              <i class="nav-icon fas fa-user" style="color:#6cc57c;"></i>
              <p style="font-size: smaller;"><?=$numero_client ?></p>
            </a>
          </li>
        </ul>

      <nav class="mt-2">
        <ul aria-current="page" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="<?=site_url('accueil-client-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-home"></i>
              <p style="font-size: smaller;">Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('creation-devis-client-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-alt"></i>
              <p style="font-size: smaller;">Creation de devis</p>
            </a>
          </li>
       
          <!-- Service Magasin -->
   
          <li class="nav-header">Parametre</li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-wrench fa-fw"></i>
              <p style="font-size: smaller;">
                Reglage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('deconnexion-client-btp'); ?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-arrow-right fa-fw"></i>
              <p style="font-size: smaller;">
                Deconnexion
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<!-- End Sidebar -->

<!-- Template Main JS File -->

