<div class="box box-primary">
  <div class="box-header">
	<h3 class="box-title">Kontakt</h3>
  </div>
  <div class="box-body">

<?PHP
echo form_hidden('persons[' . $key . '][id]', $id);
?>


    <div class="row">
	  <div class="col-md-4 col-sm-4">

		<label>Anrede</label>

<?PHP

$options = array(
                  '0'  => 'Bitte W&auml;hlen',
                  'm'    => 'Herr',
                  'f'   => 'Frau',
                );

echo  form_dropdown('persons[' . $key . '][sex]', $options, $sex, 'class="form-control test" id="sex_' . $key . '"');
?>


	  </div>
	  <div class="col-md-4 col-sm-4">

		<label>Vorname</label>
 		<input name="persons[<?php echo $key;?>][firstname]" type="text" tabindex="1" placeholder="Vorname" value="<?php echo set_value('persons['.$key.'][firstname]', isset($firstname) ? $firstname : '');?>" class="form-control">
	  </div>

	  <div class="col-md-4 col-sm-4">
		  <label>Name</label>

 		  <input name="persons[<?php echo $key;?>][name]" type="text" tabindex="2" placeholder="Name" value="<?php echo set_value('persons['.$key.'][name]', isset($name) ? $name : '');?>" class="required form-control">
	  </div>

	</div> <!-- /row -->

    <div class="row">

	  <div class="col-md-4 col-sm-4 col-md-offset-4">
		  <label>Name Phonetisch</label>

 		  <input name="persons[<?php echo $key;?>][name_phonetic]" type="text" tabindex="3" placeholder="Name Phonetisch" value="<?php echo set_value('persons['.$key.'][name_phonetic]', isset($name_phonetic) ? $name_phonetic : '');?>"  class="form-control">
	  </div>

	  <div class="col-md-4 col-sm-4  hide-for-touch">
		  <label>Geburtstag</label>
<div class="input-group">
		<div class="input-group-addon">
		  <span class="prefix"><i class="fa fa-fw fa-calendar"></i>
		</div>
 		  <input id="gebTag" class="fdate form-control" name="persons[<?php echo $key;?>][birthday]" tabindex="4" value="<?php echo $birthday;?>">
</div><!-- /input-group -->


	  </div>

	</div> <!-- /row -->



    <div class="row">

	  <div class="col-md-4 col-sm-4  ">
		  <label>Telefon</label>
 		  <input name="persons[<?php echo $key;?>][tel]" type="tel" value="<?php echo $tel;?>" class="form-control">
	  </div>

	  <div class="col-md-4 col-sm-4  ">
		  <label>Mobil</label>
 		  <input name="persons[<?php echo $key;?>][mobile]" type="tel" value="<?php echo $mobile;?>" class="form-control">
	  </div>

	  <div class="col-md-4 col-sm-4  ">
		  <label>Fax</label>
 		  <input name="persons[<?php echo $key;?>][fax]" type="tel" value="<?php echo $fax;?>" class="form-control">
	  </div>

	</div> <!-- /row -->


    <div class="row">

	  <div class="col-md-4 col-sm-4  ">
		  <label>Email</label>
 		  <input name="persons[<?php echo $key;?>][email]" type="text"  placeholder="Email" value="<?php echo $email;?>" class="form-control">
	  </div>

	</div> <!-- /row -->


</div><!-- /.box-body -->
</div><!-- /.box -->
