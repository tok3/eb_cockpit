<div class="box box-primary">
  <div class="box-header">
	<h3 class="box-title">Firma</h3>

  </div>
  <div class="box-body">

<?php
echo form_hidden('comp[id]', $comp_id);
?>


  <div class="row">

	<div class="col-sm-12 col-lg-6 left">
	  <label>Name</label>
	  <input name="comp[name]" type="text" placeholder="Firmenname" value="<?php echo $comp_name;?>" class="form-control">
	  <input name="comp[name_2]" type="hidden" value="">

	</div>

  </div>

  <div class="row  hide-for-touch">

	<div class="col-sm-12 col-md-6 col-lg-6">
	  <label>Email</label>
	  <input class="small hide-for-touch form-control" name="comp[email]" type="email"  value="<?php echo $comp_email;?>">
	</div>


	<div class="col-sm-12 col-md-6 col-lg-6">
		<label>Internet</label>
<div class="input-group">
		<div class="input-group-addon">
		  <span class="prefix">http://www.</span>
		</div>
		  <input type="text" name="comp[homepage]" placeholder="Firmenwebseite" value="<?php echo $homepage;?>"  class="form-control">
</div><!-- /input-group -->
	</div>


  </div>

  <div class="row hide-for-touch">

	<div class="col-sm-6">
	  <label>Telefon</label>
	  <input class="small form-control" name="comp[tel]" type="tel" placeholder="Tel. Zentrale" value="<?php echo $comp_tel;?>">
	</div>


	<div class="col-sm-6 left">
	  <label>Fax</label>
	  <input class="small form-control" name="comp[fax]" type="tel" placeholder="Fax" value="<?php echo $comp_fax;?>">
	</div>

  </div>



</div><!-- /.box-body -->
</div><!-- /.box -->
