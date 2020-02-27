<?php //print_r($users->row_array); 
?>

<div class="main-panel">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des utilisateurs</h4>

            <table id='clientsTable' class='display dataTable'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Telephone</th>
                        <th>Mail</th>
                        <th>Type</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
        $('#clientsTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url('adminclients/listeClients')?>'
          },
          'columns': [

             { data: 'client_id' },
             { data: 'client_nom' },
             { data: 'client_telephone' },
             { data: 'client_mail' },
             { data: 'client_type' },
             { data: "client_id",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row,meta) { // render event defines the markup of the cell text
                            var a = '<a href="/adminclients/deleteClient/'+ data +'">Supprimer</a>'; // row object contains the row data
                            return a; }
             }
          ]
        });
     });
     </script>