<aside class="left-side sidebar-offcanvas">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      


      <?php

$sidenav = new $this->navigation();        

$sidenav->load('sidebar');
if($this->session->userdata('contact_complete') == 1  && $this->current_user->group == 'user')
{
    $sidenav->append('dokumente','<small class="badge pull-right bg-green">1</small>');
}

echo $sidenav->get_entries();
      ?>
      
    </ul> 
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
