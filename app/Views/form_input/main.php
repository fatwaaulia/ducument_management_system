<?php
$get_tanggal_awal = $_GET['tanggal_awal'] ?? '';
$get_tanggal_akhir = $_GET['tanggal_akhir'] ?? '';
?>

<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/css/dataTables.dataTables.min.css">

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
                    <div class="col-12 col-lg-10 col-xl-11">
                        <form action="" method="get">
                            <div class="row gx-2 gy-3">
                                <div class="col-6 col-md-5 col-lg-4 col-xl-3">
                                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $get_tanggal_awal ?>">
                                </div>
                                <div class="col-6 col-md-5 col-lg-4 col-xl-3">
                                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $get_tanggal_akhir ?>">
                                </div>
                                <div class="col-12 col-md-2 col-lg-2 col-xl-2 d-flex justify-content-start align-items-end">
                                    <button type="submit" class="btn btn-primary me-2 w-100" title="Filter">
                                        <i class="fa-solid fa-filter"></i>
                                        <span class="ms-1 d-md-none">Filter</span>
                                    </button>
                                    <a href="<?= $base_route ?>" class="btn btn-outline-danger w-100" title="Reset">
                                        <i class="fa-solid fa-filter-circle-xmark"></i>
                                        <span class="ms-1 d-md-none">Reset</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-lg-2 col-xl-1 d-flex justify-content-end align-items-end">
                        <a href="<?= $base_route ?>new" class="btn btn-primary">
                            <i class="fa-solid fa-plus fa-sm"></i> New
                        </a>
                    </div>
                </div>
                <table class="display nowrap" id="myTable">
                    <thead class="bg-primary-subtle">
                        <tr>
                            <th>No.</th>
                            <th>
                                <input class="form-check-input fa-lg" type="checkbox" id="checked_all" style="cursor:pointer;">
                            </th>
                            <th>Kode</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Dokumen Pendukung</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Select Multiple</th>
                            <th>Checkbox</th>
                            <th>Persetujuan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                </table>
                <div class="row mt-3">
                    <div class="col-12">
                        <button class="btn btn-primary" onclick="submitCheckedBox()">
                            Get ID Checkbox
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Checked
document.addEventListener('DOMContentLoaded', () => boxCheckedAll());
async function boxCheckedAll() {
    const session_checked_id = JSON.parse(sessionStorage.getItem('checked_id')) || [];
    const { data } = await (await fetch('<?= $base_api ?>')).json();

    if (session_checked_id.length == data.length) {
        dom('#checked_all').checked = true;
    } else {
        dom('#checked_all').checked = false;
    }
}

function itemChacked(el) {
    let session_checked_id = JSON.parse(sessionStorage.getItem('checked_id')) || [];
    
    if (el.checked) {
        if (!session_checked_id.includes(el.value)) session_checked_id.push(el.value);
    } else {
        session_checked_id = session_checked_id.filter(id => id !== el.value);
    }
    
    sessionStorage.setItem('checked_id', JSON.stringify(session_checked_id));
    boxCheckedAll();
}

function submitCheckedBox() {
    const session_checked_id = JSON.parse(sessionStorage.getItem('checked_id')) || [];
    console.log(session_checked_id);

    // Lakukan Proses Backend Disini
}
// End | Checked

document.addEventListener('DOMContentLoaded', function() {
    const table = new DataTable('#myTable', {
        ajax: '<?= $get_data ?>',
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
                render: data => {
                    const session_checked_id = JSON.parse(sessionStorage.getItem('checked_id')) || [];
                    const is_checked = session_checked_id.includes(String(data.id)) ? 'checked' : '';
                    return `<input type="checkbox" class="form-check-input fa-lg" value="${data.id}" ${is_checked} onchange="itemChacked(this)" style="cursor:pointer;">`;
                }
            }, {
                name: 'kode',
                data: 'kode',
            }, {
                name: '',
                data: null,
                render: data => `<img src="${data.gambar}" class="wh-40 cover-center" loading="lazy">`,
            }, {
                name: 'nama',
                data: 'nama',
            }, {
                name: 'harga',
                data: 'harga',
            }, {
                name: '',
                data: null,
                render: renderDokumenPendukung,
            }, {
                name: '',
                data: 'tanggal_kegiatan',
            }, {
                name: '',
                data: 'select_multiple',
            }, {
                name: '',
                data: 'checkbox',
            }, {
                name: 'persetujuan',
                data: 'persetujuan',
            }, {
                name: '',
                data: null,
                render: renderOpsi,
            },
        ].map(col => ({ ...col, orderable: col.name !== '' })),
    });

    // Checked All
    dom('#checked_all').addEventListener('click', async function () {
        try {
            const rows = table.rows({ search: 'applied' }).nodes();
            Array.from(rows).forEach(row => {
                const box = row.querySelector('input[type="checkbox"]');
                box.checked = this.checked;
            });

            if (this.checked) {
                const { data } = await (await fetch('<?= $base_api ?>')).json();
                const session_checked_id = data.map(item => item.id);

                sessionStorage.setItem('checked_id', JSON.stringify(session_checked_id));
            } else {
                sessionStorage.removeItem('checked_id');
            }
        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Oops! Terjadi kesalahan',
                text: 'Silakan coba lagi nanti.',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        }
    });
    // End | Checked All

    // Klik 2x untuk edit data
    dom('#myTable').addEventListener('dblclick', function(e) {
        const cell = e.target;
        if (cell.tagName !== 'TD') return;

        const editableColumns = [4];

        if (editableColumns.includes(cell.cellIndex)) {
            const input = document.createElement('input');
            input.type = 'text';
            input.value = cell.innerText;
            input.className = 'form-control';

            cell.innerHTML = '';
            cell.appendChild(input);
            input.focus();

            let is_updated = false;
            input.onblur = input.onkeydown = function(e) {
                const id = table.row(cell.parentNode).data().id;

                if (! is_updated) {
                    if (e.type === 'blur' || e.key === 'Enter') {
                        update(id);
                        is_updated = true;
                    }
                }
            };

            async function update(id) {
                is_updated = false;
                try {
                    const [detail_response, csrf_response] = await Promise.all([
                        fetch(`<?= $base_api ?>detail/${id}`),
                        fetch('/api/csrf')
                    ]);
                    const detail = (await detail_response.json()).data;
                    const { csrf_token } = await csrf_response.json();

                    const column = table.settings()[0].oInit.columns[cell.cellIndex].data;
                    let get_old_value = detail[column];
                    let get_new_value = input.value;

                    if (get_old_value == get_new_value) {
                        cell.innerText = get_old_value;
                        return;
                    } else {
                        cell.innerHTML = `<div class="loading-ellipsis"> <div></div> <div></div> <div></div> <div></div> </div>`;
                    }

                    detail[column] = get_new_value;
                    detail['gambar'] = '';
                    detail['dokumen_pendukung'] = '';

                    const endpoint = `<?= $base_api ?>update/${id}`;
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf_token,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(detail),
                    });

                    const data = await response.json();

                    if (['success', 'error'].includes(data.status)) {
                        cell.innerText = (data.status == 'success') ? get_new_value : get_old_value;
                        if (data.status != 'success') detail[column] = get_old_value;

                        await Swal.fire({
                            icon: data.status,
                            title: (data.status == 'success') ? data.message :  data.errors[Object.keys(data.errors)[0]],
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Oops! Terjadi kesalahan',
                        text: 'Silakan coba lagi nanti.',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                    });
                }
            }
        }
    });
    // END | Klik 2x untuk edit data
});

function renderDokumenPendukung(data) {
    if (! data.dokumen_pendukung) return '';
    return `<a href="${data.dokumen_pendukung}" target="_blank">Lihat Dokumen</a>`;
}

function renderOpsi(data) {
    let endpoint_detail_data = `<?= $base_api ?>detail/${data.id}`;
    let endpoint_edit_data = `<?= $base_route ?>edit/${data.id}`;
    let endpoint_hapus_data = `<?= $base_api ?>delete/${data.id}`;
    return `
    <a href="${endpoint_detail_data}" class="me-2" title="Detail">
        <i class="fa-regular fa-eye fa-lg text-info"></i>
    </a>
    <a href="${endpoint_edit_data}" class="me-2" title="Edit">
        <i class="fa-regular fa-pen-to-square fa-lg"></i>
    </a>
    <a onclick="deleteData('${endpoint_hapus_data}')" title="Delete">
        <i class="fa-regular fa-trash-can fa-lg text-danger"></i>
    </a>`;
}
</script>

<script src="<?= base_url() ?>assets/modules/datatables/js/dataTables.min.js"></script>

<!--------------------------------------------------------------
# Faker
--------------------------------------------------------------->
<?php
// $faker = \Faker\Factory::create('id_ID');
// $data = [
//     'image'   => 'https://unsplash.it/400/200?random=' . rand(),
//     'name'    => $faker->name,
//     'random'  => str_replace('.', '', $faker->sentence(mt_rand(2, 5))),
//     'tanggal' => date('Y-m-d', rand(strtotime('2024-12-15'), strtotime('2025-05-15'))),
// ];

// print_r($data);
?>