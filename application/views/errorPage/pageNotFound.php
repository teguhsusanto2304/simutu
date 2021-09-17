<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view(adminComponents('head'), ['pageTitle' => 'Page Not Found']); ?>
	<body class="hold-transition login-page">
		
		<div class="login-box text-center">
			<!-- /.login-logo -->
			<img src='<?=base_url('assets/img/page-not-found.png')?>' class='d-block m-auto' 
                style='width:75%;' />
                
			<h2 class= text-bold my-4 text-danger'>Page Not Found</h2>
            <p class="text-muted text-sm">
                You are trying to access a page that isn't available in our system
            </p>
            <a href="<?=site_url(adminControllers())?>">
	            <button class="btn btn-secondary">Back to Home</button>
	        </a>
			<p class="mb-0 mt-5 text-muted text-sm">
				&copy;2021 Aplikasi Magang
			</p>
		<!-- /.card -->
		</div>
		<!-- /.login-box -->
		<?php $this->load->view(adminComponents('javascript')); ?>
	</body>
</html>