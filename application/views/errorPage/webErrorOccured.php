<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('components/head', ['pageName' => 'Register Success']); ?>
	<body class="hold-transition login-page">
		
		<div class="login-box">
			<!-- /.login-logo -->
			<img src='<?=base_url('assets/imgs/system-error.png')?>' class='d-block m-auto' 
                style='width:75%;' />
                
			<h2 class='text-center text-bold my-4'>Terjadi Kesalahan Sistem</h2>
            <p class="text-muted text-sm text-center mb-1">
                File <?=$throwable->getFile()?> on line <?=$throwable->getLine()?>
            </p>
            <p class="text-muted text-sm text-center">
                Message : <?=$throwable->getMessage()?>
            </p>
			<p class="mb-0 mt-2 text-white text-center text-sm">
				&copy;2021 TPI KUALANAMU, KANTOR IMIGRASI KELAS I KHUSUS TPI MEDAN
			</p>
		<!-- /.card -->
		</div>
		<!-- /.login-box -->
		<?php $this->load->view('components/global-js'); ?>
	</body>
</html>