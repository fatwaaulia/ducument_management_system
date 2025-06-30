<style>
body { overflow: hidden; }
</style>

<section class="container">
	<div class="row justify-content-center align-items-center vh-100">
		<div class="col-xl-4 col-lg-4 col-md-6 col-12">
			<div class="card my-4 pt-3 pb-1">
				<div class="card-body">
					<div class="text-center">
						<h3 class="mb-1 fw-600">Reset Password</h3>
						<p><?= $user['email'] ?></p>
					</div>
					<hr>
					<form id="form">
                        <?= csrf_field() ?>
						<div class="mb-3">
							<label for="password" class="form-label">Password Baru</label>
							<div class="mb-2 position-relative">
								<input type="password" class="form-control" name="password" id="password" value="<?= old('password') ?>" placeholder="password baru">
								<div class="invalid-feedback" id="invalid_password"></div>
								<img src="<?= base_url('assets/icons/show.png') ?>" class="position-absolute" id="eye_password">
							</div>
							<div class="position-relative">
								<input type="password" class="form-control" name="passconf" id="passconf" value="<?= old('passconf') ?>" placeholder="confirm password">
								<div class="invalid-feedback" id="invalid_passconf"></div>
								<img src="<?= base_url('assets/icons/show.png') ?>" class="position-absolute" id="eye_passconf">
							</div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Simpan</button>
					</form>
					<div class="text-center mt-3">
						<a href="<?= base_url('login') ?>">
							<i class="fa-solid fa-angle-left me-1"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
function toggleVisibility(inputElement, eyeElement) {
    const showIcon = "<?= base_url('assets/icons/show.png') ?>";
    const hideIcon = "<?= base_url('assets/icons/hide.png') ?>";
    inputElement.type = inputElement.type === 'password' ? 'text' : 'password';
    eyeElement.src = inputElement.type === 'password' ? showIcon : hideIcon;
}

const password = dom('#password');
dom('#eye_password').addEventListener('click', () => {
    toggleVisibility(dom('#eye_password'), dom('#eye_password'));
});

dom('#eye_passconf').addEventListener('click', () => {
    toggleVisibility(dom('#passconf'), dom('#eye_passconf'));
});
</script>

<script>
dom('#form').addEventListener('submit', function(event) {
    event.preventDefault();
	const endpoint = '<?= base_url() ?>api/password/reset/<?= $user['token'] ?>';
    submitData(dom('#form'), endpoint);
});
</script>
