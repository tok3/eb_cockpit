{{ session:messages success="small-box bg-green" notice="notice-box" error="error-box" }}

{{streams:form stream="leads_energy" mode="new" return="cockpit/calc/success" required="<span>*</span>"  notify_a=variables:mail_rec_energieausweis  notify_template_a="gewerbeenergie" notify_from_a=settings:server_email error_start="<label class=\"error\">" error_end="</label>" failure_message="No!"  success_message="Vielen Dank, einer unserer Mitarbeiter wird sich mit Ihnen in Verbindung setzen. " form_id="formCalc"}}
{{ form_open }}



<div class="row">
  <div class="col-xs-8"><h1>Energieausschreibung</h1></div>
  <div class="col-xs-4">{{ asset:image file="module::logo.png" alt="Logo Ihre Energieberater" id="ebLogo"}}</div>
</div> <!-- /row -->
<div class="row">

  <div class="col-xs-6 step1">
    <p class="hint2">Bitte geben Sie Ihre Daten ein.</p>
    </div>
  <div class="col-xs-2 step1">
{{asset:image file="module::<?php echo ($type  == 'gas' ? 'Gas' : 'Stromstecker');?>.jpg" alt="Logo Strom" class="pull-right ico"}}	
    </div>
  
 <div class="col-xs-8">

    <div class="step1">

    <div class="form-group">
      {{ el_branche:error }}
      {{ el_branche:input }}
    </div>
    <div class="form-group"><label id="minVerbr">Der Mindestverbrauch betr&auml;gt 100.000 kWh. </label>
      <label for="el_verbrauch">Verbrauch kWh * (min. 100.000)</label> 			{{ el_verbrauch:error }}
      {{ el_verbrauch:input }}
    </div>

<?
if($type  != 'gas'){
?>
    <div class="form-group">

          <label for="el_leistung">Leistung kWh (optional)</label> 			{{ el_leistung:error }}
      {{ el_leistung:input }}
    </div>
<?
}
?>

    
  <div class="col-xs-12 step1">
    {{ el_abnahmestellen:input }}
    </div>

</div><!-- /step1 -->

<div class="step2">

  <div class="row">
                <div class="col-xs-9">
                    <h2 class="price">Ihr Preis*</h2>
		</div><!-- /col -->
                <div class="col-xs-3 pull-right">
{{ asset:image file="module::<?php echo ($type  == 'gas' ? 'Gas' : 'Stromstecker');?>.jpg" alt="Logo energie" class="ico"}}	
                </div>
	    </div> <!-- /row -->

  <div class="row">
                <div class="col-xs-8 col-xs-offset-1">
                    <h1 class="pull-right price"><?php echo ($type  == 'gas' ? '{{ variables:Gewerbestrom }}' : '{{ variables:Gewerbestrom }}');?><span class="small">Ct/kWh</span></h1>

</div>
		</div><!-- /row -->
		    <div class="row">
                <div class="col-xs-10 col-xs-offset-2">
		    <p class="smallhint">
		      *Dieser Preis dient als unverbindlicher Richtwert auf Tagespreisbasis abh&auml;ngig von Lastgang, Branche, Anzahl Abnahmestellen, Maximale Jahresleistung, Versorgungsspanung und Anbieter
		    </p>
		    <p>
		      <div>KfW F&ouml;rderung bis zu 6.080,-</div>
		      <span class="displAktionscode"></span>

                </div>

            </div>

  </div> <!-- /.step2 -->
  </div> <!-- /.col-xs-8 -->
  <div class="col-xs-4">Direkt Anfrage<p><span class="bigbold">{{ variables:telefonnummer }}</span></p>Ihre Vorteile
    <ul class="check">
      <li>kostenloser Energiepreis-Check</li>
      <li>Pers&ouml;nlicher Ansprechpartner</li>
      <li>&Uuml;ber 1.000 Energieversorger</li>
      <li>Einsparpotential bis zu 30%</li>
      <li>100% Unabh&auml;ngig</li></ul>

    Check<ul class="check">
      <li>DIN EN 16247-1 / ISO 50001</li>
      <li>Steuerersparnis</li>
      <li>Energieaudit</li>
      <li><b class="nobr">KfW F&ouml;rderung bis zu &euro; 6.080,-</b></li></ul><span class="displAktionscode"></span>

    {{ form_submit }}                                                                                                                                                                        </div>  <!-- /.col-xs-4 -->
</div>  <!-- /.row -->


<div class="step2">

<div class="row">
  <div class="col-xs-4">
    <h1>Und Jetzt?</h1>
    <div class="panel arrow">
                    <div class="inner">Wir setzen uns mit Ihnen in Verbindung und starten die kostenfreie Energieausschreibung f&uuml;r Ihr Unternehmen</div>
                </div>
  </div> <!-- /.col-xs-4 -->
  <div class="col-xs-8">

<div class="row">
      <div class="col-xs-8">
<p class="hint2">Bitte f&uuml;llen Sie hierzu das folgende Formular aus</p>

      </div>
      <div class="col-xs-4">
{{ asset:image file="module::<?php echo ($type  == 'gas' ? 'Gas' : 'Stromstecker');?>.jpg" alt="Logo Energie" class="pull-right icoSmall"}}	
      </div>
    </div> <!-- /.row -->
    
    <div class="row">
      <div class="col-xs-6">
    <div class="form-group">
<div class="input-group" id="paste_verbrauch">
<!--<input type="text" name="verbrauch" id="verbr_uebertrag" value="" maxlength="20" class="form-control" placeholder="Verbrauch kWh *">-->
<span class="input-group-addon">kWh</span>
</div>
</div>

    
      </div>
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
          {{ el_anrede:error }}
	  <label class="radio-inline">
          </label>{{ el_anrede:input }}
	</div>
      </div>
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_name">Name *</label> 			{{ el_name:error }}
	  {{ el_name:input }}
	</div>

      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_firma">Firma *</label> 			{{ el_firma:error }}
	  {{ el_firma:input }}
	</div>
      </div>
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_telefon">Telefon *</label> 			{{ el_telefon:error }}
	  {{ el_telefon:input }}
	</div>

      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_email">Email *</label> 			{{ el_email:error }}
	  {{ el_email:input }}
	</div>
      </div>
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_plz">Plz *</label> 			{{ el_plz:error }}
	  {{ el_plz:input }}
	</div>

      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="el_ort">Ort *</label> 			{{ el_ort:error }}
	  {{ el_ort:input }}
	</div>
      </div>
    </div> <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
	{{ el_interest:input }}
      </div>
    </div> <!-- /.row -->
    <input type="hidden" name="el_art" value="<?php echo ($type  == 'gas' ? 'g' : 'e');?>" id="el_art">
    <div class="row">
      <div class="col-xs-6">
        &nbsp;
      </div>
      <div class="col-xs-6">
	{{ form_submit }}                           
      </div>
    </div> <!-- /.row -->
</div> <!-- /.step2 -->
  </div>  <!-- /.col-xs-8 -->
</div>  <!-- /.row -->

<?php 
   if(isset($_COOKIE['ihre_energieberater_af_id']))
   {


   echo 		'<input type="hidden" name="el_affiliate_id" value="' . $_COOKIE['ihre_energieberater_af_id'] . '" id="el_affiliate_id">';
   echo 		'<input type="hidden" name="el_aktions_code" value="' . $this->format->get_aktionscode($_COOKIE['ihre_energieberater_af_id']) . '" id="el_aktions_code">';

   }

   ?>


{{ form_close }}

{{ /streams:form }}


<!-- ende form -->



<!-- End Scripts -->
<script type="text/javascript">
  //<![CDATA[

      var footer_width = '{{theme:options:footer_width}}';
var sticky_footer = '{{theme:options:sticky_footer}}';
var is_mobile = '{{ mobiledetect:isMobile }}';
var aktionscode = '';

<?php 
   if(isset($_COOKIE['ihre_energieberater_af_id']))
   {
   $this->load->library('cockpit/format');

   echo "var aktionscode =  '" . $this->format->get_aktionscode($_COOKIE['ihre_energieberater_af_id']) . "'";
}


?>

var post = <?php echo json_encode($_POST) ?>;



//]]>
</script>
