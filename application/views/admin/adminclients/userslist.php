<?php //print_r($users->row_array); 
?>

<div class="main-panel">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des utilisateurs</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Telephone</th>
                        <th>Mail</th>
                        <th>Type</th>
                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($users->result() as $user) { 
                        
                        if ($user->client_type == 'PRO'){
                            $clientypebg = 'badge-success';
                        }else {
                            $clientypebg = 'badge-warning';
                        }
                        
                        ?>
                        <tr>
                            <td><?= $user->client_id ?></td>
                            <td><?= $user->client_nom ?></td>
                            <td><?= $user->client_telephone ?></td>
                            <td><?= $user->client_mail ?></td>
                            <td>
                                <label class="badge <?= $clientypebg ?>"><?= $user->client_type ?></label>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>