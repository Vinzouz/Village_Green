<?php //print_r($users->row_array); 
?>


<div class="main-panel">

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des produits</h4>

            <table id="produitsTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID produit</th>
                        <th>Marque produit</th>
                        <th>Nom produit</th>
                        <th>Prix produit HT</th>
                        <th>Sous rubrique produit</th>
                        <th>Quantité produit</th>
                        <th>Modifier / Supprimer</th>
                    </tr>
                </thead>


            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
        $('#produitsTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url('adminproducts/listeProduits')?>'
          },
          'columns': [
             { data: 'produit_id' },
             { data: 'produit_marque' },
             { data: 'produit_nom' },
             { data: 'produit_prix_HT' },
             { data: 'produit_sousrub_id' },
             { data: 'produit_qtite' },
             { data: "produit_id",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row,meta) { // render event defines the markup of the cell text
                            var a = '<a href="/adminproducts/editProduct/'+ data +'">Modifier</a> / <a href="/adminproducts/deleteProduct/'+row['produit_sousrub_id']+'/'+ data +'">Supprimer</a>';
                            
                             // row object contains the row data
                            return a;
                            
                             }
            
             }
          ]
        });
     });
     </script>