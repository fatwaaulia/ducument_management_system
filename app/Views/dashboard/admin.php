<style>
/*--------------------------------------------------------------
  # Animasi Ombak Dashboard
--------------------------------------------------------------*/
.waves {
    position:relative;
    width: 100%;
    height:15vh;
    margin-bottom:-7px;
    min-height:100px;
    max-height:150px;
    border-bottom-left-radius: var(--border-radius);
    border-bottom-right-radius: var(--border-radius);
}
.parallax > use {
    animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
}
.parallax > use:nth-child(1) {
    animation-delay: -2s;
    animation-duration: 7s;
}
.parallax > use:nth-child(2) {
    animation-delay: -3s;
    animation-duration: 10s;
}
.parallax > use:nth-child(3) {
    animation-delay: -4s;
    animation-duration: 13s;
}
.parallax > use:nth-child(4) {
    animation-delay: -5s;
    animation-duration: 20s;
}
@keyframes move-forever {
    0% { transform: translate3d(-90px,0,0); }
    100% { transform: translate3d(85px,0,0); }
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4" style="background: linear-gradient(60deg, rgb(57 32 150) 0%, #2196F3 100%);">
                <div class="card-body text-white">
                    <h3 class="fw-600">Selamat datang <?= implode(' ', array_slice(explode(' ', userSession('nama')), 0, 3)); ?>!</h3>
                    <p>Akses cepat dan pengelolaan informasi secara efisien.</p>
                </div>
                <div>
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(255,255,255,0.7)" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>