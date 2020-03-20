<div class="container">

<?php

echo '<p style="font-size: 66px;">'.$idP.'</p>';
?>

              <select class="form-control" name="pro_qte" id="pro_qte">
								<?php
									for ($i = 1; $i < 11; $i++)
									{
										echo "<option value=".'"'.$i.'"'.">".$i."</option>";
									}
								?>
							</select>

              <input type="hidden" name="pro_id" id="pro_id" value="<?= @$idP ?>">

             <button type="submit" id="ajoutP"><i class="fas fa-plus-circle"></i></button>

                                </div>