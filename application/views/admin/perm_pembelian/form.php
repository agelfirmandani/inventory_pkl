
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORM VALIDATION
                    <small>Taken from <a href="https://jqueryvalidation.org/" target="_blank">jqueryvalidation.org</a></small>
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>BASIC VALIDATION</h2>
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
                            <form id="form_validation" method="POST">
                            <input type="hidden" value="" name="ID_PERM_PEMBELIAN"/> 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="PP_NOMOR" value="<?php echo $kode; ?>" readonly>
                                        <label class="form-label">Nomor</label>
                                    </div>
                                </div>
                                <?php echo form_open($action); ?>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <?php
                                        $attr = '<select class="form-control show-tick" data-live-search="true">';
                                            '<option>';
                                                echo form_dropdown('CB_ID', $get2, $cabang_selected, $attr);
                                            '</option>';
                                        '</select>';
                                    ?>
                                        <label class="form-label">Cabang</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <input type="text" name="PP_TGL" value="<?php echo date('Y/m/d');?>" class="form-control" placeholder="Please choose a date...">
                                        <label class="form-label">Tanggal</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <input type="text" name="PP_TGL_BUTUH" class="datepicker form-control" placeholder="Please choose a date...">
                                        <label class="form-label">Tanggal Butuh</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="PP_JENIS" id="PP_JENIS" value="Barang" class="with-gap" checked>
                                    <label for="male">Barang</label>

        
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
</body>

</html>
