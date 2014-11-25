<?
if($this->session->userdata('contact_id') != '' && $this->current_user->group == 'user')
  {

?>     

<div class="col-md-8">
                            <!-- general form elements -->
                    
        <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Download Vollmacht</h3>
                                </div><!-- /.box-header -->
<div class="row">
<div class="col-md-8 col-md-offset-1">
<div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                         <b>Wichtig!</b><br>Bitte klicken Sie den rechten Button und laden Sie sich die Vollmacht herunter.<br>
	Senden Sie die unterschriebene Vollmacht bitte an uns zur&uuml;ck:<br>
	per Fax an die Nummer: <b>06021-130712-1</b> <br>
	per E-Mail an: <a href="mailto:info@energie-jetzt-guenstiger.de">info@energie-jetzt-guenstiger.de</a> 
<br>oder ganz klassisch als Brief an unsere <a href="<?php echo site_url('impressum');?>"> Postadresse. </a>
<br>

                                    </div>
</div>
<div class="col-md-3">
<a href="<?php echo site_url('uploads/pdf/Vollmacht Ihre-Energieberater.pdf');?>" class="btn btn-app">
<small class="badge pull-right bg-green">1</small>
<i class="fa fa-download"></i>
Download
</a>
</div>

</div><!-- /row -->
                            </div><!-- /.box -->
 
                        </div>

<?
			  }
 else // kontaktdaten müssen noch ergänzt werden
  {
?>
<div class="col-md-8">
                            <!-- general form elements -->
                    
        <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Zur Zeit keine Dokumente Vorhanden</h3>
                                </div><!-- /.box-header -->

                            </div><!-- /.box -->
 
                        </div>

<?
			  }

?>
