
<div class="row">
  <div class="col-lg-12">
<!-- content -->
<div class="callout callout-info">
                                        <h4>Alles erledigt!</h4>
                                        <p>Deine Affiliate ID ist <strong><?php echo $this->session->userdata('contact_id');?></strong></p><p>
Du kannst nun auf jede Seiten von {{ settings:site_name }} mit Deiner Affiliate-ID verlinken.<br>
Dazu h&auml;ngst Du einfach folgendes an eine beliebige URL: <strong>?afid=<?php echo $this->session->userdata('contact_id');?></strong><br>
<strong>Beispiel:</strong> {{ settings:base_url }}?afid=<?php echo $this->session->userdata('contact_id');?>
</p>
                                    </div>
  <!-- ende content -->   
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
