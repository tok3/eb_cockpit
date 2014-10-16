<?php echo form_open();?>
<?php echo $id;?> 

<div class="box box-primary">
					   <div class="box-header">
	<h3 class="box-title">Kunde</h3>
  </div>
  <div class="box-body">
<address>
<strong><?php echo $contact['persons']['0']['firstname'];?> <?php echo $contact['persons']['0']['name'];?>
</strong>
<br>
<?php echo $contact['addresses']['0']['str'] . $contact['addresses']['0']['no'];?>
<br>
</strong><?php echo $contact['addresses']['0']['plz'];?> </strong> <?php echo $contact['addresses']['0']['city'];?>
</address>
</div><!-- /box-body -->
</div><!-- /box -->

<div class="box box-success">
					   <div class="box-header">
	<h3 class="box-title">Immobilie</h3>
  </div>
  <div class="box-body">

	<div class="row">

	  <div class="col-md-2 col-sm-2">
   <label>Ojektart <span class="text-red"></span></label>
<?php echo $objektart;?> 
	  </div>

	  <div class="col-md-2 col-sm-2">
   <label>Wohnfl&auml;che <span class="text-red"></span></label>
<?php echo $qm;?> 

	  </div>

	  <div class="col-md-2 col-sm-2 left">
		<label>Baujahr <span class="text-red"></span></label>
<?php echo $baujahr;?> 

  </div>
	</div> <!-- /row -->

	<div class="row">

	  <div class="col-md-2 col-sm-2">
						 <label>Lieferung<span class="text-red"></span></label>
<?php echo $bezugsfrei;?> 

	  </div>

	  <div class="col-md-2 col-sm-2">
						 <label>Ver&auml;usserung <span class="text-red"></span></label>
<?php echo $verausserung_art;?> 

	  </div>

	</div> <!-- /row -->
								   
	<div class="row">

	  <div class="col-md-6 col-sm-6 ">
		<label>Strasse <span class="text-red"></span></label>
<?php echo $str;?> 

	  </div>

	</div> <!-- /row -->


	<div class="row">

	  <div class="col-md-2 col-sm-2">
		<label>PLZ <span class="text-red"></span></label>
<?php echo $plz;?> 

	  </div>

	  <div class="col-md-4 col-sm-4 left">
		<label>Ort <span class="text-red"></span></label>
<?php echo $ort;?> 

  </div>

	</div> <!-- /row -->



	<div class="row">

	  <div class="col-md-6 col-sm-6">
		<label>Bemerkung <span class="text-red"></span></label>
<?php echo $bemerkung;?> 

	  </div>

	</div> <!-- /row -->



  </div><!-- /.box-body -->
</div>
	<div class="row">
	  <div class="btnSection  col-sm-4 col-lg-4 col-md-4 pull-right text-right">
  <button name="save" class="btn btn-primary" type="submit" value="save">Speichern</button>

<?php

  if($this->current_user->group_id == 1)
	{
	  echo '<a href="' . site_url('cockpit/contacts').'" class="btn button small secondary right">Zur&uuml;ck</a>';
	}
?>
	  </div>
</div>

<?php echo form_close();?>