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
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">Pilih</option>
                                <?php
                                $kategori = model('Kategori')->findAll();
                                foreach ($kategori as $v) :
                                ?>
                                <option value="<?= $v['nama'] ?>"><?= $v['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="invalid_kategori"></div>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul">
                            <div class="invalid-feedback" id="invalid_judul"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan</label>
                            <textarea class="form-control" id="ringkasan" name="ringkasan" rows="3" placeholder="Masukkan ringkasan"></textarea>
                            <div class="invalid-feedback" id="invalid_ringkasan"></div>
                        </div>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Dokumen</label>
                            <input type="file" class="form-control" id="dokumen" name="dokumen" accept="application/pdf">
                            <div class="form-text">
                                Maksimal 2 mb, pdf
                            </div>
                            <div class="invalid-feedback" id="invalid_dokumen"></div>
                        </div>
                        <hr>
                        <div class="mb-2">
                            <span class="fw-600">Tanda Tangan Persetujuan</span>
                        </div>
                        <div class="mb-3">
                            <label for="user_tingkat_1" class="form-label">Tingkat 1</label>
                            <select class="form-select" id="user_tingkat_1" name="user_tingkat_1">
                                <option value="">Pilih</option>
                                <?php
                                $role = model('Role')->findAll();
                                $nama_role_by_id = array_column($role, 'nama', 'id');
                                $user_tingkat_1 = model('Users')->findAll();
                                foreach ($user_tingkat_1 as $v) :
                                ?>
                                <option value="<?= $v['id'] ?>"><?= $nama_role_by_id[$v['id_role']] ?> - <?= $v['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="invalid_user_tingkat_1"></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 float-end">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
dselect(dom('#kategori'), { search: true });
dselect(dom('#user_tingkat_1'), { search: true });

dom('#form').addEventListener('submit', function(event) {
    event.preventDefault();
    const endpoint = '<?= $base_api ?>create';
    submitData(dom('#form'), endpoint);
});
</script>
