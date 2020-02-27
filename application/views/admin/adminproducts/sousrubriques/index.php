<?php //print_r($users->row_array); 
?>

<div class="main-panel">

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des sous-rubriques</h4>

            <table id="sousrubTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID sous-rubrique</th>
                        <th>Nom sous-rubrique</th>
                        <th>Description rubrique</th>
                        <th>ID rubrique</th>
                        <th>Modifier / Supprimer</th>

                    </tr>
                </thead>


            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
        $('#sousrubTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url('adminsousrubriques/listeSousrub')?>'
          },
          'columns': [

             { data: 'sousrub_id' },
             { data: 'sousrub_nom' },
             { data: 'sousrub_desc' },
             { data: 'sousrub_rubrique_id' },
             { data: "sousrub_id",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data,type,row,meta) { // render event defines the markup of the cell text
                            var a = '<a href="/adminsousrubriques/editSousRubrique/'+ data +'">Modifier</a> / <a href="/adminsousrubriques/deleteSousRubrique/'+ data +'">Supprimer</a>';
                            
                             // row object contains the row data
                            return a;
                            
                             }
            
             }
          ]
        });
     });
     </script>