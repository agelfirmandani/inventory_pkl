
        <section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Order
                                
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            <button type="button" onclick="add_order()" class="btn btn-default waves-effect">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name">Data Order</span>
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
                                            <th>No.Order</th>
                                            <th>Tanggal</th>
                                            <th>Nama Dikirim</th>
                                            <th>Alamat</th>
                                            <th>Subtotal</th>
                                            <th>Tanggal Kirim</th>
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
            "url": "<?php echo site_url('admin/C_order/ajax_list')?>",
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



function add_order()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Order'); // Set Title to Bootstrap modal title
}

function edit_order(ID_ORDER)
{
    save_method = 'detail';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/C_order/ajax_edit/')?>/" + ID_ORDER,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="ID_ORDER"]').val(data.ID_ORDER);
            $('[name="CB_ID"]').val(data.CB_ID);
            $('[name="NOMOR_ORDER"]').val(data.NOMOR_ORDER);
            $('[name="TGL_ORDER"]').val(data.TGL_ORDER);
            $('[name="TYPE_ORDER"]').val(data.TYPE_ORDER);
            $('[name="NAMA_DIKIRIM_ORDER"]').val(data.NAMA_DIKIRIM_ORDER);
            $('[name="ALAMAT_ORDER"]').val(data.ALAMAT_ORDER);
            $('[name="HP_FAX_ORDER"]').val(data.HP_FAX_ORDER);
            $('[name="SUBTOTAL_ORDER"]').val(data.SUBTOTAL_ORDER);
            $('[name="PPN_ORDER"]').val(data.PPN_ORDER);
            $('[name="TOTAL_ORDER"]').val(data.TOTAL_ORDER);
            $('[name="TGL_KIRIM_ORDER"]').val(data.TGL_KIRIM_ORDER);
            $('[name="TUNAI_ORDER"]').val(data.TUNAI_ORDER);
            $('[name="DP_ORDER"]').val(data.DP_ORDER);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Order'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function detail_order(ID_ORDER)
{
    save_method = 'detail';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
            $.ajax({
                url:"<?php echo site_url('admin/C_order/ajax_detail/')?>/" + ID_ORDER,
                type:"GET",
                dataType: 'json',
                success: function(hasil){
                    $('[name="ID_ORDER"]').val(hasil.ID_ORDER);
                    $('[name="CB_ID"]').val(hasil.CB_ID);
                    $('[name="NOMOR_ORDER"]').val(hasil.NOMOR_ORDER);
                    $('[name="TGL_ORDER"]').val(hasil.TGL_ORDER);
                    $('[name="TYPE_ORDER"]').val(hasil.TYPE_ORDER);
                    $('[name="NAMA_DIKIRIM_ORDER"]').val(hasil.NAMA_DIKIRIM_ORDER);
                    $('[name="ALAMAT_ORDER"]').val(hasil.ALAMAT_ORDER);
                    $('[name="HP_FAX_ORDER"]').val(hasil.HP_FAX_ORDER);
                    $('[name="SUBTOTAL_ORDER"]').val(hasil.SUBTOTAL_ORDER);
                    $('[name="PPN_ORDER"]').val(hasil.PPN_ORDER);
                    $('[name="TOTAL_ORDER"]').val(hasil.TOTAL_ORDER);
                    $('[name="TGL_KIRIM_ORDER"]').val(hasil.TGL_KIRIM_ORDER);
                    $('[name="TUNAI_ORDER"]').val(hasil.TUNAI_ORDER);
                    $('[name="DP_ORDER"]').val(hasil.DP_ORDER);
                    $('#OrderDetail').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Detail Order'); // Set title to Bootstrap modal title
                    
                    
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
        url = "<?php echo site_url('admin/C_order/ajax_add')?>";
    } else {
        url = "<?php echo site_url('admin/C_order/ajax_update')?>";
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

function delete_order(ID_ORDER)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/C_order/ajax_delete')?>/"+ID_ORDER,
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
                <h3 class="modal-title">Form Data Order</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
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
                            <?php echo form_close() ?>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Order</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="NOMOR_ORDER" value="<?php echo $kode; ?>" class="form-control" type="text" readonly>
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="TGL_ORDER" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Type Order</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="TYPE_ORDER" placeholder="TYPE ORDER" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penerima</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="NAMA_DIKIRIM_ORDER" placeholder="e.g. John Smith" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <textarea name="ALAMAT_ORDER" rows="4" class="form-control no-resize" placeholder="Jl. example no.x kec.example kota example kode pos xxxxx" type="text"></textarea>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <<div class="form-group">
                            <label class="control-label col-md-3">No. Telp/Fax</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone_iphone</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text"name="HP_FAX_ORDER" class="form-control mobile-phone-number" placeholder="Ex: +00 (000) 000-00-00" type="text">
                                    </div>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sub Total</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="SUBTOTAL_ORDER" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">PPN Order</label>
                            <div class="demo-checkbox col-md-4">
                                <label for="basic_checkbox_2">Filled In</label>
                                <input type="checkbox" id="basic_checkbox_3" checked disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">PPN Order</label>
                            <div class="col-md-9">
                                <input name="PPN_ORDER" placeholder="PPN Order" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Order</label>
                            <div class="col-md-9">
                                <input name="TOTAL_ORDER" placeholder="Total Order" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Kirim</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="TGL_DIKIRIM_ORDER" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tunai Order</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="TUNAI_ORDER" placeholder="e.g. 120000" class="form-control" type="text">
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">DP Order</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="DP_ORDER" placeholder="e.g 80000" class="form-control" type="text">
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