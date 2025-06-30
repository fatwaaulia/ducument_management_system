<div class="section">
    <div class="section-header">
        <h1><?= isset($title) ? $title : '' ?></h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex">
            <div class="card flex-fill mb-0">
                <div class="card-body text-center" style="border-bottom:4px solid var(--main-color); border-radius:var(--border-radius)">
                    <p class="fw-500 d-block mb-2">
                        <i class="fa-solid fa-user-group me-1"></i>
                        Total Pengguna
                    </p>
                    <?php $total_pengguna = model('Users')->countAll() ?>
                    <h4 class="mb-0"><?= $total_pengguna ?></h4>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex">
            <div class="card flex-fill mb-0">
                <div class="card-body text-center" style="border-bottom:4px solid var(--main-color); border-radius:var(--border-radius)">
                    <p class="fw-500 d-block mb-2">
                        <i class="fa-solid fa-user-group me-1"></i>
                        Total Pengguna
                    </p>
                    <?php $total_pengguna = model('Users')->countAll() ?>
                    <h4 class="mb-0"><?= $total_pengguna ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>

<style>
#pdf_preview {
    height: 80vh;
    overflow-y: auto;
    overflow-x: hidden;
    border: 1px solid #ddd;
    padding: 10px;
    position: relative;
}
canvas {
    display: block;
    width: 100%;
    height: auto;
}
.signature-box {
    position: absolute;
    width: 150px;
    border: 2px solid #687FE5;
    cursor: move;
}
.btn-delete-signature-box {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    top: -11px;
    right: 10px;
    width: 20px;
    height: 20px;
}
</style>

<section class="container-fluid mt-3">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-8 col-xl-9">

            <div id="pdf_preview"></div>

            <script>
            const dokumen = '<?= base_url() ?>assets/penawaran.pdf';
            const container = document.getElementById('pdf_preview');

            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
            pdfjsLib.getDocument(dokumen).promise.then(pdf => {
            for (let i = 1; i <= pdf.numPages; i++) {
                pdf.getPage(i).then(page => {
                const scale = 2 * window.devicePixelRatio;
                const viewport = page.getViewport({ scale });
                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                canvas.style.margin = '10px auto';
                container.appendChild(canvas);
                page.render({ canvasContext: canvas.getContext('2d'), viewport });
                });
            }
            });

            function addSignature(image) {
                const signature_box = document.createElement('div');
                signature_box.className = 'signature-box';
                signature_box.style.left = (container.offsetWidth / 2 - 75) + 'px';
                signature_box.style.top = (container.scrollTop + 100) + 'px';
                signature_box.setAttribute('data-x', 0);
                signature_box.setAttribute('data-y', 0);

                signature_box.innerHTML = `
                <button class="btn-delete-signature-box btn btn-danger rounded-circle border-light" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark fa-sm"></i>
                </button>
                <img src="${image}" style="width:100%; height:auto; display:block; pointer-events:none; user-select:none;">`;

                container.appendChild(signature_box);

                interact(signature_box).draggable({
                    listeners: {
                    move(event) {
                        const x = (parseFloat(signature_box.getAttribute('data-x')) || 0) + event.dx;
                        const y = (parseFloat(signature_box.getAttribute('data-y')) || 0) + event.dy;
                        signature_box.style.transform = `translate(${x}px, ${y}px)`;
                        signature_box.setAttribute('data-x', x);
                        signature_box.setAttribute('data-y', y);
                    }
                    },
                    modifiers: [interact.modifiers.restrictRect({ restriction: container, endOnly: true })]
                }).resizable({
                    edges: { top: true, left: true, bottom: true, right: true },
                    preserveAspectRatio: true,
                    modifiers: [
                        interact.modifiers.restrictSize({
                            min: { width: container.offsetWidth * 0.12, height: container.offsetWidth * 0.12 },
                        }),
                    ],
                    }).on('resizemove', event => {
                        signature_box.style.width = event.rect.width + 'px';
                    });
                }

            async function unduhPdf() {
                const existing_pdf_bytes = await fetch(dokumen).then(r => r.arrayBuffer());
                const signature_url = '<?= base_url('assets/ttd.png') ?>';
                const { PDFDocument } = PDFLib;
                const pdf_doc = await PDFDocument.load(existing_pdf_bytes);
                const png_image_bytes = await fetch(signature_url).then(r => r.arrayBuffer());
                const png_image = await pdf_doc.embedPng(png_image_bytes);

                const pages = pdf_doc.getPages();
                const canvases = container.querySelectorAll('canvas');
                const all_signature_box = container.querySelectorAll('.signature-box');

                all_signature_box.forEach(signature => {
                    const style_top = parseFloat(signature.style.top) || 0;
                    const style_left = parseFloat(signature.style.left) || 0;
                    const dx = parseFloat(signature.getAttribute('data-x')) || 0;
                    const dy = parseFloat(signature.getAttribute('data-y')) || 0;

                    const absolute_top = style_top + dy;
                    const absolute_left = style_left + dx;

                    let page_index = -1;
                    for (let i = 0; i < canvases.length; i++) {
                        const canvas = canvases[i];
                        if (absolute_top >= canvas.offsetTop && absolute_top <= canvas.offsetTop + canvas.offsetHeight) {
                            page_index = i;
                            break;
                        }
                    }

                    if (page_index === -1) return;

                    const canvas = canvases[page_index];
                    const page = pages[page_index];
                    const page_width = page.getWidth();
                    const page_height = page.getHeight();

                    const scaleX = page_width / canvas.offsetWidth;
                    const scaleY = page_height / canvas.offsetHeight;

                    const relX = absolute_left - canvas.offsetLeft;
                    const relY = absolute_top - canvas.offsetTop;

                    const pdfX = relX * scaleX;
                    const pdfY = page_height - (relY + signature.offsetHeight) * scaleY;
                    const pdf_width = signature.offsetWidth * scaleX;
                    const pdf_height = signature.offsetHeight * scaleY;

                    page.drawImage(png_image, {
                        x: pdfX,
                        y: pdfY,
                        width: pdf_width,
                        height: pdf_height
                    });
                });

                const pdf_bytes = await pdf_doc.save();
                const blob = new Blob([pdf_bytes], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'dokumen-ttd.pdf';
                a.click();
                URL.revokeObjectURL(url);
            }
            </script>
        </div>

        <div class="col-12 col-md-4 col-lg-4 col-xl-3">
            <div class="d-flex justify-content-center align-items-center">
                <img src="<?= base_url('assets/ttd.png') ?>" style="height: 100px; cursor: pointer;" onclick="addSignature('<?= base_url('assets/ttd.png') ?>')">
            </div>
            <br>
            <button onclick="unduhPdf()">Unduh PDF</button>
        </div>
    </div>
</section>












<style>
#signature_pad {
    border: 1px solid #ccc;
    touch-action: none;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@5.0.10/dist/signature_pad.umd.min.js "></script>

<section class="container-fluid mt-4">
    <div class="row">
        <div class="col-12 col-xl-6">

            <button onclick="clearSignature()">Hapus</button>
            <button onclick="downloadSignature()">Unduh</button>
            <canvas id="signature_pad" class="w-100"></canvas>

            <script>
            const signature_pad = document.getElementById('signature_pad');

            function resizeSignaturePad() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const width = signature_pad.offsetWidth;
                const height = width / 2;

                signature_pad.width = width * ratio;
                signature_pad.height = height * ratio;
                signature_pad.style.height = height + 'px';

                const context = signature_pad.getContext("2d");
                context.setTransform(1, 0, 0, 1, 0, 0);
                context.scale(ratio, ratio);
            }
            resizeSignaturePad();

            const signature = new SignaturePad(signature_pad);

            function clearSignature() {
                signature.clear();
            }

            function downloadSignature() {
                if (signature.isEmpty()) return alert("Tanda tangan kosong");

                const target_width = 600;
                const target_height = 300;

                const export_signature_pad = document.createElement('canvas');
                export_signature_pad.width = target_width;
                export_signature_pad.height = target_height;

                const ctx = export_signature_pad.getContext('2d');
                ctx.drawImage(signature_pad, 0, 0, target_width, target_height);

                const dataURL = export_signature_pad.toDataURL('image/png');
                const a = document.createElement('a');
                a.href = dataURL;
                a.download = 'ttd.png';
                a.click();
            }
            </script>

        </div>
    </div>
</section>








<section class="container-fluid mt-4">
    <div class="row">
        <div class="col-12 col-xl-6">


    <div class="card p-2">
        <div class="p-5 d-flex justify-content-center align-items-center" id="file_dropzone" style="cursor: pointer; border: 2px solid #ddd">
            <p class="mb-0">Tekan atau tumpahkan file disini</p>
        </div>
    </div>
    <input type="file" class="p-5 m-5" id="upload_file">

    
    <script>
    const file_dropzone = dom('#file_dropzone');
    const upload_file = dom('#upload_file');
    const asdqwe = dom('#asdqwe');

    // menangani upload file
    file_dropzone.addEventListener('click', () => {
        upload_file.click();
    });

    upload_file.addEventListener('change', () => {
        const file = upload_file.files[0];
        dom('#file_dropzone p').textContent = file.name;
    });

    // menangani drag & drop file
    file_dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        file_dropzone.style.backgroundColor = 'lightblue';
    });

    file_dropzone.addEventListener('dragleave', () => {
        file_dropzone.style.backgroundColor = '';
    });

    file_dropzone.addEventListener('drop', e => {
        e.preventDefault();
        upload_file.value = '';
        file_dropzone.style.backgroundColor = ''; 
        const file = e.dataTransfer.files[0];
        dom('#file_dropzone p').textContent = file.name;
    });
    </script>



        </div>
    </div>
</section>