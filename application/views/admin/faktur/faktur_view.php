<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Faktur
                                <ul class="header-dropdown m-r--5">
                                    <button type="button" onclick="add_faktur()" class="btn btn-default waves-effect">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name">Data Barang</span>
                                    </button>
                                    <button type="button" onclick="reload_table()" class="btn btn-default waves-effect">
                                        <i class="material-icons">autorenew</i><span class="icon-name">Reload</span>
                                    </button>
                                </ul>
                            </h2>
                        </div>
    
                        <div class="body">
                            <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered " cellspacing="0" width="100%">
        
                                    <thead>
                                        <tr>
                                            <th>Cabang</th>
                                            <th>No. Faktur</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Tujuan Transfer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
            
        </div>
    </section>


<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function () {
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/C_faktur/ajax_list')?>",
            "type": "POST"
           
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    /*datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });*/

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_faktur()
{
    save_method = 'add';
    //$('#form') .reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Faktur'); // Set Title to Bootstrap modal title
}

function edit_faktur(ID_FAKTUR)
{
    save_method = 'update';
   // $('#form') .reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/C_faktur/ajax_edit/')?>/" + ID_BRG,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="ID_FAKTUR"]').val(data.ID_FAKTUR);
            $('[name="CB_ID"]').val(data.CB_ID);
            $('[name="ID_SJ"]').val(data.ID_SJ);
            $('[name="NOMOR_FAKTUR"]').val(data.NOMOR_FAKTUR);
            $('[name="TGL_FAKTUR"]').val(data.TGL_FAKTUR);
            $('[name="JATUH_TEMPO_FAKTUR"]').val(data.JATUH_TEMPO_FAKTUR);
            $('[name="SUBTOTAL_FAKTUR"]').val(data.SUBTOTAL_FAKTUR);
            $('[name="POTONGAN_FAKTUR"]').val(data.POTONGAN_FAKTUR);
            $('[name="UANGMUKA_FAKTUR"]').val(data.UANGMUKA_FAKTUR);
            $('[name="TOTAL_FAKTUR"]').val(data.TOTAL_FAKTUR);
            $('[name="TUJUAN_TRANSFER_FAKTUR"]').val(data.TUJUAN_TRANSFER_FAKTUR);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Faktur'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function detail_faktur(ID_FAKTUR)
{
    save_method = 'detail';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
            $.ajax({
                url:"<?php echo site_url('admin/C_faktur/ajax_detail/')?>/" + ID_FAKTUR,
                type:"GET",
                dataType: 'json',
                success: function(hasil){
                    $('[name="ID_FAKTUR"]').val(data.ID_FAKTUR);
                    $('[name="CB_ID"]').val(data.CB_ID);
                    $('[name="ID_SJ"]').val(data.ID_SJ);
                    $('[name="NOMOR_FAKTUR"]').val(data.NOMOR_FAKTUR);
                    $('[name="TGL_FAKTUR"]').val(data.TGL_FAKTUR);
                    $('[name="JATUH_TEMPO_FAKTUR"]').val(data.JATUH_TEMPO_FAKTUR);
                    $('[name="SUBTOTAL_FAKTUR"]').val(data.SUBTOTAL_FAKTUR);
                    $('[name="POTONGAN_FAKTUR"]').val(data.POTONGAN_FAKTUR);
                    $('[name="UANGMUKA_FAKTUR"]').val(data.UANGMUKA_FAKTUR);
                    $('[name="TOTAL_FAKTUR"]').val(data.TOTAL_FAKTUR);
                    $('[name="TUJUAN_TRANSFER_FAKTUR"]').val(data.TUJUAN_TRANSFER_FAKTUR);
                    $('#DetailForm').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Detail Faktur'); // Set title to Bootstrap modal title
                    
                    
                } 
            })
        }

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('admin/C_faktur/ajax_add')?>";
    }else{
        url = "<?php echo site_url('admin/C_faktur/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_faktur(ID_FAKTUR)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_faktur/ajax_delete')?>/"+ID_BRG,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Faktur</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                     <div class="row clearfix">
                        <?php echo form_open($action); ?>
                            
                        <div class="form-group">
                            <label class="control-label col-md-3">Cabang</label>
                            <div  class="col-md-9">
                                <?php
                                $attr = '<select class="form-control">';
                                echo form_dropdown('CB_ID', $get, $cabang_selected, $attr);
                                '</select>';
                                ?>
                                </div>
                        </div>                         
                            <?php echo form_close() ?>
                            <?php echo form_open($action); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3">Surat Jalan</label>
                                <div  class="col-md-9">
                                <?php
                                $attr = '<select class="form-control" id="exampleFormControlSelect1">';
                                $tes= '</select>';
                                echo form_dropdown('ID_SJ', $get2, $s_jalan_selected, $attr,$tes);
                                ?>
                            </div>
                            </div>
                            <?php echo form_close() ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Faktur</label>
                            <div class="col-md-9">
                                <input name="NOMOR_FAKTUR" placeholder="Nomor Faktur" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-9">
                                <input name="TGL_FAKTUR" placeholder="yyyy/mm/dd" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jatuh Tempo</label>
                            <div class="col-md-9">
                                <input name="JATUH_TEMPO_FAKTUR" placeholder="Jatuh Tempo" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sub Total</label>
                            <div class="col-md-9">
                                <input name="SUBTOTAL_FAKTUR" placeholder="Sub Total" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Potongan</label>
                            <div class="col-md-9">
                                <input name="POTONGAN_FAKTUR" placeholder="Potongan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Uang Muka</label>
                            <div class="col-md-9">
                                <input name="UANGMUKA_FAKTUR" placeholder="Uang Muka" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Faktur</label>
                            <div class="col-md-9">
                                <input name="TOTAL_FAKTUR" placeholder="Total Faktur" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tujuan Transfer</label>
                            <div class="col-md-9">
                                <input name="TUJUAN_TRANSFER_FAKTUR" placeholder="Tujuan Transfer" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                </form>
                </div>
                </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>