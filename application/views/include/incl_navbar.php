<div class="allPage">
    <header>
        <section class="container">
            <section id="main">
                <nav>
                    <section class="nav-fostrap">
                        <!-- NavBar Ligne 1-->
                        <ul class="ligne_one">

                            <!-- Logo Village Green -->
                            <li>
                                <a href="<?= base_url('') ?>" class="Logo-Accueil">
                                    <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                                    </section>
                                </a>
                            </li>

                            <!-- Barre de recherche -->
                            <li>
                                <form class="form-inline md-form mr-auto">
                                    <div style="position: relative;">
                                        <input class="form-control mr-sm-2 recherche" type="text" placeholder="Que recherchez-vous?" name="searchbox" id="searchbox" aria-label="Search">
                                        <div id="sub-search">

                                        </div>
                                    </div>
                                    <button class="btn btn-warning btn-rounded btn-sm my-0 waves-effect waves-light loupe"><i class="fas fa-search"></i></button>
                                </form>
                            </li>

                            <!-- Infos -->
                            <li><a class="padding_ligne_one" href="">Infos</a></li>

                            <!-- Service -->
                            <li><a class="padding_ligne_one" href="">Service</a></li>

                            <!-- Espace Client -->
                            <?php if ($this->session->flashdata('login') || $this->session->userdata('logged_in')) { ?>
                                <li class="padding_ligne_one"><a href="">Connecté<span class="arrow-down"></span></a>
                                    <ul class="dropdown">
                                        <li class="esp_client"><a class="dropdown-item" href="<?= site_url('espaceclient/espaceC') ?>"><i class="fas fa-id-card"></i>Mon compte</a></li>
                                        <li style='cursor:pointer' onclick="logout()" class="esp_client"> <a class="dropdown-item"><i class="fa fa-sign-out"></i>Déconnexion</a></li>
                                        <?php
                                        $data = array(
                                            'style' => 'opacity:0; display:inline-block',
                                            'type' => 'submit',
                                            'content' => 'Soumettre',
                                            'value' => 'Déconnexion'
                                        );
                                        $attr = array(
                                            'method' => 'post',
                                            'id' => 'logout'
                                        );
                                        if ($this->session->userdata('logged_in')) {
                                            echo form_open('register/logout', $attr);
                                            echo form_close();
                                        } ?>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="padding_ligne_one"><a class="ec_hover">Espace client<span class="arrow-down"></span></a>
                                    <ul class="dropdown">
                                        <li class="esp_client"><a class="dropdown-item" href="<?= site_url('connexion/index') ?>"><i class="fas fa-sign-in-alt"></i>Connexion</a></li>
                                        <li class="esp_client"><a class="dropdown-item" href="<?= site_url('home/inscription') ?>"><i class="fas fa-id-card"></i>
                                                Inscription</a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <!-- Panier -->
                            <li><a class="padding_ligne_one" href="<?= site_url('panier/index') ?>"><i class="fas fa-shopping-basket panier" id="qtepanier"></i></a></li>

                            <!-- Langue -->
                            <li class="padding_ligne_one"><a href=""><span class="flag-icon flag-icon-fr"> </span>
                                    Français<span class="arrow-down"></span></a>
                                <ul class="dropdown">
                                    <li class="choixdrap"><a class="dropdown-item" href="Accueilen.html"><span class="flag-icon flag-icon-gb"> </span> English</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es"> </span>
                                            Spañish</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-it"> </span>
                                            Italiano</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-de"> </span>
                                            Deutsch</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-ru"> </span>
                                            Pусский</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-jp"> </span>
                                            日本語</a></li>
                                    <li class="choixdrap"><a class="dropdown-item" href="#"><span class="flag-icon flag-icon-cn"> </span>
                                            官话</a></li>
                                </ul>
                            </li>
                        </ul>

                        <!-- NavBar Ligne 2-->
                        <ul class="ligne_two">
                            <li><a href="<?= site_url('') ?>">Accueil</a></li>
                            <li><a href="">Produits</a></li>
                            <li><a href="">Aide</a></li>
                            <li><a href="<?= site_url('home/apropos') ?>">À propos</a></li>
                        </ul>

                        <!-- NavBar Ligne 3-->
                        <ul class="ligne_three">

                            <!-- Catégorie et Sous-Catégorie -->


                            <?php foreach ($getRubriques as $rubrique) : ?>
                                <li><a href="<?= base_url('products/getRubrique/') . $rubrique['rubrique_id'] ?>"><?= $rubrique['rubrique_nom'] ?><span class="arrow-down"></span></a>
                                    <ul class="dropdown">

                                        <?php
                                        $childes = $rubrique['child'];
                                        foreach ($childes as $child) :
                                        ?>
                                            <li><a href="<?= base_url('products/getSousRubrique/') . $child['sousrub_id'] ?>"><?= $child['sousrub_nom'] ?></a></li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <!-- NavBar Responsive et Hamburger -->
                    <section class="nav-bg-fostrap">
                        <section class="navbar-fostrap"><span></span> <span></span> <span></span></section>
                        <a href="" class="title-mobile">
                            <section class="logo-mobile"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                            </section>
                        </a>
                    </section>
                </nav>
                <!-- Écart entre le Header et le Body (Marge Haute sur le responsive) -->
                <section id='navbarcontent' class='content'>
                </section>
            </section>
        </section>
    </header>

    <script>
        function logout() {
            $('#logout').submit();
        }
    </script>