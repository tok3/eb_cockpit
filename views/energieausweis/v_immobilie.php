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
	<label>Wohnfl&auml;che<span class="text-red"></span></label>
	<div class="input-group">
	  <?php echo $qm;?>
          <span class="input-group-addon">qm</span>
	</div>



      </div>
      <div class="col-md-2 col-sm-2">
        <label>Fl&auml;che Grund <span class="text-red"></span></label>
	<div class="input-group">
	  <?php echo $qm_grund;?>
          <span class="input-group-addon">qm</span>
	</div>



      </div>
    </div> <!-- /row -->

    <div class="row">

      <div class="col-md-2 col-sm-2 left">
	<label>Baujahr <span class="text-red"></span></label>
	<?php echo $baujahr;?> 

      </div>
      <div class="col-md-4 col-sm-4">
        <label>Bauweise<span class="text-red"></span></label>
	<?php echo $bauart;?> 

      </div>

    </div> <!-- /row -->

    <div class="row">

      <div class="col-md-3 col-sm-3 left">
	<label>Heizung <span class="text-red"></span></label>
	<?php echo $heizung;?> 

      </div>
      <div class="col-md-3 col-sm-3">
        <label>Wasser<span class="text-red"></span></label>
	<?php echo $wasser;?> 

      </div>

    </div> <!-- /row -->

    <div class="row">
      <div class="col-md-6 col-sm-6">
        <label>Verbrauchsabrechnungen vorhanden ? (3 Jahre)<span class="text-red"></span></label>
	<?php echo $rg_verbrauch;?> 
        <label>Bauplan vorhanden ? <span class="text-red"></span></label>
	<?php echo $bauplan;?> 

      </div>

    </div> <!-- /row -->

    <div class="row">
      <div class="col-md-6 col-sm-6">
        <label>Intandhaltungsmassnahmen<span class="text-red"></span></label>
	<?php echo $instanthaltungsm;?> 

      </div>

    </div> <!-- /row -->

    
    <div class="row">
      <div class="col-md-2 col-sm-2">
	<label>Lieferung<span class="text-red"></span></label>
	<?php echo $bezugsfrei;?> 

      </div>

      <div class="col-md-4 col-sm-4">
	<label>Ver&auml;usserung art<span class="text-red"></span></label>
	<?php echo $verausserung_art;?> 

      </div>

    </div> <!-- /row -->

    <div class="row">
      <div class="col-md-2 col-sm-2">
        &nbsp;
      </div>

      <div class="col-md-2 col-sm-2">
	<label>Erwarteter Preis<span class="text-red"></span></label>
	<div class="input-group">
	<?php echo $est_preis;?> 
          <span class="input-group-addon">&euro;</span>
	</div>

      </div>

    </div> <!-- /row -->

        <div class="row">
      <div class="col-md-2 col-sm-2">
        &nbsp;
      </div>

      <div class="col-md-2 col-sm-2">
	<label>Provision (innen)<span class="text-red"></span></label>

	<div class="input-group">
          <?php echo $innenprovision;?>
          <span class="input-group-addon">%</span>
	</div>

      </div>

      <div class="col-md-2 col-sm-2">
	<label>Provision (aussen)<span class="text-red"></span></label>

	<div class="input-group">
          <?php echo $aussenprovision;?>
          <span class="input-group-addon">%</span>
	</div>

      </div>

	</div> <!-- /row -->


    <div class="row">
      <div class="col-md-2 col-sm-2">
	<br>
        <label>Verkauft<span class="text-red"></span></label>
	<?php echo $verkauft;?> 


      </div>

      <div class="col-md-2 col-sm-2">
	<label>Erzielter Preis<span class="text-red"></span></label>
	<div class="input-group">
	<?php echo $vk_preis;?> 
          <span class="input-group-addon">&euro;</span>
	</div>

      </div>

    </div> <!-- /row -->



        <div class="row">
      <div class="col-md-2 col-sm-2">
        <label>Makler Kontaktiert<span class="text-red"></span></label>
	<?php echo $makler_kontaktiert;?> 


      </div>

      <div class="col-md-3 col-sm-3">
	<label>Welche<span class="text-red"></span></label>
	<?php echo $makler;?> 

      </div>

    </div> <!-- /row -->

	        <div class="row">
      <div class="col-md-3 col-sm-3">
	<br>
        <label>Weiter an Makler<span class="text-red"></span></label>
	<?php echo $an_makler;?> 


      </div>


    </div> <!-- /row -->

			        <div class="row">

      <div class="col-md-3 col-sm-3">
	<br>
        <label>Weiter an Energieberater<span class="text-red"></span></label>
	<?php echo $an_energieberater;?> 


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
