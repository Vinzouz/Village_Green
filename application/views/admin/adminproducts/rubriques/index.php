<?php //print_r($users->row_array); 
?>
<div class="main-panel">

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des rubriques</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID rubrique</th>
                        <th>Nom rubrique</th>
                        <th>Description rubrique</th>

                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rubriques->result() as $rubrique) { 
                        
                        ?>
                        <tr>
                            <td><?= $rubrique->rubrique_id ?></td>
                            <td><?= $rubrique->rubrique_nom ?></td>
                            <td><?= $rubrique->rubrique_desc ?></td>
                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>