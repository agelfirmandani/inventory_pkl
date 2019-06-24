<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORM WIZARD
                    <small>Taken from <a href="https://github.com/rstaib/jquery-steps" target="_blank">github.com/rstaib/jquery-steps</a> & <a href="https://jqueryvalidation.org/" target="_blank">jqueryvalidation.org</a></small>
                </h2>
            </div>
            <!-- Basic Example | Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>BASIC EXAMPLE - HORIZONTAL LAYOUT</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="wizard_horizontal">
                                <h2>First Step</h2>
                                <section>
     <form id="form" action="#"class="form-horizontal">
      <input type="hidden" name="ID_PERM_PEMBELIAN">
      <div class="body">
            <div class="row clearfix">
            <div class="col-md-12">  
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Nomor</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="PP_NOMOR" class="form-control" placeholder="Nomor Permintaan Pembelian" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
            <div class="col-md-12">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Cabang</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
           <?php echo form_open($action); ?>
                <?php
				    $attr = '<select class="form-control show-tick" data-live-search="true">';
                    echo form_dropdown('CB_ID', $get, $cabang_selected, $attr);
                    '</select>';
                ?>
            <?php echo form_close() ?>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Tanggal</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="date" name="PP_TGL" class="form-control" placeholder="Please choose a date...">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Tanggal Butuh</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <input type="date" name="PP_TGL_BUTUH"  class="form-control" placeholder="Please choose a date...">
                        <span class="help-block"></span>   
                    </div>
                </div>
            </div>
            </div>
           
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Jenis</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                    <div class="demo-radio-button">
                                <input name="PP_JENIS" type="radio" id="radio_1" value="Barang" checked/>
                                <label for="Barang">Barang</label>
                            </div>
                            
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Gudang</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">                  
            <?php echo form_open($action); ?>
                <?php
				    $attr = '<select class="form-control show-tick" data-live-search="true">';
                    echo form_dropdown('ID_GDG', $get2, $gudang_selected, $attr);
                    '</select>';
                ?>
            <?php echo form_close() ?>
                        </div>
                        </div>
            </form> 
                                </section>

                                <h2>Second Step</h2>
                                <section>
                                <form id="form_brg" action="#"class="form-horizontal">
            <input type="hidden" name="id">
            <input type="hidden" name="pp_id">
                        <div class="col-md-12">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Nama Barang</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">                  
            <?php echo form_open($action); ?>
                <?php
				    $attr = '<select class="form-control show-tick" data-live-search="true">';
                    echo form_dropdown('ID_BRG', $get3, $barang_selected, $attr);
                    '</select>';
                ?>
            <?php echo form_close() ?>
                        </div>
                        </div>
            <div class="col-md-6">  
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Qty</label>
                                    </div>
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="qty" class="form-control" placeholder="Qty" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    </div>
                        <input type="hidden" name="status" value="0">
                        <div class="col-md-12">  
                    <button type="button" id="btnSave_brg" onclick="save_brg()" class="btn btn-default waves-effect">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name"></span>
                                    </button>
                                    <button type="button" onclick="reload_table_brg()" class="btn btn-default waves-effect">
                                        <i class="material-icons">autorenew</i><span class="icon-name"></span>
                                    </button>


            </div>
            </form>
            <div class="form-group" id="tblInsert">
            
                        <div class="table-responsive">
                           
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-brg">

                                     <thead>

                                            <tr>

                                                <th> No </th>

                                               
                                                <th> Uraian dan Spesifikasi Barang/Jasa </th>

                                                <th> Qty </th>

                                                <th> Satuan </th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            </tbody>

                                            </table>
                                                                      
                            </div>
                        </div>
                                </section>

                               
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function () {
    //datatables
    table = $('#table_brg').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/C_perm_pembelian/list_brg')?>",
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

});
function add_barang()
{
    save_method = 'add_brg';
    $('#form_brg')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
   // $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Permintaan Pembelian'); // Set Title to Bootstrap modal title
}



function add_perm_pembelian()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Permintaan Pembelian'); // Set Title to Bootstrap modal title
}

function edit_perm_pembelian(ID_PERM_PEMBELIAN)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/C_perm_pembelian/ajax_edit/')?>/" + ID_PERM_PEMBELIAN,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="ID_PERM_PEMBELIAN"]').val(data.ID_PERM_PEMBELIAN);
            $('[name="CB_ID"]').val(data.CB_ID);
            $('[name="PP_NOMOR"]').val(data.PP_NOMOR);
            $('[name="PP_TGL"]').val(data.PP_TGL);
            $('[name="PP_TGL_BUTUH"]').val(data.PP_TGL_BUTUH);
            $('[name="PP_JENIS"]').val(data.PP_JENIS);
            $('[name="ID_GDG"]').val(data.ID_GDG);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Penawaran'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table_brg()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('admin/C_perm_pembelian/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/C_perm_pembelian/ajax_update')?>";
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
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table_brg();
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
function save_brg()
{
    $('#btnSave_brg').text('saving...'); //change button text
    $('#btnSave_brg').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add_brg') {
        url = "<?php echo site_url('admin/C_perm_pembelian/ajax_add_barang')?>";
    } else {
        url = "<?php echo site_url('admin/C_perm_pembelian/list_brg')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_brg').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                reload_table_brg();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                   // $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave_brg'); //change button text
            $('#btnSave_brg').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave_brg'); //change button text
            $('#btnSave_brg').attr('disabled',false); //set button enable 

        }
    });
}

function delete_perm_pembelian(ID_PERM_PEMBELIAN)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_perm_pembelian/ajax_delete')?>/"+ID_PERM_PEMBELIAN,
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
function delete_list_brg(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_perm_pembelian/ajax_delete_barang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table_brg();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}


</script>