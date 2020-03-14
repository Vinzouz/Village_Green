<div class="container">

<?php

echo '<p style="font-size: 66px;">'.$idP.'</p>';
?>

<?php echo form_open('panier/ajoutPanier/'.$idP.''); ?>


              <select class="form-control" name="pro_qte" id="pro_qte">
								<?php
									for ($i = 1; $i < 11; $i++)
									{
										echo "<option value=".'"'.$i.'"'.">".$i."</option>";
									}
								?>
							</select>

              <input type="hidden" name="produit_id" value="<?= @$idP ?>">

             <button type="submit"><i class="fas fa-plus-circle"></i></button>
            <?php form_close() ?>

                                </div>