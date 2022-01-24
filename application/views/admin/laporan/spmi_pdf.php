<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$pageTitle?></title>
	</head>
	<body>
		<h4>Laporan SPMI</h4>
		<br />
		<table border='1' style='border-collapse: collapse;' width="100%">
			<thead>
				<tr>
					<th align='center'>No.</th>
					<th align='center'>Standart</th>
					<th align='center'>Sub Standart</th>
					<th align='center'>Pernyataan</th>
					<th align='center'>Indikator</th>
					<th align='center'>Indikator Dokumen</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(count($listStandart) >= 1){
						foreach($listStandart as $indexData => $standart){
							?>
								<tr>
									<td align='center'><b><?=$indexData+1?>.</b></td>
									<td align="left">
										<p style='margin: 0px;'><?=$standart['namaStandar']?></p>
										<span>Kode <?=$standart['kodeStandar']?></span>
									</td>
									<td align="left">
										<p style='margin: 0px;'><?=$standart['namaSubStandar']?></p>
										<span>Kode <?=$standart['kodeSubStandar']?></span>
									</td>
									<td align="left">
										<p style='margin: 0px;'><?=$standart['namaPernyataan']?></p>
										<?php if(!empty($standart['kodePernyataan'])){ ?>
											<span>Kode <?=$standart['kodePernyataan']?></span>
										<?php }else{ ?>
											-
										<?php } ?>
									</td>
									<td align="left">
										<p style='margin: 0px;'><?=$standart['namaIndikator']?></p>
										<?php if(!empty($standart['kodeIndikator'])){ ?>
											<span>Kode <?=$standart['kodeIndikator']?></span>
										<?php }else{ ?>
											-
										<?php } ?>
									</td>
									<td align="left">
										<?php if(!empty($standart['namaIndikatorDokumen'])){ ?>
											<p style='margin: 0px;'><?=$standart['namaIndikatorDokumen']?></p>
										<?php }else{ ?>
											-
										<?php } ?>
									</td>
								</tr>
							<?php
						}
					}
				?>
			</tbody>
		</table>
	</body>
</html>
<style type="text/css">
	tr > td{
		padding: 10px 10px;
	}
	tr > td > p {
		font-size: 14px;
	}
	tr > td > span {
		font-size:12.5px;
	}
</style>