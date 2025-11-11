<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Productsbeheer';
$this->endSection();

$this->section('page_name');
echo 'Products';
$this->endSection();

$this->section('content');

if(session()->get('success')){
    echo '<div class="alert alert-success" role="alert">
        '.session('success').'
    </div>';
}
?>

<style>
/* Toggle switch CSS compatible met Bootstrap 4 */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 25px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #4e73df;
}
input:checked + .slider:before {
  transform: translateX(24px);
}
</style>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo route_to('createProduct'); ?>" class="btn btn-primary">Nieuwe product</a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableMerken" width="100%" cellspacing="0">
                    <thead>
                    
                        <?php
                        if(isset($prods)){
                            ?>
                                <tr>
                                    <th>Name</th>
                                    <th>Activeren</th>
                                    <th>Bewerken</th>
                                    <th>Verwijderen</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Activeren</th>
                                    <th>Bewerken</th>
                                    <th>Verwijderen</th>
                                </tr>
                                </tfoot>
                            <?php
                        }else if(isset($sub)){
                            ?>
                                <tr>
                                    <th>Name</th>
                                    <th>Activeren</th>
                                    <th>Bekijken</th>
                                    <th>Bewerken</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Activeren</th>
                                    <th>Bekijken</th>
                                    <th>Bewerken</th>
                                </tr>
                                </tfoot>
                            <?php
                        }else{
                            ?>
                                <tr>
                                    <th>Name</th>
                                    <th>Copy</th>
                                    <th>Bewerken</th>
                                    <th>Verwijderen</th>
                                    
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Copy</th>
                                    <th>Bewerken</th>
                                    <th>Verwijderen</th>
                                </tr>
                                </tfoot>
                            <?php
                        }
                        ?>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
$this->endSection();

$this->section('jsscript');
?>

<script type="text/javascript">
    $(function() {
        $(document).on('change', '.myToggle', function () {
            const checkbox   = $(this);
            const id         = checkbox.data('id');        // haal data-id op
            const isActive   = checkbox.is(':checked') ? 1 : 0;

            $.ajax({
                url: '<?= route_to('setActive') ?>',      // CI4 helper genereert de juiste base-url
                method: 'POST',
                data: {
                    id: id,
                    active: isActive
                },
                dataType: 'json',
                headers: {                                 // CSRF-token meesturen (indien ingeschakeld)
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_hash(); ?>'
                },
                success: function (response) {
                    if (response.status === 'ok') {
                        // eventueel een kleine toast / icoon wisselen
                        alert('Status opgeslagen ✔');
                    } else {
                        // terugrollen als de backend faalt
                        checkbox.prop('checked', !isActive);
                        alert('Kon status niet opslaan, probeer opnieuw.');
                    }
                },
                error: function () {
                    checkbox.prop('checked', !isActive);
                    alert('Serverfout – wijziging niet opgeslagen.');
                }
            });
        });
        
        $('[data-toggle="tooltip"]').tooltip({
            placement : 'top'
        });

        <?php
        if(isset($sub)){
            if(isset($id)){
                if(isset($prods)){
                ?>
                
                $('#dataTableMerken').dataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        url: '<?= route_to('getMerken'); ?>',
                        type: 'POST',
                        data: function(d) {
                            d.id = <?= $id ?>,
                            d.prods = <?= $prods ?>;
                        }
                    },
                    'displayLength': 50,
                    "aaSorting": [],
                    language: {
                        search: "",
                        searchPlaceholder: "Zoeken...",
                        "emptyTable": "Geen resultaten",
                        "info": "Toon _START_ tot _END_ van totaal _TOTAL_ resultaten",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Toon _MENU_ resultaten",
                        "loadingRecords": "Laden...",
                        "processing": "Laden...",
                        "zeroRecords": "Geen resultaten op basis van je zoekopdracht...",
                        "paginate": {
                            "first": "Eerste",
                            "last": "Laatste",
                            "next": ">>",
                            "previous": "<<"
                        }
                    }
                });

                <?php
                }else{
                    ?>

                        $('#dataTableMerken').dataTable({
                            'processing': true,
                            'serverSide': true,
                            'serverMethod': 'post',
                            'ajax': {
                                url: '<?= route_to('getMerken'); ?>',
                                type: 'POST',
                                data: function(d) {
                                    d.id = <?= $id ?>;
                                }
                            },
                            'displayLength': 50,
                            "aaSorting": [],
                            language: {
                                search: "",
                                searchPlaceholder: "Zoeken...",
                                "emptyTable": "Geen resultaten",
                                "info": "Toon _START_ tot _END_ van totaal _TOTAL_ resultaten",
                                "infoFiltered": "(filtered from _MAX_ total entries)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Toon _MENU_ resultaten",
                                "loadingRecords": "Laden...",
                                "processing": "Laden...",
                                "zeroRecords": "Geen resultaten op basis van je zoekopdracht...",
                                "paginate": {
                                    "first": "Eerste",
                                    "last": "Laatste",
                                    "next": ">>",
                                    "previous": "<<"
                                }
                            }
                        });

                    <?php
                }
            }else{
                ?>

                $('#dataTableMerken').dataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': '<?php echo route_to('getMerken'); ?>',
                    'displayLength': 50,
                    "aaSorting": [],
                    language: {
                        search: "",
                        searchPlaceholder: "Zoeken...",
                        "emptyTable": "Geen resultaten",
                        "info": "Toon _START_ tot _END_ van totaal _TOTAL_ resultaten",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Toon _MENU_ resultaten",
                        "loadingRecords": "Laden...",
                        "processing": "Laden...",
                        "zeroRecords": "Geen resultaten op basis van je zoekopdracht...",
                        "paginate": {
                            "first": "Eerste",
                            "last": "Laatste",
                            "next": ">>",
                            "previous": "<<"
                        }
                    }
                });

                <?php
            }
        }else{
        ?>
            $('#dataTableMerken').dataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': '<?php echo route_to('getProds'); ?>',
                'displayLength': 50,
                "aaSorting": [],
                language: {
                    search: "",
                    searchPlaceholder: "Zoeken...",
                    "emptyTable": "Geen resultaten",
                    "info": "Toon _START_ tot _END_ van totaal _TOTAL_ resultaten",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Toon _MENU_ resultaten",
                    "loadingRecords": "Laden...",
                    "processing": "Laden...",
                    "zeroRecords": "Geen resultaten op basis van je zoekopdracht...",
                    "paginate": {
                        "first": "Eerste",
                        "last": "Laatste",
                        "next": ">>",
                        "previous": "<<"
                    }
                }
            });
        <?php
        }
        ?>
    });
</script>
    
<?php
$this->endSection();
?>