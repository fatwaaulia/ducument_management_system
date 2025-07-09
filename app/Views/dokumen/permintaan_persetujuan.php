<?php
$get_kategori = $_GET['kategori'] ?? '';
?>

<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/css/dataTables.dataTables.min.css">
<script src="<?= base_url() ?>assets/modules/dselect/dselect.min.js"></script>

<div class="section">
    <div class="section-header">
        <h1><?= isset($title) ? $title : '' ?></h1>
    </div>
</div>

<section class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card p-3">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                        <select class="form-select" id="kategori" onchange="location = this.value;">
                            <option value="<?= current_url() ?>">Semua Kategori</option>
                            <?php
                            $kategori = model('Kategori')->findAll();
                            foreach ($kategori as $v) :
                                $selected = ($get_kategori == $v['nama']) ? 'selected' : '';
                            ?>
                            <option value="<?= current_url() ?>?kategori=<?= $v['nama'] ?>" <?= $selected ?>><?= $v['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-7 col-lg-8 col-xl-9 d-flex justify-content-end align-items-end">
                        <a href="<?= $base_route ?>new" class="btn btn-primary">
                            <i class="fa-solid fa-plus fa-sm"></i> New
                        </a>
                    </div>
                </div>
                <table class="display nowrap" id="myTable">
                    <thead class="bg-primary-subtle">
                        <tr>
                            <th>No.</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Dokumen</th>
                            <th>Created By</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
dselect(dom('#kategori'), { search: true });

document.addEventListener('DOMContentLoaded', function() {
    new DataTable('#myTable', {
        ajax: '<?= $get_data?>',
        processing: true,
        serverSide: true,
        order: [],
        initComplete: function (settings, json) {
            $('#myTable').wrap('<div style="overflow: auto; width: 100%; position: relative;"></div>');
        },
        columns: [
            {
                name: '',
                data: 'no_urut',
            }, {
                name: '',
                data: null,
                render: data => `<a href="">${data.status_tingkat_1}</a>`
            }, {
                name: '',
                data: 'kategori',
            }, {
                name: 'judul',
                data: 'judul',
            }, {
                name: '',
                data: null,
                render: data => data.dokumen ? `<a href="${data.dokumen}" target="_blank">Lihat Dokumen</a>` : ''
            }, {
                name: '',
                data: 'created_by',
            }, {
                name: '',
                data: 'created_at',
            },
        ].map(col => ({ ...col, orderable: col.name !== '' })),
    });
});
</script>

<script src="<?= base_url() ?>assets/modules/datatables/js/dataTables.min.js"></script>
