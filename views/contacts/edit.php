
<?php 

$attributes = array('class'=>'custom contactDetails', 'id'=>'detailsForm');
echo form_open('',$attributes);

?>

  <?php echo $errors;?>
<div class="sections"></div><!-- wichtig startpunkt !!! -->




<div id="sec_company" class="sections">
  <?php  echo $company;?>

</div>

<div id="sec_addresses" class="sections">
  <?php  echo $addresses;?>

</div>

<div id="sec_contacts" class="sections">
  <?php echo $persons;?>

</div>

<div id="sec_contact_info" class="sections">
  <?php echo $contact_info;?>
      <?php echo $properties;?>
</div>

	<div class="row">
	  <div class="btnSection  col-sm-4 col-lg-4 col-md-4 pull-right text-right">
  <button name="save" class="btn btn-primary" type="submit" value="save">Speichern</button>

<?php

  if($this->current_user->group_id == 1)
	{
        echo '<a href="' . $this->session->userdata('contacts_backlink').'" class="btn button small secondary right">Zur&uuml;ck</a>';
	}
?>
	  </div>
</div>

</form>




