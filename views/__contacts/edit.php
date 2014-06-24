
<?php 

$attributes = array('class'=>'custom contactDetails', 'id'=>'detailsForm');
echo form_open('',$attributes);

?>


<div class="sections"></div><!-- wichtig startpunkt !!! -->


  <?php echo $errors;?>

<div id="sec_company" class="sections">
  <?php  $company;?>

</div>

<div id="sec_addresses" class="sections">
  <?php  $addresses;?>

</div>

<div id="sec_contacts" class="sections">
  <?php echo $persons;?>

</div>

<div id="sec_contact_info" class="sections">
  <?php echo $contact_info;?>
</div>

	<div class="row">
	  <div class="btnSection  col-sm-4 col-lg-4 col-md-4 pull-right text-right">
  <button name="save" class="btn btn-primary" type="submit" value="save">Speichern</button>
  <a href="<?php echo site_url('cockpit/contacts');?>" class="btn button small secondary right">Zur&uuml;ck</a>
	  </div>
</div>

</form>




