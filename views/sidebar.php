<aside class="left-side sidebar-offcanvas">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">

	</div>
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">

	  <li class="<?php  echo check_active(array('cockpit','cockpit/index'));?>">
		<a href="<?php echo site_url('cockpit/');?>">
		  <i class="fa fa-dashboard"></i> <span>Nachrichtenzentrale</span>
		</a>
	  </li>
	  

	  <?

		 if($this->current_user->group_id == 1) // admin
	  {
	  ?>
	  <li class="<?php  echo check_active('cockpit/contacts');?>">
		<a href="<?php echo site_url('cockpit/contacts');?>">
		  <i class="fa fa-user"></i><span>Kontakte</span>
		</a>
	  </li>

	  <?
		 }
		 else
		 {
		 ?>

	  <li class="<?php  echo check_active('cockpit/contact_details/contact/'. $this->session->userdata('contact_id'));?>">
		<a href="<?php echo site_url('cockpit/contact_details/contact/'. $this->session->userdata('contact_id'));?>">
		  <i class="fa fa-user"></i><span>Meine Kontakdaten</span>
		</a>
	  </li>

	  <?
		 }

		 ?>

		 <li class="actLevel2"  class="<?php  echo check_active('cockpit/documents/index');?>">
   <a href="<?php echo site_url('cockpit/documents/index');?>">
   <i class="fa fa-exchange"></i><span>Dokumente</span>
   <?
   if($this->session->userdata('contact_id') != '')
	 {

	   ?>     

	   <small class="badge pull-right bg-green">1</small>
	   <?
	 }
   ?>
   </a>
   </li>


	  <li  class="actLevel2" class="<?php  echo check_active('cockpit/versorger');?>">
		<a href="<?php echo site_url('cockpit/versorger');?>">
		  <i class="fa  fa-power-off"></i> <span>Energieversorger</span>
		</a>
	  </li>


	  <li class="noauth">
		<a href="<?php echo site_url('cockpit/documents/index');?>">
	<i class="fa  fa-lightbulb-o"></i> <span>Abnahmestellen Strom</span>
		</a>
	  </li>

	  <li class="noauth">
	 <a href="<?php echo site_url('cockpit/documents/index');?>">
		  <i class="fa  fa-fire"></i> <span>Abnahmestellen Gas</span>
		</a>
	  </li>
	  <li class="noauth">
	 <a href="<?php echo site_url('cockpit/documents/index');?>">
		  <i class="fa  fa-wrench"></i> <span>Tools</span>
		</a>
	  </li>

	  <li class="noauth">
	 <a href="<?php echo site_url('cockpit/documents/index');?>">
		  <i class="fa  fa-check-square-o"></i> <span>Checklisten</span>
		</a>
	  </li>

	  <li class="noauth">
	 <a href="<?php echo site_url('cockpit/documents/index');?>">
		  <i class="fa  fa-bar-chart-o"></i> <span>Statistiken</span>
		</a>
	  </li>

	  <!-- 	<li>
			<a href="pages/widgets.html">
			  <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
			</a>
			</li>
	 <li class="treeview">
	 <a href="#">
	 <i class="fa fa-bar-chart-o"></i>
	 <span>Charts</span>
	 <i class="fa fa-angle-left pull-right"></i>
	 </a>
	 <ul class="treeview-menu">
	 <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
	 <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
	 <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
	 </ul>
	 </li>
	 <li class="treeview">			
	 <a href="#">
	 <i class="fa fa-laptop"></i>
	 <span>UI Elements</span>
	 <i class="fa fa-angle-left pull-right"></i>
	 </a>
	 <ul class="treeview-menu">
	 <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
	 <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
	 <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
	 <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
	 <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
	 </ul>
	 </li>
	 <li class="treeview">
	 <a href="#">
	 <i class="fa fa-edit"></i> <span>Forms</span>
	 <i class="fa fa-angle-left pull-right"></i>
	 </a>
	 <ul class="treeview-menu">
	 <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
	 <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
	 <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
	 </ul>
	 </li>
	 <li class="treeview">
	 <a href="#">
	 <i class="fa fa-table"></i> <span>Tables</span>
	 <i class="fa fa-angle-left pull-right"></i>
	 </a>
	 <ul class="treeview-menu">
	 <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
	 <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
	 </ul>
	 </li>
	 <li>
	 <a href="pages/calendar.html">
	 <i class="fa fa-calendar"></i> <span>Calendar</span>
	 <small class="badge pull-right bg-red">3</small>
	 </a>
	 </li>
	 <li>
	 <a href="pages/mailbox.html">
	 <i class="fa fa-envelope"></i> <span>Mailbox</span>
	 <small class="badge pull-right bg-yellow">12</small>
	 </a>
	 </li>
	 <li class="treeview">
	 <a href="#">
	 <i class="fa fa-folder"></i> <span>Examples</span>
	 <i class="fa fa-angle-left pull-right"></i>
	 </a>
	 <ul class="treeview-menu">
	 <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
	 <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
	 <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
	 <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
	 <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
	 <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
	 <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
	 </ul>
	 </li>
	 </ul> -->
</section>
<!-- /.sidebar -->
</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">

  <!-- Content Header (Page header) -->
  <section class="content-header">
	<h1>
	  Cockpit
	  <small>{{title}}</small>
	</h1>
	<ol class="breadcrumb">
	  {{breadcrumb}}
	</ol>
  </section>
  {{template:partials:aside}}

