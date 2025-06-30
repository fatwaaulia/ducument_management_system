<style>
body { overflow: hidden; }
</style>

<section class="container">
	<div class="row justify-content-center align-items-center vh-100">
		<div class="col-xxl-4 col-lg-4 col-md-6 col-12">
			<div class="card my-4 pt-3 pb-1">
				<div class="card-body">
					<div class="text-center">
						<h3 class="mb-1 fw-600 linear-color-blue">Login</h3>
						<p>Silakan masuk ke akun Anda.</p>
					</div>
					<hr>
					<form id="form">
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="username" class="form-control" id="username" name="username" placeholder="name@gmail.com" autofocus autocomplete="off">
							<div class="invalid-feedback" id="invalid_username"></div>
						</div>
						<div class="mb-3">
							<div class="d-flex justify-content-between">
								<label class="form-label" for="password">Password</label>
								<a href="<?= base_url('password/forgot') ?>">
									<small>Lupa Password?</small>
								</a>
							</div>
							<div class="position-relative">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
								<div class="invalid-feedback" id="invalid_password"></div>
								<img src="<?= base_url('assets/icons/show.png') ?>" class="position-absolute" id="eye_password">
							</div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Masuk</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
function toggleVisibility(inputElement, eyeElement) {
	const showIcon = "<?= base_url('assets/icons/show.png') ?>";
    const hideIcon = "<?= base_url('assets/icons/hide.png') ?>";
    inputElement.type = password.type === 'password' ? 'text' : 'password';
    eyeElement.src = password.type === 'password' ? showIcon : hideIcon;
}

dom('#eye_password').addEventListener('click', () => {
    toggleVisibility(dom('#password'), dom('#eye_password'));
});

sessionStorage.removeItem("sidebarScrollPosition");
</script>

<script>
dom('#form').addEventListener('submit', function(event) {
    event.preventDefault();
	const endpoint = '<?= base_url() ?>api/login';
    submitData(dom('#form'), endpoint);
});
</script>
