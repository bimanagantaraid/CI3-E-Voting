<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $titlepage ?></h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="form-group">
                            <label>Filter Tanggal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="filterdate" name="filterdate">
                            </div>
                            <button class="btn btn-sm btn-danger mt-2" id="btn-reset-filter"><i class="fas fa-filter text-light mr-1"></i><span>reset filter</span></button>
                        </div>
                        <div class="actionSelect form-group">
                            <select class="form-control" id="exportLink">
                                <option>Export Data</option>
                                <option id="csv">Export as CSV</option>
                                <option id="excel">Export as XLS</option>
                                <option id="pdf">Export as PDF</option>
                                <option id="print">Print Data</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover" id="rekapitulasi">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Nomor paslon dipilih</th>
                                <th>Nama paslon dipilih</th>
                                <th>Tanggal Pilih</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var tables;
    $(document).ready(() => {
        tables = $('#rekapitulasi').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            initComplete: function() {
                var $buttons = $('.dt-buttons').hide();
                $('#exportLink').on('change', function() {
                    var btnClass = $(this).find(":selected")[0].id ?
                        '.buttons-' + $(this).find(":selected")[0].id :
                        null;
                    if (btnClass) $buttons.find(btnClass).click();
                })
            },
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '<?= base_url() ?>' + 'voting/getSuaraJson',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    filterDate: function(d) {
                        var dt_params = $('#rekapitulasi').data('dt_params');
                        if (dt_params) {
                            $.extend(d, dt_params);
                            return dt_params.filterDate;
                        }
                    }
                },
            }
        });
        $('#filterdate').daterangepicker();
        $('.applyBtn').click(() => {
            var dateValue = $('.drp-selected')[0].innerText;
            $('#rekapitulasi').data('dt_params', {
                filterDate: filteredbydate(dateValue)
            });
            tables.draw();
        })
        $('#btn-reset-filter').click(() => {
            $('#rekapitulasi').data('dt_params', {
                filterDate: null
            });
            tables.draw();
        })
    })

    function filteredbydate(dateValue) {
        if (dateValue != undefined) {
            var split = dateValue.split('-');
            var tanggalAwal = formatdate(split[0]);
            var tanggalAkhir = formatdate(split[1]);
            var date = [tanggalAwal, tanggalAkhir];
            return date;
        } else {
            return null;
        }
        return date;
    }

    function formatdate(date) {
        var mentah = date.split('/');
        var dateReady = mentah[2] + '/' + mentah[0] + '/' + mentah[1];
        return dateReady.replace(/\s/g, '');
    }
</script>