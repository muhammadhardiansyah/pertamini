<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA CUTI</h3>
                    </div>

                    <div class="box-body">
                        <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('cuti/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-success btn-sm"'); ?></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Id Karyawan</th>
                    <th>Nama</th>
                    <th>Tanggal1</th>
                    <th>Tanggal2</th>
                    <th>Jenis</th>
                    <th>Validasi</th>
                    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $(' #mytable_filter input') .off('.DT') .on('keyup.DT', function(e) { 
                            if (e.keyCode==13) { api.search(this.value).draw(); } }); }, 
                            oLanguage: { sProcessing: "loading..." }, 
                            processing: true, 
                            serverSide: true, 
                            ajax: {"url": "cuti/json" , "type" : "POST" }, 
                            columns: [ { "data" : "id_cuti" , "orderable" : false },
                            {"data": "id_karyawan" },
                            {"data": "nama" },
                            {"data": "tanggal1" },
                            {"data": "tanggal2" },
                            {"data": "jenis" },
                            {"data": "validasi", "orderable" : false, "className" : "text-center",
                            render: function(data, type) {
                                if (data == 0){
                                    return '<button class="btn btn-danger">Ditolak</button>';
                                    
                                } else if (data == 1){
                                    return '<button class="btn btn-info">Disetujui</button>';
                                } else {
                                    return '<button class="btn btn-warning">Belum disetujui</button>';
                                }
                            } }, 
                            { "data" : "action" , "orderable" : false, "className" : "text-center" } ], 
                            order: [[0, 'desc' ]], 
                            rowCallback: function(row, data, iDisplayIndex) 
                            { 
                                var info=this.fnPagingInfo(); var page=info.iPage; var length=info.iLength; var index=page * length + (iDisplayIndex + 1); $('td:eq(0)', row).html(index); 
                                } }); }); 
        </script>
                            
        <script type="text/javascript">
            
            $("#mytable").ready(function(){
                var row = $(this).closest("tr");
                var nilai = row.find("td:eq(-2)").text();
                if (nilai == 1 | nilai == 0){
                    $('.btn-danger').prop('disabled', true);
                } else {
                    $('.btn-primary').removeAttr('disabled');
                }
            });



        </script>
        