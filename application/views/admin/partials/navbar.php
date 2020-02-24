<div class="container-scroller">
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="index.html">
        <img src="<?= base_url() ?>assets/admin/assets/images/logo.svg" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="<?= base_url() ?>assets/admin/assets/images/logo-mini.svg" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block">Aide : 03 00 00 00 00</li>
        <li class="nav-item dropdown language-dropdown">
          <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="d-inline-flex mr-0 mr-md-3">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-fr"></i>
              </div>
            </div>
            <span class="profile-text font-weight-medium d-none d-md-block">Français</span>
          </a>
          <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
            <a class="dropdown-item">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-fr"></i>
              </div>Français
            </a>
            <a class="dropdown-item">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-us"></i>
              </div>Anglais
            </a>
            <a class="dropdown-item">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-ae"></i>
              </div>Arabe
            </a>
            <a class="dropdown-item">
              <div class="flag-icon-holder">
                <i class="flag-icon flag-icon-ru"></i>
              </div>Russe
            </a>
          </div>
        </li>
      </ul>
      <form class="ml-auto search-form d-none d-md-block" action="#">
        <div class="form-group">
          <input type="search" class="form-control" placeholder="Recherchez ici">
        </div>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-bell-outline"></i>
            <span class="count">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
            <a class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">Vous n'avez aucun nouveau mail</p>
              <span class="badge badge-pill badge-primary float-right">Voir tous</span>
            </a>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-email-outline"></i>
            <span class="count bg-success">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
            <a class="dropdown-item py-3 border-bottom">
              <p class="mb-0 font-weight-medium float-left">Vous n'avez aucune notification </p>
              <span class="badge badge-pill badge-primary float-right">Voir toutes</span>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-alert m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Erreur d'application</h6>
                <p class="font-weight-light small-text mb-0"> A l'instant </p>
              </div>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-settings m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Paramètres</h6>
                <p class="font-weight-light small-text mb-0"> Message privé </p>
              </div>
            </a>
            <a class="dropdown-item preview-item py-3">
              <div class="preview-thumbnail">
                <i class="mdi mdi-airballoon m-auto text-primary"></i>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Nouvel utilisateur enregistré</h6>
                <p class="font-weight-light small-text mb-0"> Il y a 2 jours </p>
              </div>
            </a>
          </div>
        </li><?php $Userid = $this->session->userdata('user_id') ?>
        <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/admin/assets/images/faces/<?= $Userid ?>/profilpic.jpg" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-md rounded-circle" src="<?= base_url() ?>assets/admin/assets/images/faces/<?= $Userid ?>/profilpic.jpg" alt="Profile image">
              <?php foreach($dataC as $admin){ ?>
              <p class="mb-1 mt-3 font-weight-semibold"><?= $admin->client_prenom .' '.  $admin->client_nom ?></p>
              <p class="font-weight-light text-muted mb-0"><?= $admin->client_mail ?></p>
              <?php  } ?>
            </div>
            <a class="dropdown-item">Mon profil <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
            <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
            <a class="dropdown-item">Activité<i class="dropdown-item-icon ti-location-arrow"></i></a>
            <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
            <a class="dropdown-item">Déconnexion<i class="dropdown-item-icon ti-power-off"></i></a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile">
          <a href="#" class="nav-link">
            <div class="profile-image">
              
              <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/admin/assets/images/faces/<?= $Userid ?>/profilpic.jpg" alt="profile image">
              <div class="dot-indicator bg-success"></div>
            </div>
            <div class="text-wrapper">
              <?php foreach($dataC as $admin){ ?>
              <p class="profile-name"><?= $admin->client_prenom .' '.  $admin->client_nom ?></p>
              <p class="designation">Administrateur</p>
              <?php  } ?>
            </div>
          </a>
        </li>
        <li class="nav-item nav-category">Menu principal</li>
        <li class="nav-item nav-category"> <a href="<?= base_url('') ?>">Retour page d'accueil</a></li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Gestions utilisateurs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminclients/index') ?>">Utilisateurs</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Produits</span>
            <i class="menu-arrow"></i>
          </a>

          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminrubriques/getRubriques') ?>">Liste des rubriques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminrubriques/index') ?>">Ajouter rubriques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminsousrubriques/getSousRubriques') ?>">Liste des sous-rubriques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminsousrubriques/index') ?>">Ajouter sous-rubriques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminproducts/getProduct') ?>">Liste des produits</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('adminproducts/index') ?>">Ajouter produits</a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Pages utilisateurs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/blank-page.html"> Page blanche </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/login.html"> Connexion </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/register.html"> Enregistrement </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/error-404.html"> Erreur 404 </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/samples/error-500.html"> Erreur 500 </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>