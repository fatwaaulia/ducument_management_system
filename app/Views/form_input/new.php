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
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <div class="col-md-6 position-relative">
                                        <img src="<?= base_url('assets/uploads/default.png') ?>" class="w-100 cover-center" id="frame_gambar">
                                        <div class="position-absolute" style="bottom: 0px; right: 0px;">
                                            <button class="btn btn-secondary rounded-circle" style="padding: 8px 10px;" type="button" onclick="dom('#gambar').click()">
                                                <i class="fa-solid fa-camera fa-lg"></i>
                                            </button>
                                            <input type="file" class="form-control d-none" id="gambar" name="gambar" accept=".png,.jpg,.jpeg" onchange="dom('#frame_gambar').src = window.URL.createObjectURL(this.files[0]);">
                                        </div>
                                    </div>
                                    <div class="invalid-feedback" id="invalid_gambar"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
                                    <div class="invalid-feedback" id="invalid_nama"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" inputmode="numeric" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" oninput="this.value = dotsNumber(this.value)">
                                    </div>
                                    <div class="invalid-feedback" id="invalid_harga"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                    <div class="invalid-feedback" id="invalid_deskripsi"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                                    <input type="file" class="form-control" id="dokumen_pendukung" name="dokumen_pendukung" accept="application/pdf">
                                    <div class="form-text">
                                        Maksimal 2 mb, pdf
                                    </div>
                                    <div class="invalid-feedback" id="invalid_dokumen_pendukung"></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-2">
                                    <span class="fw-600">Waktu</span>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">
                                    <div class="invalid-feedback" id="invalid_tanggal_kegiatan"></div>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-600">Pilihan</span>
                                </div>
                                <div class="mb-3">
                                    <label for="select_multiple" class="form-label">Select Multiple</label>
                                    <select id="select_multiple" name="select_multiple[]" multiple>
                                        <option value="">Pilih</option>
                                        <?php
                                        $multiple = ['Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh'];
                                        foreach ($multiple as $v) :
                                        ?>
                                        <option value="<?= $v ?>"><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" id="invalid_select_multiple"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Checkbox</label>
                                    <?php
                                    $checkbox = ['checkbox 1', 'checkbox 2', 'checkbox 3'];
                                    foreach($checkbox as $v) :
                                    ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="<?= $v ?>" name="checkbox[]" value="<?= $v ?>">
                                        <label class="form-check-label" for="<?= $v ?>"><?= $v ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="invalid-feedback" id="invalid_checkbox"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Persetujuan</label>
                                    <?php
                                    $persetujuan = ['Iya', 'Tidak'];
                                    foreach($persetujuan as $v) :
                                    ?>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="<?= $v ?>" name="persetujuan" value="<?= $v ?>">
                                        <label class="form-check-label" for="<?= $v ?>"><?= $v ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="invalid-feedback" id="invalid_persetujuan"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 float-end">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
dselect(dom('#select_multiple'), { search: true });
</script>

<script>
dom('#form').addEventListener('submit', function(event) {
    event.preventDefault();
    const endpoint = '<?= $base_api ?>create';
    submitData(dom('#form'), endpoint);
});
</script>
