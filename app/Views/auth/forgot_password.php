<style>
body { overflow: hidden; }
</style>

<section class="container">
	<div class="row justify-content-center align-items-center vh-100">
		<div class="col-xl-4 col-lg-4 col-md-6 col-12">
			<div class="card my-4 pt-3 pb-1">
				<div class="card-body">
					<div class="text-center">
						<h3 class="mb-1 fw-600">Lupa Password?</h3>
						<p>masukkan email Anda yang terdaftar.</p>
					</div>
					<hr>
					<form id="form">
                        <?= csrf_field() ?>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" autofocus autocomplete="off">
							<div class="invalid-feedback" id="invalid_email"></div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Kirim</button>
					</form>
					<div class="text-center mt-3">
						<a href="<?= base_url('login') ?>">
							<i class="fa-solid fa-angle-left"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
dom('#form').addEventListener('submit', function(event) {
    event.preventDefault();
	const endpoint = '<?= base_url() ?>api/password/forgot';
    submitData(dom('#form'), endpoint);
});
</script>
