<?php
	
	$result = array(
                        'id'=>"",
                        'activity_event_name'=>"",
                        'short_name'=>"",
                        'tarrif_type_id'=>"",
                        'time_base_id'=>"",
                        'activity_id'=>"",
                        'description'=>"",
                        'facilities'=>"",
                        'status'=>"",
                        );   	
	
	  
//echo html_entity_decode($result['description']); die;
//var_dump($result);
?> 
<!-- Main content -->
 <br>
        <div class="col-md-12">
            
             <!--Flash Error Msg-->
                             <?php  if($this->session->flashdata('error') != ''){ ?>
					<div class='alert alert-danger ' id="msg2">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<i ></i>&nbsp;<?php echo $this->session->flashdata('error'); ?>
					<script>jQuery(document).ready(function(){jQuery('#msg2').delay(3000).slideUp(2000);});</script>
					</div>
				<?php } ?>
				
					<?php  if($this->session->flashdata('warn') != ''){ ?>
					<div class='alert alert-success ' id="msg2">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<i ></i>&nbsp;<?php echo $this->session->flashdata('warn'); ?>
					<script>jQuery(document).ready(function(){jQuery('#msg2').delay(3000).slideUp(2000);});</script>
					</div>
				<?php } ?>  
            <div class="">
                <a href="<?php echo base_url($this->router->fetch_class().'/add');?>" class="btn btn-app "><i class="fa fa-plus"></i>Create New</a>
                <a href="<?php echo base_url($this->router->fetch_class());?>" class="btn btn-app "><i class="fa fa-search"></i>Search</a>
                <!--<a class="btn btn-app "><i class="fa fa-trash"></i>Delete</a>-->
            </div>
        </div>
 <br><hr>
    <section  class="content"> 
        <div class="">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo '$action';?> </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
             <?php echo form_open_multipart("Activity_events/validate"); ?> 
   
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                            

                                        <div class="container">
                                                <div class="row form-group">
                                                <div class="col-xs-12">
                                                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                                                        <li class="active"><a href="#step-1">
                                                            <h4 class="list-group-item-heading">Step 1</h4>
                                                            <p class="list-group-item-text">First step description</p>
                                                        </a></li>
                                                        <li class="disabled"><a href="#step-2">
                                                            <h4 class="list-group-item-heading">Step 2</h4>
                                                            <p class="list-group-item-text">Second step description</p>
                                                        </a></li>
                                                        <li class="disabled"><a href="#step-3">
                                                            <h4 class="list-group-item-heading">Step 3</h4>
                                                            <p class="list-group-item-text">Third step description</p>
                                                        </a></li>
                                                        <li class="disabled"><a href="#step-4">
                                                            <h4 class="list-group-item-heading">Step 4</h4>
                                                            <p class="list-group-item-text">Second step description</p>
                                                        </a></li>    
                                                    </ul>
                                                </div>
                                                </div>
                                        </div>	

                                    <form class="container">

                                        <div class="row setup-content" id="step-1">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 well text-center">
                                                    <h1> STEP 1</h1>

                                    <!-- <form> -->               

                                        <div class="container col-xs-12">
                                            <div class="row clearfix">
                                                        <div class="col-md-12 col-md-offset-2 column">
                                                               <div class="col-md-8  box-body">
                                                                    <div class="form-group">
                                                                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                                                                      <div class="col-sm-10">
                                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                                                      </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                                                      <div class="col-sm-10">
                                                                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                                                      </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <div class="col-sm-offset-2 col-sm-10">
                                                                        <div class="checkbox">
                                                                          <label>
                                                                            <input type="checkbox"> Remember me
                                                                          </label>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                        </div>
                                                </div>
                                               
                                        </div>

                                    <!-- </form> -->

                                                    <button id="activate-step-2" class="btn btn-primary btn-md">Activate Step 2</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <form class="container">

                                        <div class="row setup-content" id="step-2">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 well text-center">
                                                    <h1 class="text-center"> STEP 2</h1>

                                    <!--<form></form> --> 

                                                    <button id="activate-step-3" class="btn btn-primary btn-md">Activate Step 3</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <form class="container">

                                        <div class="row setup-content" id="step-3">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 well text-center">
                                                    <h1 class="text-center"> STEP 3</h1>

                                    <!--<form></form> --> 

                                                    <button id="activate-step-4" class="btn btn-primary btn-md">Activate Step 4</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <form class="container">

                                        <div class="row setup-content" id="step-4">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 well text-center">
                                                    <h1 class="text-center"> STEP 4</h1>

                                    <!--<form></form> -->                

                                                </div>
                                            </div>
                                        </div>

                                    </form>



                        </div>
                    </div>
                          <!-- /.box-body -->

                    <div class="box-footer">
                          <!--<butto style="z-index:1" n class="btn btn-default">Clear Form</button>-->                                    
                                    <!--<button class="btn btn-primary pull-right">Add</button>-->  
                                   
                      <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                    </div>
                  </form>
                </div>
                <!-- /.box -->
          </div> 
    </section> 
 
<script>
    
     
// Activate Next Step

$(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
});


// Add , Dlelete row dynamically

     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='sur"+i+"' type='text' placeholder='Surname'  class='form-control input-md'></td><td><input  name='email"+i+"' type='text' placeholder='Email'  class='form-control input-md'></td><td><select type='text' name='gender"+i+"' class='form-control'><option name='male"+i+"' value='male'>Male</option><option name='Female"+i+"' value='Female'>Female</option><option name='3rdgen"+i+"' value='none'>None</option></select></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});


</script>