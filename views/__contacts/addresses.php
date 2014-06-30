<!--  -->
<div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Adresse</h3>
                                </div>
                                <div class="box-body">

<?php
echo form_hidden('addresses[' . $key . '][id]', $id);


?>


<div class="row">

  <div class="col-md-5 col-sm-5 ">
	<label>Strasse</label>
	<input type="text" name="addresses[<?php echo $key;?>][str]" placeholder="strasse" value="<?php echo $str;?>" class="form-control">
  </div>

  <div class="col-md-1 col-sm-1 left">
	<label>Nr</label>
	<input type="text" name="addresses[<?php echo $key;?>][no]" placeholder="Nr" value="<?php echo $no;?>" class="form-control">
  </div>


</div> <!-- /row -->


<div class="row">

  <div class="col-md-2 col-sm-2">
	<label>PLZ</label>
	<input type="number" name="addresses[<?php echo $key;?>][plz]" placeholder="plz" value="<?php echo $plz;?>" class="form-control">
  </div>

  <div class="col-md-4 col-sm-4 left">
	<label>Ort</label>
<?php echo 'addresses['. $key . '][city]';?>
	<input type="text" name="addresses[<?php echo $key;?>][city]" placeholder="ort" value="<?php echo set_value('addresses['. $key . '][city]');?>" class="form-control">
  </div>



</div> <!-- /row -->
                                </div><!-- /.box-body -->
                            </div>
