<?php echo $this->extend('layout/template') ?>
<?php echo $this->section('content'); ?>

<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- <span class="breadcrumb"><a href="#">Home</a>  /  Staf</span> -->
          <h3>Data Staf</h3>
        </div>
      </div>
    </div>
  </div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
          	<div class="row">
          		<div class="card">
					<div class="card-header">
						<div class="d-flex justify-content-between align-items-center">
							<h1>Staf Hotel</h1>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<table class="table table-striped" id="table">
									<tr>
										<th>No</th>
										<th>Nama Staf</th>
										<th>Alamat</th>
										<th>Telepon</th>
									</tr>

									<?php 
									$no = 1;
									foreach ($list as $value): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $value->nama_staf ?></td>
											<td><?php echo $value->alamat ?></td>
											<td><?php echo $value->no_telepon ?></td>
										</tr>
									<?php $no++; endforeach ?>

								</table>
							</div>
						</div>
					</div>
				</div>
          		
          	</div>
          </div>
      </div>
  </div>
</div>



<div class="modal" tabindex="-1" id="modal_form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Data Staf</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?= base_url('homestaff/tambah') ?>">
        <div class="row">
        	  <div class="col-md-12">
                   <div class="form-group">
                                             <label class="">Nama Staf</label>
                                            <input name="nama_staf" id="nama_staf" placeholder="Masukan Nama Staff" class="form-control" type="text" >
                                            <span class="help-block"></span>
					</div>
                </div>
        </div>

        <div class="row">
        	  <div class="col-md-12">
                   <div class="form-group">
                                             <label class="">Alamat Staf</label>
                                            <input name="alamat" id="alamat" placeholder="Masukan Alamat Staff" class="form-control" type="text" >
                                            <span class="help-block"></span>
					</div>
                </div>
        </div>

        <div class="row">
        	  <div class="col-md-12">
                   <div class="form-group">
                                             <label class="">No Telepon Staf</label>
                                            <input name="no_telepon" id="no_telepon" placeholder="Masukan No Telepon Staff" class="form-control" type="text" >
                                            <span class="help-block"></span>
					</div>
                </div>
        </div>

    		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
        <button type="submit" class="btn btn-success">Simpan Data</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
	function tambah(){
		// $('#form')[0].reset(); // reset form on modals
	    // $('.form-group').removeClass('has-error'); // clear error class
	    // $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Input Staf Baru'); // Set Title to Bootstrap modal title
	}


$(document).ready(function() {
	// new DataTable('#example');
	// alert();
	 $('#table').DataTable();
});



</script>


<?php echo $this->endSection(); ?>