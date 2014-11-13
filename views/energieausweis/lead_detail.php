
{{ streams:form stream="energieausweis" mode="edit" edit_id="<?php echo $id;?>" return=success_slug required="<span>*</span>"  error_start="<label class=\"error\">" error_end="</label>" notify_a=variables:mail_rec_energieausweis  notify_template_a="energieausweis" notify_from_a=settings:server_email failure_message="No!"  success_message="Yep" form_id="formEnergieausweis"}}


{{ form_open }}
<div class="box box-primary">
   <div class="box-header">
    <h3 class="box-title">Lead Energieausweis  </h3>
   </div>
   <div class="box-body">



<input type="hidden" name="affiliate_id" value="{{ affiliate_id:value }}" />
<input type="hidden" name="aktionscode" value="{{ aktionscode:value }}" />

{{ if affiliate_id:value > 0 }}
<strong>Affiliate ID: </strong>{{ affiliate_id:value }}
{{ endif }}
{{ if aktionscode:value != '' }}
<strong>Aktions-Code: </strong>{{ aktionscode:value }}
{{ endif }}


<div class="row">
   <div class="col-md-4 col-sm-4">

   <label>Anrede <span class="text-red">*</span></label>

{{ anrede:input }}

</div>
<div class="col-md-4 col-sm-4">

   <label>Vorname <span class="text-red">*</span></label>
{{ vorname:input}}
</div>

<div class="col-md-4 col-sm-4">
   <label>Name <span class="text-red">*</span></label>

{{ nachname:input}}

</div>

</div> <!-- /row -->


<div class="row">
<div class="col-md-4 col-sm-4">

   <label>Email <span class="text-red">*</span></label>
{{ e_mail:input}}
</div>

<div class="col-md-4 col-sm-4">
   <label>Telefon <span class="text-red">*</span></label>

{{ telefon:input}}

</div>

</div> <!-- /row -->

</div><!-- /.box-body -->
</div><!-- /.box -->

<div class="box box-primary">
					   <div class="box-header">
	<h3 class="box-title">Adresse</h3>
  </div>
  <div class="box-body">
								   
	<div class="row">

	  <div class="col-md-4 col-sm-4 ">
		<label>Strasse <span class="text-red">*</span></label>
{{ strasse:input }}
	  </div>

	  <div class="col-md-2 col-sm-2 left">
		<label>Nr <span class="text-red">*</span></label>
{{ nr:input }}

	  </div>

	</div> <!-- /row -->


	<div class="row">

	  <div class="col-md-2 col-sm-2">
		<label>PLZ <span class="text-red">*</span></label>
{{ plz:input }}

	  </div>

	  <div class="col-md-4 col-sm-4 left">
		<label>Ort <span class="text-red">*</span></label>
{{ ort:input }}

  </div>



	</div> <!-- /row -->
  </div><!-- /.box-body -->
</div>

<div class="box box-success">
					   <div class="box-header">
	<h3 class="box-title">Immobilie</h3>
  </div>
  <div class="box-body">

	<div class="row">

	  <div class="col-md-2 col-sm-2">
   <label>Ojektart <span class="text-red"></span></label>
		{{ objektart:input }}
	  </div>

	  <div class="col-md-2 col-sm-2">
   <label>Wohnfl&auml;che <span class="text-red"></span></label>
		{{ wohnflaeche:input }}
	  </div>

	  <div class="col-md-2 col-sm-2 left">
		<label>Baujahr <span class="text-red"></span></label>
		{{ baujahr:input }}
  </div>
	</div> <!-- /row -->

	<div class="row">

	  <div class="col-md-2 col-sm-2">
						 <label>Ver&auml;usserung <span class="text-red"></span></label>
		{{ verausserung_art:input }}
	  </div>

	  <div class="col-md-2 col-sm-2">
						 <label>Lieferung <span class="text-red"></span></label>
		{{ lieferung:input }}
	  </div>

	</div> <!-- /row -->
								   
	<div class="row">

	  <div class="col-md-6 col-sm-6 ">
		<label>Strasse <span class="text-red"></span></label>
{{ objekt_strasse:input }}
	  </div>

	</div> <!-- /row -->


	<div class="row">

	  <div class="col-md-2 col-sm-2">
		<label>PLZ <span class="text-red"></span></label>
{{ plz_objekt:input }}

	  </div>

	  <div class="col-md-4 col-sm-4 left">
		<label>Ort <span class="text-red"></span></label>
{{ objekt_ort:input }}

  </div>

	</div> <!-- /row -->

	<div class="row">

	  <div class="col-md-6 col-sm-6">
		<label>Bemerkung <span class="text-red"></span></label>
{{ bemerkung:input }}

	  </div>

	</div> <!-- /row -->



  </div><!-- /.box-body -->
</div>








<button type="button" id="approve_back" data-post-act="bck" class="submitLead btn primary">Annehmen und zur Liste</button>

<button type="button" id="approve_forward" data-post-act="fwd" class="submitLead btn primary">Annehmen und zu Kundendaten</button>
<button data-post-act="del" class="leadDelete submitLead btn secondary"  id="delete">L&ouml;schen</button>








  {{ form_close }}

  {{ /streams:form }}
  <!-- ende form -->
