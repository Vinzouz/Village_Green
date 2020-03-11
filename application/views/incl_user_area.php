<div class="container">
    <?php
    // Permet de transcrire un objet en valeur affichable.
    $clientFiche = json_decode(json_encode($data), True);
    ?>
    <div class="globalEC">
        <div class="titrePage">
            <h2>Espace Client</h2>
        </div>

        <div class="logoEC"></div>

        <?php foreach ($dataC as $client) : ?>
            <div class="infosClient">
                <p><span>Nom :</span> <?= $client->client_nom; ?></p>
                <p><span>Prénom :</span> <?= $client->client_prenom; ?></p>
                <p><span>Mail :</span> <?= $client->client_mail; ?></p>
                <p><span>Adresse :</span> <?= $client->client_adresse; ?></p>
            </div>

        <?php endforeach; ?>
        <div class="infosClient">

        </div>

        <div class="titre infoCpt">
            <h2>Mon Compte</h2>
        </div>


        <div class="general testCompte">
            <p><a href="<?= site_url('connexion/edit') ?>">Modifier les informations du compte</a></p>
            <p><a href="">Désactiver le compte</a></p>
        </div>


        <div class="historique">
            <h2>Historique de commandes</h2>
        </div>

        <div class="historique histoBreak">
            <h2>Historique</h2>
        </div>

        <div class="general histo">
            <p>
                <!-- Va permettre d'afficher les différentes commandes enregistrées dans la BDD, view à créer pour le detail -->
                <?php
                if ($data != null) {
                    foreach ($data as $commande) { ?>
                        <p>Commande n°<?= $commande->commande_id; ?> (<a href="#">Détails</a>)</p>

                <?php
                    }
                } else {
                    print_r('Aucune commande existante');
                } ?>
            </p>
        </div>


        <div class="autres">
            <h2>Autres</h2>
        </div>
        <div class="general autresInfos">
            <p><a href="">Modifier les moyens de paiement</a></p>
            <p><a href="">A propos de Village Green</a></p>
            <p><a href="">Nous contacter</a></p>
            <p><a href="">Foire aux Questions (FAQ)</a></p>
        </div>


    </div>



</div>