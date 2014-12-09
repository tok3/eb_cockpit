

<div class="row">
  <div class="col-lg-12">
<!-- content -->
<div class="callout callout-info">
                                        <h4>Alles erledigt!</h4>
     <p>Ihre Affiliate ID ist: <strong><?php echo $this->session->userdata('contact_id');?></strong></p><p>
Sie Können nun jede Seite von <strong>"{{ settings:site_name }}"</strong> mit Ihrer Affiliate-ID bewerben.<br>
Dazu h&auml;ngen Sie einfach Ihre ID als Get-Parameter (<strong>?afid=<?php echo $this->session->userdata('contact_id');?></strong>) an eine beliebige Url. <br>
<strong>Beispiel:</strong> {{ settings:base_url }}?afid=<?php echo $this->session->userdata('contact_id');?>
</p>

</div>
  <!-- ende content -->   
  </div>
</div> <!-- /.row -->

<div class="row">
                <div class="col-lg-2">
                                                         <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $this->format->get_aktionscode($this->session->userdata('contact_id'));?>&choe=UTF-8" title="Affiliate_qr" />
                </div><!-- /col-lg-4 -->
  <div class="col-lg-10">
<!-- content -->
<div class="callout callout-info">
                <h4>Pers&ouml;nlicher Aktionscode</h4>
<p>Ihr pers&ouml;nlicher Aktionscode ist: <strong><?php echo $this->format->get_aktionscode($this->session->userdata('contact_id'));?></strong></p>
<p>Dieser Code wird allen geworbenen Kunden zus&auml;tzlich angezeigt. Bei telefonischer Kontaktaufnahme wird der Aktionscode von unseren Mitarbeitern abgefragt und in unserem System hinterlegt. Dadurch können wir Ihren Provisionsanspruch auch bei Kunden die uns telefonisch kontaktieren eindeutig zuordnen. </p>


</div>

<!-- ende content -->   
  </div>


</div> <!-- /.row -->

    
<!-- ab hier boxes -->

<div class="row">
                          </div><!-- /.row -->

                <div class="row">
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
  </div>                        </div><!-- ./col -->
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
                    </div>