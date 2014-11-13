
<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Immobilie</h3>
  </div>
  <div class="box-body">

    <div class="row">

      <div class="col-md-4 col-sm-4">
     <label>Letzte Aktualisierung: <span class="text-red"></span></label>
<div>
	<?php echo $last_upd;?> 
</div>
      </div>
    </div> <!-- /row -->

         <div class="row">
           <div class="col-md-4 col-sm-4">
     <label>Objektart: <span class="text-red"></span></label>
<div>
	<?php echo $objektart;?> 
</div>
     </div>
    </div> <!-- /row -->

              <div class="row">
           <div class="col-md-4 col-sm-4">
     <label>Gesch&auml;tzter Verkehrswert: <span class="text-red"></span></label>
<div>
	<?php echo $this->format->displCurr($est_preis,TRUE);?> 
</div>
     </div>
    </div> <!-- /row -->

                                         <div class="row">
           <div class="col-md-4 col-sm-4">
     <label>Voraussichtliche Provision: <span class="text-red"></span></label>
<div>
	<?php echo $this->format->displCurr($ges_provision,TRUE);?> 
</div>
     </div>
    </div> <!-- /row -->



  </div><!-- /.box-body -->
</div>

