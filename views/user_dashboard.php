
<div class="row">
  <div class="col-lg-12">

	<ul class="timeline">

<?
if($this->session->userdata('contact_complete') == 1)
  {

?>     



 <!-- timeline time label -->

      <!-- timeline item -->
      <li>
        <!-- timeline icon -->
        <i class="fa fa-exchange bg-green"></i>
        <div class="timeline-item">

		  </span>

<h3 class="timeline-header"><a href="<?php echo site_url('cockpit/documents/index');?>">Ein Klick zu Ihrer kostenlosen Energieausschreibung ! </a> <i class="fa fa-warning text-yellow"></i> </h3>

          <div class="timeline-body">
Vollmacht laden, ausf&uuml;llen, absenden, sparen !
<p>
<small>
Laden Sie sich bitte im Bereich "<a href="<?php echo site_url('cockpit/documents/index');?>">Dokumente</a>" die Vollmacht herunter und senden Sie diese zur&uuml;ck. <br> Wir werden Ihnen umgehend unsere <strong>Kostenlosen</strong> Dienstleistungen zugute kommen lassen.

</small>
</p>
</div>

          <div class='timeline-footer'>

          </div>
        </div>
      </li>


 <!-- timeline time label -->
      <li class="time-label">
        <span class="bg-red">
<?php 	   echo $this->format->date2de($this->session->userdata('contact_data')->init_date);?>
        </span>
      </li>
      <!-- /.timeline-label -->

      <!-- timeline item -->
      <li>
        <!-- timeline icon -->
        <i class="fa fa-user bg-blue"></i>
        <div class="timeline-item">
<span class="time"><i class="fa fa-clock-o"></i> 	<?php 	   echo substr($this->session->userdata('contact_data')->init_time,0,-3);?>
		  </span>

<h3 class="timeline-header"><a href="<?php echo site_url('cockpit/contact_details/contact');?>">Kontakdaten erstellt !</a></h3>

          <div class="timeline-body">
Erforderliche Kontaktdaten wurden erstellt.          </div>

          <div class='timeline-footer'>

          </div>
        </div>
      </li>
<?
			  }
 else // kontaktdaten müssen noch ergänzt werden
  {
?>
 <!-- timeline time label -->

      <!-- timeline item -->
      <li>
        <!-- timeline icon -->
        <i class="fa fa-user bg-blue"></i>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> 	<?php 	   echo date('H:i',time());?>
		  </span>

			  <h3 class="timeline-header"><a href="#">Bitte erstellen Sie Ihre Kontaktdaten  <i class="fa fa-warning text-yellow"></i></a> </h3>

          <div class="timeline-body">
																					Bitte gehen Sie auf den Men&uuml;punkt "Meine Kontaktdaten" und vervollst&auml;ndigen Sie diese !
          </div>

          <div class='timeline-footer'>
            <a href="<?php echo site_url('cockpit/contact_details/contact/'. $this->session->userdata('contact_id'));?>" class="btn btn-primary btn-xs">Meine Kontaktdaten ... </a>
          </div>
        </div>
      </li>
<?
			  }

?>


      <li class="time-label">
        <span class="bg-red">
		  <?php 	   echo date('d.m.Y',$this->ion_auth->get_user()->created_on);?>
        </span>
      </li>
	  <li>
        <i class="fa  fa-thumbs-up bg-aqua"></i>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> <?php 	   echo date('H:i',$this->ion_auth->get_user()->created_on);?></span>

          <h3 class="timeline-header"><a href="<?php echo site_url('users/edit');?>">Benutzerkonto erfolgreich erstellt !</a></h3>

          <div class="timeline-body">
			Ihr Benutzerkonto wurde erfolgreich erstellt und freigeschaltet.            </div>

        </div>

      </li>    

	</ul>
  </div>
</div>

<div class="box">
<div class="box-body">
<div class="col-lg-3 col-xs-6">

  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>
        1000+
      </h3>
      <p>
   &Uuml;ber 1000 Energieversorger
      </p>
    </div>
    <div class="icon">
      <i class="ion ion-ios7-lightbulb-outline"></i>
    </div>
    <a class="small-box-footer" href="<?php echo site_url('cockpit/versorger');?>">
      Mehr <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3>
        3000+</sup>
      </h3>
      <p>
   &Uuml;ber 3000 Beratungen jedes Jahr
      </p>
    </div>
    <div class="icon">
      <i class="fa fa-thumbs-up"></i>
    </div>
    <a class="small-box-footer" href="#">
      Mehr info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>
        100%
      </h3>
      <p>
        Kundenzufriedenheit
      </p>
    </div>
    <div class="icon">
      <i class="fa fa-heart"></i>
    </div>
    <a class="small-box-footer" href="#">
      Mehr info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div><!-- ./col -->

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3>
        100%
      </h3>
      <p>
		   Unabh&auml;ngig und Objektiv
      </p>
    </div>
    <div class="icon">
      <i class="fa  fa-eye"></i>
    </div>
    <a class="small-box-footer" >
      Mehr info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div><!-- ./col -->
</div> <!-- /box-body -->
</div> <!-- /box -->
								</div>
