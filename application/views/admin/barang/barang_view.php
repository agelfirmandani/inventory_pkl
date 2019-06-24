<section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <ol class="breadcrumb breadcrumb-bg-blue-grey">
                                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Master Gudang</a></li>
                                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Barang</a></li>
                                <li class="active"><i class="material-icons">archive</i> Data</li>
                            </ol>
                        </div>
                               
                        <div class="body">
                                   
                            <div class="table-responsive">
                                    <button type="button" onclick="add_brg()" class="btn btn-default waves-effect align-right">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name">Data Barang</span>
                                    </button>
                                    <button type="button" onclick="reload_table()" class="btn btn-default waves-effect align-right">
                                        <i class="material-icons">autorenew</i><span class="icon-name">Reload</span>
                                    </button><br><br>
                            <table id="table" class="table table-striped table-bordered " cellspacing="0" width="100%">
        
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Brand</th>
                                            <th>Satuan</th>
                                            <th>Category</th>
                                            <th>Jenis Barang</th>
                                            <th>Nama</th>
                                            <th>Stok</th>
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
            "url": "<?php echo site_url('admin/C_barang/ajax_list')?>",
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



function add_brg()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data barang'); // Set Title to Bootstrap modal title
}

function edit_barang(ID_BRG)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/C_barang/ajax_edit/')?>/" + ID_BRG,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="ID_BRG"]').val(data.ID_BRG);
            $('[name="ID_BRAND"]').val(data.ID_BRAND);
            $('[name="ID_SATUAN"]').val(data.ID_SATUAN);
            $('[name="ID_CATEGORY"]').val(data.ID_CATEGORY);
            $('[name="ID_JNS_BRG"]').val(data.ID_JNS_BRG);
            $('[name="NOMOR_BRG"]').val(data.NOMOR_BRG);
            $('[name="NAMA_BRG"]').val(data.NAMA_BRG);
            $('[name="HARGA_BELI"]').val(data.HARGA_BELI);
            $('[name="HARGA_JUAL"]').val(data.HARGA_JUAL);
            $('[name="STOK"]').val(data.STOK);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function detail_barang(ID_BRG)
{
    save_method = 'detail';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
            $.ajax({
                url:"<?php echo site_url('admin/C_barang/ajax_detail/')?>/" + ID_BRG,
                type:"GET",
                dataType: 'json',
                success: function(hasil){
                    $('[name="ID_BRG"]').val(hasil.ID_BRG);
                    $('[name="ID_BRAND"]').val(hasil.ID_BRAND);
                    $('[name="NAMA_BRAND"]').val(hasil.NAMA_BRAND);
                    $('[name="ID_SATUAN"]').val(hasil.ID_SATUAN);
                    $('[name="NAMA_SATUAN"]').val(hasil.NAMA_SATUAN);
                    $('[name="ID_CATEGORY"]').val(hasil.ID_CATEGORY);
                    $('[name="NAMA_CATEGORY"]').val(hasil.NAMA_CATEGORY);
                    $('[name="ID_JNS_BRG"]').val(hasil.ID_JNS_BRG);
                    $('[name="NAMA_JNS_BRG"]').val(hasil.NAMA_JNS_BRG);
                    $('[name="NOMOR_BRG"]').val(hasil.NOMOR_BRG);
                    $('[name="NAMA_BRG"]').val(hasil.NAMA_BRG);
                    $('[name="HARGA_BELI"]').val(hasil.HARGA_BELI);
                    $('[name="HARGA_JUAL"]').val(hasil.HARGA_JUAL);
                    $('[name="STOK"]').val(hasil.STOK);
                    $('#DetailForm').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Detail Barang'); // Set title to Bootstrap modal title
                    
                    
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
        url = "<?php echo site_url('admin/C_barang/ajax_add')?>";
    }else{
        url = "<?php echo site_url('admin/C_barang/ajax_update')?>";
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

function delete_barang(ID_BRG)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_barang/ajax_delete')?>/"+ID_BRG,
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
                <h3 class="modal-title">Barang Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                     <div class="row clearfix">
                     <input type="hidden" name="ID_BRG">
                            <?php echo form_open($action); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3">Brand</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_BRAND', $get, $brand_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            <div class="form-group">
                                <label class="control-label col-md-3">Satuan</label>
                                <div  class="col-md-6">
                                <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_SATUAN', $get2, $satuan_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            <div class="form-group">
                                <label class="control-label col-md-3">Kategori</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_CATEGORY', $get3, $category_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            <div class="form-group">
                                <label class="control-label col-md-3">Jenis Barang</label>
                                <div  class="col-md-6">
                                <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_JNS_BRG', $get4, $jns_brg_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            <?php echo form_close() ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Barang</label>
                            <div class="col-md-6">
                                <div class="form-line">
                                    <input name="NOMOR_BRG" value="<?php echo $kode ?>"placeholder="Nomor Barang" class="form-control" type="text" readonly>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Barang</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input name="NAMA_BRG" placeholder="Nama Barang" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Harga Beli</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="HARGA_BELI" placeholder="1xxxxxx" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Harga Jual</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="HARGA_JUAL" placeholder="1xxxxxx" class="form-control" type="text">
                                </div>    
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Stok Barang</label>
                            <div class="col-md-2">
                                <div class="form-line">
                                    <input name="STOK" placeholder="Jumlah" class="form-control" type="text">
                                </div>
                                <span class="help-block"></span>
                            </div>
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
