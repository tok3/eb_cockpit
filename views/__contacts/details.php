
<div class="box box-primary">
  <div class="box-header">
	<h3 class="box-title">Kontaktinfo</h3>
  </div>
  <div class="box-body">



	<div class="row">

	  <div class="col-sm-3 col-lg-3 left">
		<label>Typ</label>
		<?PHP

$options = array(
'0'  => 'Bitte W&auml;hlen',
'1'    => 'Privatperson',
'2'   => 'Firma',
);

echo form_dropdown('contacts[typ]', $options, 1, 'id="contactType" class="contactType  form-control"');

		?>

	  </div>
	</div> <!-- /row -->

	<div class="row hide " id="initialDate" >

	  <div class="col-sm-12 columns left">
		<label>Erstkontakt</label>
		<p id="erstkontakt"><?php echo $this->format->date2german($initial_contact);?></p>
	  </div>

	</div>

	<div class="row init hide">

	  <div class="col-sm-3">
		<label>Wiedervorlage</label>
		<div class="input-group">
		  <div class="input-group-addon">
			<span class="prefix"><i class="fa fa-fw fa-calendar"></i>
		  </div>
		  <input id="followupDate" name="followup_date" value="<?php echo $this->format->date2german($followup_date);?>" class="fdate form-control" >
		</div><!-- /input-group -->



	  </div>

	  <div class="col-sm-3 left">
		<label>Zeit</label>
		<div class="input-group">
		  <div class="input-group-addon">
			<span class="prefix"><i class="fa fa-fw fa-clock-o"></i>
		  </div>
		  <input id="followupTime" name="followup_time"  value="<?php echo $followup_time;?>" class="timepicker form-control" >
		</div><!-- /input-group -->


	  </div>


	</div> <!-- /row -->

	<div class="row init hide">

	  <div class="col-sm-12 col-lg-12 columns">
		<label>Memo</label>


		<textarea class="hide" id="inpContactsMemo" name="contacts[memo]"  rows="2" cols="40" class="form-control"><?php echo trim($memo);?></textarea>
		<span id="contactsMemo" class="show"><?php echo trim($memo);?></span>


	  </div>
	</div> <!-- /row -->


  </div><!-- /.box-body -->
</div><!-- /.box -->




