<div class="box box-primary">
  <div class="box-header">
	<h3 class="box-title">Firma </h3>

  </div>
  <div class="box-body">
<?php /* echo str_pad($this->uri->rsegment(3),6,0,STR_PAD_LEFT);*/?>
     
<?php echo $id; /* hidden field !!! do not remove */?>


  <div class="row">

	<div class="col-sm-12 col-lg-6 left">
	  <label>Name Firma oder Einzelperson <span class="text-red">*</span></label>

<?php echo $name;?>
<?php echo $name_2;?>
<?php echo $email;?>


	</div>

  </div>

       <div class="row">

	<div class="col-sm-6 col-lg-3 left">
     <label>Steuernummer <span class="text-red"></span></label>
<?php echo $str_id;?>
	</div>

     	<div class="col-sm-6 col-lg-3 left">
     <label>USt-Identifikationsnummer  <span class="text-red"></span></label>
<?php echo $ust_id;?>
	</div>

  </div>

  <div class="row  hide-for-touch">

	<div class="col-sm-12 col-md-6 col-lg-6">
		<label>Internet</label>


<div class="input-group">
		<div class="input-group-addon">
		  <span class="prefix">http://www.</span>
		</div>
<?php echo $homepage;?>
</div><!-- /input-group -->
	</div>


  </div>

  <div class="row hide-for-touch">

	<div class="col-sm-6">
	  <label>Telefon</label>
<?php echo $tel;?>
	</div>


	<div class="col-sm-6 left">
	  <label>Fax</label>
<?php echo $fax;?>
	</div>

  </div>



</div><!-- /.box-body -->
</div><!-- /.box -->
