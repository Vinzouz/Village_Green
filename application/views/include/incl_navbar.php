<?php //session_start(); 
?>
<header>
    <section class="container">
        <section id="main">
            <nav>
                <section class="nav-fostrap">
                    <!-- NavBar Ligne 1-->
                    <ul class="ligne_one">

                        <!-- Logo Village Green -->
                        <li>
                            <a href="<?= site_url('index.php/welcome/index') ?>" class="Logo-Accueil">
                                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                                </section>
                            </a>
                        </li>

                        <!-- Barre de recherche -->
                        <li>
                            <form class="form-inline md-form mr-auto">
                                <input class="form-control mr-sm-2 recherche" type="text" placeholder="Que recherchez-vous?" aria-label="Search">
                                <button class="btn btn-warning btn-rounded btn-sm my-0 waves-effect waves-light loupe" type="submit"><i class="fas fa-search"></i></button>
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
                                    <li class="esp_client"><a class="dropdown-item" href="<?= site_url('connexion/edit') ?>"><i class="fas fa-id-card"></i>Mon compte</a></li>
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
                                    <li class="esp_client"><a class="dropdown-item" href="<?= site_url('welcome/inscription') ?>"><i class="fas fa-id-card"></i>
                                            Inscription</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <!-- Panier -->
                        <li><a class="padding_ligne_one" href=""><i class="fas fa-shopping-basket panier"></i></a></li>

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
                        <li><a href="<?= site_url('index.php/welcome/index') ?>">Accueil</a></li>
                        <li><a href="">Produits</a></li>
                        <li><a href="">Aide</a></li>
                        <li><a href="<?= site_url('index.php/welcome/apropos') ?>">À propos</a></li>

                    </ul>

                    <!-- NavBar Ligne 3-->
                    <ul class="ligne_three">

                        <!-- Catégorie et Sous-Catégorie -->
                        <li><a href="Guitares&Basses.php">Guitares/Basses<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Basses</a></li>
                                <li><a href="">Guitares acoustiques</a></li>
                                <li><a href="">Guitares classiques</a></li>
                                <li><a href="">Guitare électriques</a></li>
                                <li><a href="">Guitare électro acoustiques</a></li>
                                <li><a href="">Guitare pour gauchers</a></li>
                                <li><a href="">Instruments sectioners</a></li>
                                <li><a href="">Ukulélés</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Batteries<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Batteries acoustiques</a></li>
                                <li><a href="">Batteries électroniques</a></li>
                                <li><a href="">Caisses claires</a></li>
                                <li><a href="">Cymbales</a></li>
                                <li><a href="">Marching & Fanfare</a></li>
                                <li><a href="">Musicothérapie</a></li>
                                <li><a href="">Percussions</a></li>
                                <li><a href="">Xylophones & Carillons</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Clavier<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Accordéons</a></li>
                                <li><a href="">Claviers arrangeurs</a></li>
                                <li><a href="">Claviers maîtres</a></li>
                                <li><a href="">Claviers orientaux</a></li>
                                <li><a href="">Orgues & Clavecins</a></li>
                                <li><a href="">Pianos numériques</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Studio<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Casques & Gestions</a></li>
                                <li><a href="">Enceintes de monitoring</a></li>
                                <li><a href="">Enregistrement</a></li>
                                <li><a href="">Format 500 & Modulaire</a></li>
                                <li><a href="">Informatique</a></li>
                                <li><a href="">Interfaces audio</a></li>
                                <li><a href="">M.A.O</a></li>
                                <li><a href="">Microphones</a></li>
                                <li><a href="">Mixage & Production</a></li>
                                <li><a href="">Périphériques numériques</a></li>
                                <li><a href="">Périphériques analogiques</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Sonorisation<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Amplis de puissance</a></li>
                                <li><a href="">Effets voix</a></li>
                                <li><a href="">Enceintes actives</a></li>
                                <li><a href="">Enceintes passives</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Éclairage<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Décorations</a></li>
                                <li><a href="">Lasers</a></li>
                                <li><a href="">Projecteurs</a></li>
                                <li><a href="">Stroboscopes</a></li>
                                <li><a href="">Vidéo</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">DJ<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Casques</a></li>
                                <li><a href="">Cellules & Diamants</a></li>
                                <li><a href="">Effets DJ</a></li>
                                <li><a href="">Groove stations & Samplers</a></li>
                                <li><a href="">Karaoké</a></li>
                                <li><a href="">Mixeurs numériques</a></li>
                                <li><a href="">Platines CD</a></li>
                                <li><a href="">Tables de mixage DJ</a></li>
                                <li><a href="">Platines vinyles</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Flight cases<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Batteries & Percussions</a></li>
                                <li><a href="">DJ</a></li>
                                <li><a href="">Éléments rackables</a></li>
                                <li><a href="">Pièces détachées</a></li>
                                <li><a href="">Lumières</a></li>
                                <li><a href="">Sono</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Accessoires<span class="arrow-down"></span></a>
                            <ul class="dropdown">
                                <li><a href="">Accessoires Guitares</a></li>
                                <li><a href="">Accessoires Batteries</a></li>
                                <li><a href="">Accessoires Claviers</a></li>
                                <li><a href="">Accessoires Sonorisation</a></li>
                                <li><a href="">Accessoires Éclairage</a></li>
                                <li><a href="">Accessoires DJ</a></li>
                            </ul>
                        </li>
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