{{template:partials:header}}

<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->



  {{template:partials:aside}}

  <section>
	<!-- row -->
	<div class="row">
	  <div class="col-xs-12">

		<div class="loading">
	  <div class="col-lg-12 col-xs-12 col-md-12">
		  <div class="progress progress-striped active">
			<div id="load" class="progress-bar progress-bar-primary" style="width: 25%" role="progressbar">
			  Loading ...
			</div>
		  </div>
		</div><!-- /col -->

	  </div><!-- /.loading -->




		<div class="content" style="display: none;">

                            <div class="nav-tabs-custom">
	{{tab_navigation}}
                                <div class="tab-content">

		  {{content}}

</div><!-- /.nav-tabs-custom -->
</div><!-- /.tab-content -->

		</div>
	  </div><!-- /.row -->
	</div><!-- /.col -->
  </section> <!--  / content -->
</aside> 
</div><!-- ./wrapper -->


<?
		echo "<pre><code>";
print_r($this->session->all_userdata());
echo "</code></pre>";

?>