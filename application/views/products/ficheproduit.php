<div class="container">

	<?php

	echo '<p style="font-size: 66px;">' . $getdataProduit[0]['produit_id'] . '</p>';
	?>

	
    <img height="40%" src=<?= base_url('assets/images/Imagesproducts/' . @$jointureSousrubRub[0]['rubrique_id'] . '/' . @$jointureSousrubRub[0]['sousrub_id'] . '/' . @$jointureSousrubRub[0]['produit_id'] . '/product.jpg') ?> alt="Image name">
    


	<select class="form-control" name="pro_qte" id="pro_qte">
		<?php
		for ($i = 1; $i < 11; $i++) {
			echo "<option value=" . '"' . $i . '"' . ">" . $i . "</option>";
		}
		?>
	</select>

	<input type="hidden" name="pro_id" id="pro_id" value="<?= @$getdataProduit[0]['produit_id'] ?>">

	<button type="submit" id="ajoutP"><i class="fas fa-plus-circle"></i></button>

		<?php print_r($getdataProduit);
		echo '<br>';
		echo '<br>';
		echo '<br>';
		echo '<br>';
		print_r($jointureSousrubRub[0]); ?>

</div>