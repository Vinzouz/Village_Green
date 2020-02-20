<?php //print_r($users->row_array); 
?>
<div class="main-panel">

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des sous-rubriques</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID sous-rubrique</th>
                        <th>Nom sous-rubrique</th>
                        <th>Description rubrique</th>
                        <th>ID rubrique</th>
                        <th>Modifier / Supprimer</th>

                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($sousrubriques->result() as $sousrubrique) { 
                        
                        ?>
                        <tr>
                            <td><?= $sousrubrique->sousrub_id ?></td>
                            <td><?= $sousrubrique->sousrub_nom ?></td>
                            <td><?= $sousrubrique->sousrub_desc ?></td>
                            <td><?= $sousrubrique->sousrub_rubrique_id ?></td>
                            <td><p><a href="<?= site_url("adminsousrubriques/editSousRubrique/$sousrubrique->sousrub_id") ?>">Modifier</a> / <a href="<?= site_url("adminsousrubriques/deleteSousRubrique/$sousrubrique->sousrub_id") ?>">Supprimer</a></p></td>
                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>