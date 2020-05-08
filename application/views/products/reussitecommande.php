<?php 
// Vue reussitecommande qui gère l'affichage après avoir passé une commande
?>
<div class="container">

<p>Bravo, votre commande est bien passée !</p>
<p>Pour voir le récapitulatif ou l'avancement de votre commande, c'est par <a href="<?= base_url('espaceclient/detailscommande/'.@$commande[0]['commande_id'].'') ?>">ICI.</a></p>

</div>
