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
              <i class="nav-icon fas fa-user-tie" style="color:#6cc57c;"></i>
              <p style="font-size: smaller;"><?=$nom_service ?></p>
            </a>
          </li>
        </ul>
     
      <nav class="mt-2">
        <ul aria-current="page" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="<?=site_url('accueil-admin-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-home"></i>
              <p style="font-size: smaller;">Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('liste-devis-admin-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-alt"></i>
              <p style="font-size: smaller;">Liste des devis</p>
            </a>
          </li>
          
          </li>
          <li class="nav-item">
            <a href="<?=site_url('travaux-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-alt"></i>
              <p style="font-size: smaller;">travaux</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('finition-btp')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-alt"></i>
              <p style="font-size: smaller;">finition</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?=site_url('import-csv-btp')?>" class="nav-link" id="left_menu"> 
              <i class=" nav-icon fas fa-cart-plus"></i>
              <p style="font-size: smaller;">Import csv</p>
            </a>
          </li>
        
          
          <!-- <li class="nav-item">
            <a href="<?=site_url('Controller_form/vers_form')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-alt"></i>
              <p style="font-size: smaller;">Form</p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?=site_url('dashboard-btp')?>" class="nav-link" id="left_menu"> 
            <i class="nav-icon fas fa-chart-pie"></i>
              <p style="font-size: smaller;">Dashboard</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?=site_url('Controller_besoin/vers_demande_besoin')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p style="font-size: smaller;">Demande besoin</p>
            </a>
          </li>
 
   
          <li class="nav-item">
            <a href="<?=site_url('Controller_finance/vers_marchandise_achete')?>" class="nav-link" id="left_menu"> 
            <i class="nav-icon fas fa-gifts"></i>
              <p style="font-size: smaller;">Marchandise</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_finance/vers_etat_de_stock')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-map"></i>
              <p style="font-size: smaller;">Etat de Stock</p>
            </a>
          </li>
      
          <li class="nav-item">
            <a href="<?=site_url('Controller_achat/vers_livraison_fournisseur')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-truck"></i>
              <p style="font-size: smaller;">Livraison du fournisseur</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_achat/vers_besoin_achat')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p style="font-size: smaller;">Achat de produit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_achat/vers_marchandise_commande')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-tasks"></i>
              <p style="font-size: smaller;">Produits commandé</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_achat/vers_anomalie_livraison')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-viruses"></i>
              <p style="font-size: smaller;">Anomalie de Livraison</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_achat/vers_bon_commande_achat')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-file-signature"></i>
              <p style="font-size: smaller;">Bon de Commande</p>
            </a>
          </li>

  
          <li class="nav-item">
            <a href="<?=site_url('Controller_magasin/vers_entree_marchandise')?>" class="nav-link" id="left_menu"> 
              <i class=" nav-icon fas fa-cart-plus"></i>
              <p style="font-size: smaller;">Entree de marchandise</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_magasin/vers_sortie_marchandise')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-truck"></i>
              <p style="font-size: smaller;">Sortie de marchandise</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_magasin/vers_mouvement')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-undo-alt"></i>
              <p style="font-size: smaller;">Mouvement</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_magasin/vers_etat_de_stock_qte')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-map"></i>
              <p style="font-size: smaller;">Etat de Stock Qtte</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('Controller_magasin/vers_liste_anomalie')?>" class="nav-link" id="left_menu"> 
              <i class="nav-icon fas fa-viruses"></i>
              <p style="font-size: smaller;">Anomalies</p>
            </a>
          </li> -->
   
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
            <a href="<?=site_url('Controller_login/deconnexion'); ?>" class="nav-link" id="left_menu"> 
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

