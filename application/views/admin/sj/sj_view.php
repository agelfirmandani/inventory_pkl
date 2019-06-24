<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Surat Jalan
                                
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            <button type="button" onclick="add_sj()" class="btn btn-default waves-effect">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name">Data Surat Jalan</span>
                                    </button>
                                    <button type="button" onclick="reload_table()" class="btn btn-default waves-effect">
                                        <i class="material-icons">autorenew</i><span class="icon-name">Reload</span>
                                    </button>
                            </ul>
                        </div>
    
                        <div class="body">
                            <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered " cellspacing="0" width="100%">
        
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Cabang</th>
                                            <th>Nama Pemesan</th>
                                            <th>No. Surat</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Surat</th>
                                            <th>Tanggal Kirim</th>
                                            <th>Ekspedisi</th>
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
                // $(".select2").select2({
                //     placeholder: "Please Select"
                // });

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/C_sj/ajax_list')?>",
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



function add_sj()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Surat Jalan'); // Set Title to Bootstrap modal title
}

function edit_sj(ID_SJ)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/C_sj/ajax_edit/')?>/" + ID_SJ,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {   
            $('[name="ID_SJ"]').val(data.ID_SJ);
            $('[name="CB_ID"]').val(data.CB_ID);
            $('[name="ID_ORDER"]').val(data.ID_ORDER);
            $('[name="NOMOR_SJ"]').val(data.NOMOR_SJ);
            $('[name="JENIS_SJ"]').val(data.JENIS_SJ);
            $('[name="TGL_SJ"]').datepicker('update',data.TGL_SJ);
            $('[name="TGL_KIRIM_SJ"]').datepicker('update',data.TGL_KIRIM_SJ);
            $('[name="EKSPEDISI_SJ"]').val(data.EKSPEDISI_SJ);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Surat Jalan'); // Set title to Bootstrap modal title

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

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('admin/C_sj/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/C_sj/ajax_update')?>";
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

function delete_sj(ID_SJ)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_sj/ajax_delete')?>/"+ID_SJ,
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Data Surat Jalan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="ID_SJ"/> 
                    <div class="row clearfix">
                            <?php echo form_open($action); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3">Cabang</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('CB_ID', $get, $cabang_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                             <div class="form-group">
                                <label class="control-label col-md-3">Nama Pemesan</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_ORDER', $get2, $order_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            <?php echo form_close() ?>
                           
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Surat</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="NOMOR_SJ"value="<?php echo $kode; ?>" placeholder="e.g. RT01xxx" class="form-control" type="text" readonly>
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Surat</label>
                            <div class="col-sm-4">
                                <select class="form-control show-tick" name="JENIS_SJ">
                                            <option >Please Select</option>
                                            <option value="Retur">Retur</option>
                                            <option value="Pembelian">Pembelian</option>
                                            <option value="Penjualan">Penjualan</option>
                                </select>
                            </div><span class="help-block"></span>
                        </div>
                        <span class="help-block"></span>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="TGL_SJ"  value="<?php echo date('Y-m-d');?>" class="datepicker form-control" placeholder="Please choose a date..." readonly='readonly'>
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Kirim</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="TGL_KIRIM_SJ"  class="datepicker form-control" placeholder="Please choose a date...">
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ekspedisi</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="EKSPEDISI_SJ" placeholder="e.g. Truck" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>