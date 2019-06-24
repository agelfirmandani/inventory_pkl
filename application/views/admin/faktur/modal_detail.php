<div class="modal fade" id="DetailForm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Data Faktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p id="pesan"></p>
            <div class="form-group">
                    <label class="control-label col-md-3">ID Faktur</label>
                    <div class="col-md-9">
                        <input name="ID_BRG" placeholder="ID Barang" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Cabang</label>
                    <div class="col-md-9">
                        <input name="CB_ID" placeholder="Cabang" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Jenis Surat Jalan</label>
                    <div class="col-md-9">
                        <input name="JENIS_SJ" placeholder="Jenis Surat Jalan" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">No. Faktur</label>
                    <div class="col-md-9">
                        <input name="NOMOR_FAKTUR" placeholder="No. Faktur" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Tanggal</label>
                    <div class="col-md-9">
                        <input name="TGL_FAKTUR" placeholder="yyyy-mm-dd" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Jatuh Tempo</label>
                    <div class="col-md-9">
                        <input name="JATUH_TEMPO_FAKTUR" placeholder="yyyy-mm-dd" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Sub Total</label>
                    <div class="col-md-9">
                        <input name="SUBTOTAL_FAKTUR" placeholder="Sub Total" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Potongan</label>
                    <div class="col-md-9">
                        <input name="POTONGAN_FAKTUR" placeholder="Potongan" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Uang Muka</label>
                    <div class="col-md-9">
                        <input name="UANGMUKA_FAKTUR" placeholder="Uang Muka" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Nomor Barang</label>
                    <div class="col-md-9">
                        <input name="TOTAL_FAKTUR" placeholder="Total Faktur" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Tujuan Transfer</label>
                    <div class="col-md-9">
                        <input name="TUJUAN_TRANSFER_FAKTUR" placeholder="Tujuan Faktur" class="form-control" type="text" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>