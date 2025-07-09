<link rel="stylesheet" href="<?= base_url() ?>assets/modules/dselect/dselect.min.css">
<script src="<?= base_url() ?>assets/modules/dselect/dselect.min.js"></script>

<div class="section">
    <div class="section-header">
        <h1><?= isset($title) ? $title : '' ?></h1>
    </div>
</div>

<section class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" value="<?= $data['kategori'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" value="<?= $data['judul'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan</label>
                            <textarea class="form-control" id="ringkasan" rows="3" disabled><?= $data['ringkasan'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Dokumen</label> <br>
                            <a href="<?= webFile($base_name, $data['dokumen'], $data['updated_at']) ?>" target="_blank">Lihat Dokumen</a>
                        </div>
                        <hr>
                        <div class="mb-2">
                            <span class="fw-600">Tanda Tangan Persetujuan</span>
                        </div>
                        <div class="mb-3">
                            <?php
                            $role = model('Role')->findAll();
                            $nama_role_by_id = array_column($role, 'nama', 'id');
                            ?>
                            <label for="user_tingkat_1" class="form-label">Tingkat 1</label>
                            <input type="text" class="form-control" id="user_tingkat_1" value="<?= $nama_role_by_id[$data['id_user_tingkat_1']] ?>" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
