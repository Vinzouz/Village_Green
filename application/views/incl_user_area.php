<div class="container">
<?php 
// Permet de transcrire un objet en valeur affichable.
$clientFiche = json_decode(json_encode($data), True); 
?>
    <div class="globalEC">
        <div class="titrePage"><h2>Espace Client</h2></div>

        <div class="logoEC"></div>

        <div class="infosClient">
            <p><span>Nom :</span> <?= $clientFiche[0]['client_nom'];?></p>
            <p><span>Prénom :</span> <?= $clientFiche[0]['client_prenom'];?></p>
            <p><span>Mail :</span> <?= $clientFiche[0]['client_mail'];?></p>
            <p><span>Adresse :</span> <?= $clientFiche[0]['client_adresse'];?></p>
        </div>

        <div class="titre infoCpt">
            <h2>Mon Compte</h2>
        </div>
            

        <div class="general testCompte">
            <p><a href="#">Modifier les informations du compte</a></p>
            <p><a href="#">Modifier le mot de passe</a></p>
            <p><a href="#">Modifier son adresse mail</a></p>
            <p><a href="#">Désactiver le compte</a></p>
        </div>
        

        <div class="historique">
            <h2>Historique de commandes</h2>
        </div>

        <div class="historique histoBreak">
            <h2>Historique</h2>
        </div>

        <div class="general histo">
<!-- Va permettre d'afficher les différentes commandes enregistrées dans la BDD, view à créer pour le detail -->
            <?php foreach($data as $commande)
            {?>
            <p>Commande n°<?= $commande->commande_id;?> (<a href="#">Details</a>)</p>
            <?php }?>
        </div>
        

        <div class="autres">
            <h2>Autres</h2>
        </div>
        <div class="general autresInfos">
            <p><a href="#">Modifier les moyens de paiement</a></p>
            <p><a href="#">A propos de Village Green</a></p>
            <p><a href="#">Nous contacter</a></p>
            <p><a href="#">Foire aux Questions (FAQ)</a></p>
        </div>
        

    </div>



</div>