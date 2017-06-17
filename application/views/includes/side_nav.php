<?php 
     	$CI =& get_instance(); 				
	$user_group =  $this->session->userdata('user_role_ID'); //'ADMIN';
        $navigation = $this->user_default_model->get_user_menu_navigation($user_group); 
//        echo '<pre>'; print_r($CI->router->class); die;
      
        ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo SAMPLE_PIC.'download.jpg'?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Fahry Lafir</p>
          <a href="#"><i class="fa fa-circle text-success"></i> SE</a>
        </div>
      </div>
      <!-- search form -->
<!--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
<!--        <li class="active">
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>-->
       <?php
//               echo '<pre>';               print_r($navigation); die;
            foreach ($navigation as $nav1){
                
                $has_nav2 = (empty($nav1->subnav))?'hidden':'';
                $treeview2 = (!empty($nav1->subnav))?'treeview':'';
                $nav_actv = ($CI->router->class == $nav1->page_id)?'active':'';
                echo '<li class="'.$treeview2.' '.$nav_actv.' ">
                        <a href="'.base_url($nav1->page_id).'">
                          <i class="'.$nav1->img_class.'"></i> <span>'.$nav1->module_name.'</span>
                          <span class="pull-right-container" '.$has_nav2.'>
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>';
                
                        //nav level 2
                        if((!empty($nav1->subnav))){
                            echo '<ul class="treeview-menu">';
                            foreach ($nav1->subnav as $nav2){
                                $has_nav3 = (empty($nav2->subnav))?'hidden':'';
                                $treeview3 = (!empty($nav2->subnav))?'treeview':'';
                                $nav_actv = ($CI->router->class == $nav2->page_id)?'active':'';
                                echo '<li class="'.$treeview3.' '.$nav_actv.'">
                                          <a href="'.base_url($nav2->page_id).'"><i class="'.$nav2->img_class.'"></i> '.$nav2->module_name.'
                                            <span class="pull-right-container" '.$has_nav3.'>
                                              <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                          </a>'; 
                               
                                          //nav level 3
                                            if((!empty($nav2->subnav))){
                                                echo '<ul class="treeview-menu"> ';
                                                foreach ($nav2->subnav as $nav3){
                                                    $nav_actv = ($CI->router->class == $nav3->page_id)?'active':'';
                                                    echo '<li class="'.$nav_actv.'">
                                                              <a href="'.base_url($nav3->page_id).'"><i class="'.$nav3->img_class.'"></i> '.$nav3->module_name.'</a> 
                                                            </li>';
                                                }
                                                echo '</ul>';
                                            }
                                
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                
                echo '</li>';
            }
       ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>