<?php 


echo form_open();

?>

     <?php echo $id;?>
<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Bankverbindung</h3>
  </div>
  <div class="box-body">

       <div class="row">

	<div class="col-sm-12 col-lg-6 left">
  <?php echo $errors;?>

    <label>Kontoinhaber <span class="text-red">*</span></label>
     <?php echo $acc_holder;?>
	</div>
  </div>

       <div class="row">
     	<div class="col-sm-12 col-lg-6 left">
	  <label>Name der Bank <span class="text-red">*</span></label>
     <?php echo $bank_name;?>
	</div>
  </div>

       <div class="row">
     	<div class="col-sm-12 col-lg-6 left">
	  <label>IBAN <span class="text-red">*</span></label>
     <?php echo @$iban;?>
	</div>
  </div>

       <div class="row">
     	<div class="col-sm-12 col-lg-6 left">
	  <label>BIC <span class="text-red">*</span></label>
     <?php echo @$bic;?>
	</div>
  </div>


     

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
