<?php
	
	$result = array(
                        'id'=>"",
                        'hotel_id'=>1, 
                        'date_from'=> strtotime(date('Y-m-d')),
                        'date_to'=> strtotime('tomorrow'),
                        'agent_id'=>2,
                        'market_id'=>1,
        
                        'time_base_id'=>"",
                        'activity_id'=>"",
                        'description'=>"",
                        'facilities'=>"",
                        'status'=>"",
                        );   	
	
	 
	switch($action):
	case 'Add':
		$heading	= 'Add';
		$dis		= '';
		$view		= '';
		$o_dis		= ''; 
	break;
	
	case 'Edit':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'Edit';
		$dis		= '';
		$view		= '';
		$o_dis		= ''; 
	break;
	
	case 'Delete':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'Delete';
		$dis		= 'readonly';
		$view		= '';
		$o_dis		= ''; 
		$check_bx_dis		= 'disabled'; 
	break;
      
	case 'View':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'View';
		$view		= 'hidden';
		$dis        = 'readonly';
		$o_dis		= 'disabled'; 
	break;
endswitch;	 
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
                  <h3 class="box-title"><?php echo $action;?> </h3>
                  <div class="container">
                                                <div class="row form-group ">
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
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
             <?php // echo form_open_multipart("Bookings/validate"); ?> 
   
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                                  

                             <?php echo form_open("", 'id="step1_form" class="form-horizontal"')?>  

                                        <div class="row setup-content" id="step-1">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 well text-center">
                                                    <h3> Check Availablity [1] </h3>

                                    <!-- <form> -->               

                                        <div class="container col-xs-12">
                                            <div class="row clearfix">
                                                        <div class="col-md-12 col-md-offset-2 column">
                                                               <div class="col-md-8  box-body">
                                                                    <div class="form-group">
                                                                        <label for="inputEmail3" class="col-sm-2 control-label">Hotel</label>
                                                                        <div class="col-sm-10">
                                                                              <?php  echo form_dropdown('hotel_id',$hotel_list,set_value('hotel_id',$result['hotel_id']),' class="form-control select2" data-live-search="true" id="hotel_id"'.$o_dis.'');?>
                                                                        </div>
                                                                        <span class="help-block"><?php echo form_error('hotel_id');?></span>

                                                                    </div>                                  
                                                                </div>
                                                               <div class="col-md-8  box-body">
                                                                    <div class="form-group">
                                                                        <label for="date_from" class="col-sm-2 control-label">Check-in</label>
                                                                        <div class="col-sm-4">
                                                                            <?php echo form_input('date_from', set_value('date_from',date('m/d/Y',$result['date_from'])), 'id="date_from" class="input-lg form-control datepicker" readonly placeholder="Select Date"'.$dis.' '.$o_dis.' '); ?>
                                                                            <span class="help-block"><?php echo form_error('date_from');?></span>
                                                                        </div>
                                                                        <label for="date_to" class="col-sm-2 control-label">Check-out</label>
                                                                        <div class="col-sm-4">
                                                                            <?php echo form_input('date_to', set_value('date_to',date('m/d/Y',$result['date_to'])), 'id="date_to" class="input-lg form-control datepicker" readonly placeholder="Select Date"'.$dis.' '.$o_dis.' '); ?>
                                                                            <span class="help-block"><?php echo form_error('date_to');?></span>
                                                                        </div>                                            
                                                                    </div>
                                                                     
                                                                </div>
                                                                <div class="col-md-8  box-body">
                                                                    <div class="form-group">
                                                                        <label for="agent_id" class="col-sm-2 control-label">Agent:</label>
                                                                        <div class="col-sm-10">
                                                                              <?php  echo form_dropdown('agent_id',$agent_list,set_value('agent_id',$result['agent_id']),' class="form-control select2" data-live-search="true" id="agent_id"'.$o_dis.'');?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-8  box-body">
                                                                    <div class="form-group">
                                                                        <label for="market_id" class="col-sm-2 control-label">Market</label>
                                                                        <div class="col-sm-10">
                                                                              <?php  echo form_dropdown('market_id',$market_list,set_value('market_id',$result['market_id']),' class="select2 form-control " data-live-search="true" id="market_id"'.$o_dis.'');?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        </div>
                                                </div>
                                               
                                        </div>

                                  

                                                    <a id="activate-step-2" class="btn btn-primary btn-md pull-right">Step 2</a>
                                                </div>
                                            </div>
                                        </div>
                                 <!--</form>--> 
                                 <?php echo form_close();?>

                                    <form class="container">

                                        <div class="row setup-content  " id="step-2">
                                            <div class="col-xs-12">
                                                <div class="col-md-12 ">
                                                    <!--<h2 class="text-center"> STEP 2</h2>-->
                                                    <div class="row"> 
                                                         <div id="step2_res"> 
                                                            </div>
                                                       
                                                    </div>      
                                                    
                                    <!--<form></form> --> 

                                                    <button id="activate-step-3" class="btn btn-primary btn-md pull-right">Activate Step 3</button>
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
                                    <?php if($action != 'View'){?>
                                    <?php echo form_hidden('id', $result['id']); ?>
                                    <?php echo form_hidden('action',$action); ?>
                                    <?php echo form_submit('submit',$action ,'class="btn btn-primary"'); ?>&nbsp;

                                    <?php echo anchor(site_url($this->router->fetch_class()),'Back','class="btn btn-info"');?>&nbsp;
                                    <?php echo form_reset('reset','Reset','class = "btn btn-default"'); ?>

                                 <?php }else{ 
                                        echo form_hidden('action',$action);
                                        echo anchor(site_url($this->router->fetch_class()),'OK','class="btn btn-primary"');
                                    } ?>
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
        step_one_submit();
//        $(this).remove();
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
    
    
    //add delete row dynamically
    
    $(".add_element_custom").on("click", function() {
        var rowCount = $('.room_custom_table tr').length;

//        alert(rowCount);  
        var counter = rowCount+1;
        event.preventDefault(); 
        var newRow = jQuery('<tr style="padding:10px" id="tr_'+rowCount+'">'+'<td>Customization '+rowCount+'</td><td><select><option>Delux Double</option></select></td><td><select><option>Delux Triple</option></select></td><td>2</td><td> '+'<button id="del_btn" type="button" class="del_btn_custom_room btn btn-danger"><i class="fa fa-trash"></i></button> '+'</td></tr>');

        jQuery('table.room_custom_table').append(newRow);

        $('.del_btn_custom_room').click(function(){      
            $(this).closest('tr').remove(); 
        });
    });
    
    function step_one_submit(){
        $.ajax({
			url: "<?php echo site_url('Bookings/step1');?>",
			type: 'post',
			data : jQuery('#step1_form').serializeArray(),
			success: function(result){
                             $("#step2_res").html(result); 
                             $(".dataTable").DataTable();
                        }
		});
	}
});

 


</script>