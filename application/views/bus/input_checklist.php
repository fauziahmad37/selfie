		<!-- page content -->
	<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <div class="right_col" role="main">
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                  <h2>Checklist Armada Eagle High </h2>

                  <div class="clearfix"></div>
                </div>
				<div id="ajax-modal-car" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"></div>
                <div class="x_content">
					<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Bus/input_checklist'); ?>" method="post">
						<div class="col-md-6 col-sm-6 col-xs-12">
							
							<table style="width:100%">
								<div id="print_header">
									<tr>
										<td style="padding:0px !important">No Polisi</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important">
											<input type="hidden" class="form-control col-md-7 col-xs-12" id="id" name="id" readonly value="<?php echo $header['id'];?>">
											<input type="text" class="form-control col-md-7 col-xs-12" id="police_number" readonly value="<?php echo $header['police_number'];?>">
										</td>
									</tr>
									<tr>
										<td style="padding:0px !important">No Body</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important"><input type="text" class="form-control col-md-7 col-xs-12" id="body_number" readonly value="<?php echo $header['body_number'];?>"></td>
									</tr>
									<tr>
										<td style="padding:0px !important">Nama Driver</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important"><input type="text" class="form-control col-md-7 col-xs-12" id="driver_name" readonly value="<?php echo $header['driver_name'];?>"></td>
									</tr>
									<tr>
										<td style="padding:0px !important">Tanggal</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important"><input type="text" class="form-control col-md-7 col-xs-12" id="date" readonly value="<?php echo $header['date'];?>"></td>
									</tr>
									<tr>
										<td style="padding:0px !important">Waktu Keluar</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important"><input type="text" class="form-control col-md-7 col-xs-12" id="out_dt" readonly value="<?php echo $header['out_dt'];?>"></td>
									</tr>
									<tr>
										<td style="padding:0px !important">Status</td>
										<td style="padding:0px !important">:</td>
										<td style="padding:0px !important"><input type="text" class="form-control col-md-7 col-xs-12" name="status" readonly value="<?php echo $header['status'];?>"></td>
									</tr>
									
								</div>
								
							<?php if($proses !== null){
							echo '
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_out">Waktu Masuk <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-9">
										<div class="input-group date" id="datetimepicker3">
											<input class="form-control inputdate" size="auto" type="text" id="in_dt" name="in_dt">
											<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>			
										</div>
									</div>
								</div>
							';
							}
							?>
								
								
							</table>
							<br/>
							<div class="clearfix"></div>
						</div>
						
						
						
						  
						<!-- INTERIOR -->		
					

						<div class="x_panel tile">
							<div class="x_title">
							  <h2>INTERIOR</h2>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>Kerapihan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan1' value=1>
												<label><input type="radio" name="jawaban1" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban1" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban1" value='3'>Hilang</label>
											</div>											
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan1" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Microphone (MIC) </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan2' value=2>
												<label><input type="radio" name="jawaban2" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban2" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban2" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan2" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Wifi Modem </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan3' value=3>
												<label><input type="radio" name="jawaban3" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban3" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban3" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan3" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Radio Tape </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan4' value=4>
												<label><input type="radio" name="jawaban4" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban4" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban4" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan4" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>DVD Player </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan5' value=5>
												<label><input type="radio" name="jawaban5" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban5" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban5" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan5" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Amplifier </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan6' value=6>
												<label><input type="radio" name="jawaban6" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban6" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban6" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan6" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Television (TV) Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan7' value=7>
												<label><input type="radio" name="jawaban7" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban7" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban7" value='3'>Hilang</label>
											</div>
											<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan7" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
										</td>
									</tr>
									<tr>
										<td>Television (TV) Belakang </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan8' value=8>
												<label><input type="radio" name="jawaban8" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban8" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban8" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan8" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Air Conditioner (AC) </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan9' value=9>
												<label><input type="radio" name="jawaban9" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban9" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban9" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan9" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kotak P3K </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan10' value=10>
												<label><input type="radio" name="jawaban10" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban10" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban10" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan10" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Apar </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan11' value=11>
												<label><input type="radio" name="jawaban11" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban11" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban11" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan11" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Payung </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan12' value=12>
												<label><input type="radio" name="jawaban12" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban12" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban12" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan12" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Pewangi </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan13' value=13>
												<label><input type="radio" name="jawaban13" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban13" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban13" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan13" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Pewangi Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan14' value=14>
												<label><input type="radio" name="jawaban14" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban14" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban14" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan14" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Pewangi Belakang </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan15' value=15>
												<label><input type="radio" name="jawaban15" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban15" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban15" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan15" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Palu Pemecah </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan16' value=16>
												<label><input type="radio" name="jawaban16" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban16" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban16" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan16" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Sarung Jok </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan17' value=17>
												<label><input type="radio" name="jawaban17" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban17" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban17" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan17" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Seat Belt </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan18' value=48>
												<label><input type="radio" name="jawaban18" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban18" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban18" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan18" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Lampu Indor </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan19' value=49>
												<label><input type="radio" name="jawaban19" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban19" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban19" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan19" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Bersih / Tidak Bersih </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan20' value=50>
												<label><input type="radio" name="jawaban20" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban20" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban20" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan20" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									</table>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table class="table borderless" style="width:100%">
									</table>
								</div>
							</div>
						</div>
						  
						
						<!-- EXTERIOR -->
						
						<div class="x_panel tile">
							<div class="x_title">
							  <h2>EXTERIOR</h2>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>Kodisi Ban dan Velg </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan21' value=18>
												<label><input type="radio" name="jawaban21" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban21" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban21" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan21" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ban Cadangan (Stip) </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan22' value=19>
												<label><input type="radio" name="jawaban22" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban22" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban22" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan22" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Spion Kanan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan23' value=20>
												<label><input type="radio" name="jawaban23" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban23" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban23" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan23" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Spion Kiri </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan24' value=21>
												<label><input type="radio" name="jawaban24" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban24" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban24" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan24" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kaca Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan25' value=22>
												<label><input type="radio" name="jawaban25" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban25" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban25" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan25" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kaca Belakang </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan26' value=23>
												<label><input type="radio" name="jawaban26" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban26" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban26" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan26" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kaca Samping Kanan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan27' value=24>
												<label><input type="radio" name="jawaban27" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban27" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban27" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan27" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kaca Samping Kiri </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan28' value=25>
												<label><input type="radio" name="jawaban28" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban28" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban28" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan28" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Pintu Darurat </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan29' value=26>
												<label><input type="radio" name="jawaban29" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban29" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban29" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan29" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker Eagle Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan30' value=27>
												<label><input type="radio" name="jawaban30" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban30" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban30" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan30" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker Eagle High Kiri </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan31' value=28>
												<label><input type="radio" name="jawaban31" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban31" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban31" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan31" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker Eagle High Kanan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan32' value=29>
												<label><input type="radio" name="jawaban32" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban32" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban32" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan32" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker Pariwisata 4 Titik </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan33' value=30>
												<label><input type="radio" name="jawaban33" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban33" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban33" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan33" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker Website </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan34' value=31>
												<label><input type="radio" name="jawaban34" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban34" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban34" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan34" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker No. Unit Pintu Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan35' value=32>
												<label><input type="radio" name="jawaban35" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban35" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban35" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan35" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Stiker No. Unit Belakang </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan36' value=33>
												<label><input type="radio" name="jawaban36" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban36" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban36" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan36" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ban Depan Kanan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan37' value=51>
												<label><input type="radio" name="jawaban37" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban37" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban37" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan37" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ban Depan Kiri </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan38' value=52>
												<label><input type="radio" name="jawaban38" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban38" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban38" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan38" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ban Belakang Kanan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan39' value=53>
												<label><input type="radio" name="jawaban39" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban39" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban39" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan39" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ban Belakang Kiri </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan40' value=54>
												<label><input type="radio" name="jawaban40" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban40" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban40" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan40" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Bumper Depan </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan41' value=55>
												<label><input type="radio" name="jawaban41" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban41" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban41" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan41" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Bumper Belakang </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan42' value=56>
												<label><input type="radio" name="jawaban42" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban42" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban42" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan42" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									</table>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table class="table borderless" style="width:100%">
									</table>
								</div>
							</div>
						</div>
							
						<!-- Lain - Lain -->
							
						<div class="x_panel tile">
							<div class="x_title">
							  <h2>Lain - lain </h2>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>Dongkrak </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan43' value=34>
												<label><input type="radio" name="jawaban43" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban43" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban43" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan43" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Engkol Dongkrak </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan44' value=35>
												<label><input type="radio" name="jawaban44" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban44" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban44" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan44" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Ada E-Toll </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan45' value=36>
												<label><input type="radio" name="jawaban45" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban45" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban45" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan45" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Senter </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan46' value=37>
												<label><input type="radio" name="jawaban46" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban46" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban46" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan46" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Segitiga </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan47' value=38>
												<label><input type="radio" name="jawaban47" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban47" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban47" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan47" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Kunci Roda </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan48' value=39>
												<label><input type="radio" name="jawaban48" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban48" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban48" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan48" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Tool Kits </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan49' value=40>
												<label><input type="radio" name="jawaban49" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban49" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban49" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan49" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Tempat Sampah </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan50' value=41>
												<label><input type="radio" name="jawaban50" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban50" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban50" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan50" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									</table>
								</div>
							</div>
						</div>
						
						
						
						<!-- Lain - Lain -->
							
						<div class="x_panel tile">
							<div class="x_title">
							  <h2>Kebersihan </h2>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>Interior </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan51' value=45>
												<label><input type="radio" name="jawaban51" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban51" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban51" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan51" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Eksterior </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan52' value=46>
												<label><input type="radio" name="jawaban52" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban52" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban52" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan52" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Tidak Bau </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan53' value=47>
												<label><input type="radio" name="jawaban53" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban53" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban53" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan53" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									
									
									
									</table>
								</div>
							</div>
						</div>
						
						<!-- CREW -->
							
						<div class="x_panel tile">
							<div class="x_title">
							  <h2>Crew </h2>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>Seragam </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan54' value=42>
												<label><input type="radio" name="jawaban54" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban54" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban54" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan54" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Sepatu </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan55' value=43>
												<label><input type="radio" name="jawaban55" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban55" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban55" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan55" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Helper </td>
										<td>:</td>
										<td><div class="radio">
												<input type='hidden' name='pertanyaan56' value=44>
												<label><input type="radio" name="jawaban56" value='1' checked>Baik</label>
												<label><input type="radio" name="jawaban56" value='2'>Tidak Baik/Rusak</label>
												<label><input type="radio" name="jawaban56" value='3'>Hilang</label>
											</div>
										</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="keterangan56" class="form-control col-md-7 col-xs-12" placeholder="Keterangan"/>
											</div>
										</td>
									</tr>
									
									
									
									</table>
								</div>
							</div>
						</div>
						
						<!-- BBM  KM -->
							
						<div class="x_panel tile">
							<div class="x_title">
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12"> 
									<table>
									<tr>
										<td>BBM OUT </td>
										<td>:</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="bbm_out" class="form-control col-md-7 col-xs-12" 
												<?php if($proses !== null) echo 'readonly'; ?>/>
											</div>
										</td>
									</tr>
									<tr>
										<td>BBM IN </td>
										<td>:</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="bbm_in" class="form-control col-md-7 col-xs-12"
												<?php if($proses == null) echo 'readonly'; ?> />
											</div>
										</td>
									</tr>
									<tr>
										<td>KM OUT </td>
										<td>:</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="km_out" class="form-control col-md-7 col-xs-12"
												<?php if($proses !== null) echo 'readonly'; ?> />
											</div>
										</td>
									</tr>
									<tr>
										<td>KM IN </td>
										<td>:</td>
										<td>
											<div class="col-md-6 col-sm-6 col-xs-9">
												<input type="text" name="km_in" class="form-control col-md-7 col-xs-12"
												<?php if($proses == null) echo 'readonly'; ?>/>
											</div>
										</td>
									</tr>
									
									
									</table>
								</div>
							</div>
						</div>
						 
						

						
						 
						  
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							  <button type="submit" class="btn btn-success" id="save" name="<?php if($proses==null){echo 'save';}else{echo 'update';} ?>">Submit</button>
							</div>
						</div>
					</form>
                </div>
              </div>
            </div>
        </div>
		</div>
	  </div>
	</div>
        <!-- /page content -->
			<link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
		<!-- jQuery -->
		<script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
		<!-- NProgress -->
		<script src="<?php echo base_url('/assets/js/nprogress.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
    	<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js');?>"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>
		<!-- Datatables -->
    <script>

      $(document).ready(function() {
		
		 $('#datetimepicker3').datetimepicker({
                  format: 'yyyy-mm-dd hh:ii:dd'
            });
			
			$('#datetimepicker4').datetimepicker({
                  format: 'yyyy-mm-dd hh:ii:dd'
            });
		  
					
		$('.form_date').datetimepicker({
			autoclose: 1,
			startView: 3,
			minView: 2,
			maxView: 3
		});
		  

       } );
    </script>
    <!-- /Datatables -->