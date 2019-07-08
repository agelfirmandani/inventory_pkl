
        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Permintaan Pembelian
                                
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            <!--<a href="<?php echo site_url('admin/C_perm_pembelian/add');?>" class="btn btn-primary"> Add </a>-->
                                   
                            <button type="button" onclick="add_perm_pembelian()" class="btn btn-default waves-effect">
                                        <i class="material-icons">add_circle_outline</i><span class="icon-name">Data Permintaan Pembelian</span>
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
                                            <th>Kode</th>
                                            <th>Cabang</th>
                                            <th>Tanggal</th>
                                            <th>Tanggal Butuh</th>
                                            <th>Jenis</th>
                                            <th>Gudang</th>
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
var count = 0;

$(document).ready(function () {
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/C_perm_pembelian/ajax_list')?>",
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

    //datepicker
    $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });


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


	$('#add').click(function(){
        $('#barang').val('');
		//$('#error_ID_BRG').text('');
        $('#barang').css('border-color', '');
        
		//var error_ID_BRG = '';
		var barang = '';
		if($('#barang').val() == '')
		{
			//error_ID_BRG = 'ID Barang is required';
			//$('#error_ID_BRG').text(error_ID_BRG);
			$('#barang').css('border-color', '#cc0000');
			barang = '';
		}
		else
		{
			//error_ID_BRG = '';
			//$('#error_ID_BRG').text(error_ID_BRG);
			$('#barang').css('border-color', '');
            barang = $('#barang').val();

            if($('#add').text() == 'Add')
			{
				count = count + 1;
				output = '<tr id="row_'+count+'">';
				output += '<td>'+barang+' <input type="hidden" name="hidden_ID_BRG[]" id="ID_BRG'+count+'" class="barang" value="'+barang+'" /></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
				output += '</tr>';
				$('#user_data').append(output);
			}
			else
			{
				var row_id = $('#hidden_row_id').val();
				output = '<td>'+barang+' <input type="hidden" name="hidden_ID_BRG[]" id="barang'+row_id+'" class="barang" value="'+barang+'" /></td>';
				 output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
				$('#row_'+row_id+'').html(output);
			}
		}	
	});

	$(document).on('click', '.remove_details', function(){
		var row_id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this row data?"))
		{
			$('#row_'+row_id+'').remove();
		}
		else
		{
			return false;
		}
	});

	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var count_data = 0;
		$('.ID_BRG').each(function(){
			count_data = count_data + 1;
		});
		if(count_data > 0)
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"insert.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_data').find("tr:gt(0)").remove();
					$('#action_alert').html('<p>Data Inserted Successfully</p>');
					$('#action_alert').dialog('open');
				}
			})
		}
		else
		{
			// $('#action_alert').html('<p>Please Add atleast one data</p>');
			// $('#action_alert').dialog('open');
		}
	});


});



function add_perm_pembelian()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Permintaan Pembelian'); // Set Title to Bootstrap modal title
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
            $('[name="PP_NOMOR"]').val(data.PP_NOMOR);
            $('[name="CB_ID"]').val(data.CB_ID);
            $('[name="PP_TGL"]').val(data.PP_TGL);
            $('[name="PP_TGL_BUTUH"]').val(data.PP_TGL_BUTUH);
            $('[name="PP_JENIS"]').val(data.PP_JENIS);
            $('[name="ID_GDG"]').val(data.ID_GDG);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Permintaan Pembelian'); // Set title to Bootstrap modal title

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
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
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

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Permintaan Pembelian Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="ID_PERM_PEMBELIAN"/> 
                    <div class="row clearfix">
                    <div class="form-group">
                            <label class="control-label col-md-3">Nomor</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <input name="PP_NOMOR" value="<?php echo $kode; ?>" placeholder="e.g. 10050" class="form-control" type="text" readonly>
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                            <?php echo form_open($action); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3">Cabang</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('CB_ID', $get2, $cabang_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="PP_TGL" value="<?php echo date('Y/m/d');?>" class="form-control" placeholder="Please choose a date...">
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tgl. dibutuhkan</label>
                            <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="PP_TGL_BUTUH" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div>
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis</label>
                            <div class="col-md-4">
                                <div class="form-line">
                                    <!-- <input name="PP_JENIS" placeholder="Jenis" class="form-control" type="text"> -->
                                    <input type="radio"  name="PP_JENIS" value="Barang" class="with-gap" id="ig_radio" checked>
                                            <label for="ig_radio">Barang</label>
                                </div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Gudang</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('ID_GDG', $get, $gudang_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                </div>
                            </div><span class="help-block"></span>
                            </form>
			<br />
			<form method="post" id="user_form">
            <div class="form-group">
                                <label class="control-label col-md-3">Barang</label>
                                <div  class="col-md-6">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true" id="barang">';
                                            '<option>';
                                                echo form_dropdown('ID_BRG', $get3, $barang_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                  
                                </div>
                                <div align="right" style="margin-bottom:5px;">
				<button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
			</div>
                            </div>
                            
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="user_data">
						<tr>
							<th>No</th>
							<th>Deskripsi</th>
							<th>Remove</th>
						</tr>
					</table>
				</div>
				<div align="center">
					<input type="submit" name="insert" id="insert" class="btn btn-primary" value="Insert" />
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