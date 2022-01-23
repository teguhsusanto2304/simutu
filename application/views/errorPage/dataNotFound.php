<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view(adminComponents('head'), ['pageTitle' => $dnf_pageTitle]); ?>
	<body class="hold-transition login-page">
		
		<div class="login-box text-center">
			<!-- /.login-logo -->
			<img src='<?=base_url('assets/img/empty.png')?>' class='d-block m-auto' 
                style='width:75%;' />
                
			<h2 class='text-bold my-4 text-danger'><?=$dnf_title?></h2>
            <p class="text-muted text-sm"><?=$dnf_subTitle?></p>
            <a href="<?=site_url(adminControllers())?>">
	            <button class="btn btn-secondary">Back to Home</button>
	        </a>
			<p class="mb-0 mt-5 text-muted text-sm">
				&copy;2021
			</p>
		<!-- /.card -->
		</div>
		<!-- /.login-box -->
		<?php $this->load->view(adminComponents('javascript')); ?>
	</body>
</html>