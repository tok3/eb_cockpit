<div class="box box-primary">
   <div class="box-header">
   <h3 class="box-title">Kontakt</h3>
   </div>
   <div class="box-body">

   <?php echo $id;?>


<div class="row">
   <div class="col-md-4 col-sm-4">

   <label>Anrede*</label>

   <?php echo $sex;?>


</div>
<div class="col-md-4 col-sm-4">

   <label>Vorname*</label>
   <?php echo $firstname;?>

</div>

<div class="col-md-4 col-sm-4">
   <label>Name*</label>

   <?php echo $name;?>

</div>

</div> <!-- /row -->

<div class="row">

   <div class="col-md-4 col-sm-4 col-md-offset-4 adminStuff">
   <label>Name Phonetisch</label>

   <?php echo $name_phonetic;?>
</div>

<div class="col-md-4 col-sm-4  hide-for-touch">
   <label>Geburtstag</label>
   <div class="input-group">
   <div class="input-group-addon">
   <span class="prefix"><i class="fa fa-fw fa-calendar"></i>
   </div>
   <?php echo $birthday;?>
</div><!-- /input-group -->


</div>

</div> <!-- /row -->



<div class="row">

   <div class="col-md-4 col-sm-4  ">
   <label>Telefon*</label>
   <?php echo $tel;?>
</div>

<div class="col-md-4 col-sm-4  ">
   <label>Mobil</label>
   <?php echo $mobile;?>
</div>

<div class="col-md-4 col-sm-4  ">
   <label>Fax</label>
   <?php echo $fax;?>
</div>

</div> <!-- /row -->


<div class="row">

   <div class="col-md-4 col-sm-4  ">
   <label>Email*</label>
   <?php echo $email;?>
</div>


</div> <!-- /row -->


</div><!-- /.box-body -->
</div><!-- /.box -->
