
<div class="main-panel">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des commandes</h4>

            <table id='commandesTable' class='display dataTable'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Etat</th>
                        <th>ID client</th>
                        <th>Modifier / Supprimer</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
        $('#commandesTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url('admincommandes/listeCommandes')?>'
          },
          'columns': [

             { data: 'commande_id' },
             { data: 'commande_date' },
             { data: 'commande_prix_tot' },
             { data: 'commande_etat' },
             { data: 'commande_client_id' },
             { data: "commande_id",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row,meta) { // render event defines the markup of the cell text
                            var a = '<a href="/admincommandes/editCommande/'+ data +'">Modifier</a> / <a href="/admincommandes/deleteCommande/'+ data +'">Supprimer</a>'; // row object contains the row data
                            return a; }
             }
          ]
        });
     });
     </script>