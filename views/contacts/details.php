
<div class="box box-primary">
  <div class="box-header">
	<h3 class="box-title">Kontaktinfo</h3>
  </div>
  <div class="box-body">



	<div class="row">

	  <div class="col-sm-3 col-lg-3 left">
		<label>Kontakttyp</label>
		<?PHP

	echo $typ;
echo form_hidden('details[deleted]', 0);

		?>

	  </div>
	</div> <!-- /row -->

	<div class="row _hide " id="initialDate" >

	  <div class="col-sm-12 columns left">
		<label>Erstellt</label>

		<p id="erstkontakt"><?php echo $this->format->date2german($initial_contact);?></p>
	  </div>

	</div>

<section class="adminStuff hide">
	<div class="row init">

	  <div class="col-sm-3">
		<label>Wiedervorlage</label>
		<div class="input-group">
		  <div class="input-group-addon">
			<span class="prefix"><i class="fa fa-fw fa-calendar"></i>
		  </div>
<?php echo $followup_date;?>

		</div><!-- /input-group -->



	  </div>

	  <div class="col-sm-3 left">
		<label>Zeit</label>
		<div class="input-group">
		  <div class="input-group-addon">
			<span class="prefix"><i class="fa fa-fw fa-clock-o"></i>
		  </div>
<?php echo $followup_time;?>
		</div><!-- /input-group -->


	  </div>


	</div> <!-- /row -->

	<div class="row init _hide">

	  <div class="col-sm-12 col-lg-12 columns">
		<label>Memo</label>


<?php echo $memo;?>
		<span id="contactsMemo" class="show"><?php echo $memo;?></span>


	  </div>
	</div> <!-- /row -->
		</section>  <!-- ende .adminStuff -->

  </div><!-- /.box-body -->
</div><!-- /.box -->




