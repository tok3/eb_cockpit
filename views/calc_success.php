<?
if(!isset($_GET['type']))
{
$_GET['type'] = 'e';
}
?>
{{ session:messages success="small-box bg-green" notice="notice-box" error="error-box" }}

{{streams:form stream="leads_energy" mode="new" return="cockpit/calc/success" required="<span>*</span>"  notify_a=variables:mail_rec_energieausweis  notify_template_a="gewerbeenergie" notify_from_a=settings:server_email error_start="<label class=\"error\">" error_end="</label>" failure_message="No!"  success_message="Vielen Dank, einer unserer Mitarbeiter wird sich mit Ihnen in Verbindung setzen. " form_id="formCalc"}}
{{ form_open }}




<div class="row">
  <div class="col-xs-8"></div>
  <div class="col-xs-4">{{ asset:image file="module::logo.png" alt="Logo Ihre Energieberater" id="ebLogo"}}</div>
</div> <!-- /row -->
<div class="row">
                  <div class="col-xs-12">
      
    <div class="jumbotron">
    <h1>Vielen Dank f&uuml;r Ihr Interesse!</h1>
<p>Wir werden uns schnellst m&ouml;glich mit Ihnen in Verbindung setzen.</p>
  <p><a class="btn btn-primary btn-lg" href="<?php echo site_url();?>" role="button">Mehr Information</a></p>
</div>

</div> <!-- /col -->

</div> <!-- /row -->
    <!-- badges -->


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
    <a class="small-box-footer" href="<?php echo site_url();?>">
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
   <nobr>&Uuml;ber 3000 Beratungen im Jahr</nobr>
      </p>
    </div>
    <div class="icon">
      <i class="fa fa-thumbs-up"></i>
    </div>
    <a class="small-box-footer" href="<?php echo site_url();?>">
      Mehr <i class="fa fa-arrow-circle-right"></i>
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
    <a class="small-box-footer" href="<?php echo site_url();?>">
      Mehr <i class="fa fa-arrow-circle-right"></i>
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
    <a class="small-box-footer" href="<?php echo site_url();?>">
      Mehr <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
                        </div><!-- ./col -->
                    </div>

                          </div>