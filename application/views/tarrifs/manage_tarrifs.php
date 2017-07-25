<?php
	
	$result = array(
                        'id'=>"",
                        'tarrif_type_name'=>"",
                        'category_id'=>"",
                        'short_name'=>"",
                        'description'=>"",
                        'max_adult'=>"0",
                        'base_adult'=>"0",
                        'max_child'=>"0",
                        'base_child'=>"0",
                        'over_booking_percentage'=>"",
                        'status'=>"1",
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

//echo '<pre>';print_r($result);
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
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
             <?php echo form_open_multipart("Tarrifs/validate"); ?> 
   
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Tarrif Type Name<span style="color: red">*</span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                             <?php echo form_input('tarrif_name', set_value('tarrif_name',$result['tarrif_type_name']), 'id="tarrif_name" class="form-control" placeholder="Enter Tarrif Name"'.$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('tarrif_name');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Short Name<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                             <?php echo form_input('short_name', set_value('short_name',$result['short_name']), 'id="short_name" class="form-control" placeholder="Enter Short Name"'.$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('short_name');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Category<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                           <?php  echo form_dropdown('category_id',$tarrif_list,set_value('category_id',$result['category_id']),' class="form-control select2" data-live-search="true" id="category_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('category_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>
                                          
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Description<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                             <?php echo form_textarea(array('name'=>'description','rows'=>'4','cols'=>'60','id'=>'description', 'class'=>'form-control', 'placeholder'=>'Enter description' ),set_value('description',$result['description']),$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('description');?></span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <h4>Capacity</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label class="col-md-7 control-label">Adult Count(Max)<span style="color: red"></span></label>
                                                         <div class="col-md-5">                                            
                                                             <div class="input-group">
                                                                 <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                                                  <?php echo form_input('max_adult', set_value('max_adult',$result['max_adult']), 'id="max_adult" class="form-control" placeholder="Maximum"'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                             <span class="help-block"><?php echo form_error('max_adult');?></span>
                                                         </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label class="col-md-7 control-label">Base Adult Count<span style="color: red"></span></label>
                                                         <div class="col-md-5">                                            
                                                             <div class="input-group">
                                                                 <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                                                  <?php echo form_input('base_adult', set_value('base_adult',$result['base_adult']), 'id="base_adult" class="form-control" placeholder="Enter Minimum "'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                             <span class="help-block"><?php echo form_error('base_adult');?></span>
                                                         </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label class="col-md-7 control-label">Child Count(Max)<span style="color: red"></span></label>
                                                         <div class="col-md-5">                                            
                                                             <div class="input-group">
                                                                 <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                                                  <?php echo form_input('max_child', set_value('max_child',$result['max_child']), 'id="max_child" class="form-control" placeholder="Enter Maximum"'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                             <span class="help-block"><?php echo form_error('max_child');?></span>
                                                         </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                         <label class="col-md-7 control-label">Base Adult Count<span style="color: red"></span></label>
                                                         <div class="col-md-5">                                            
                                                             <div class="input-group">
                                                                 <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                                                  <?php echo form_input('base_child', set_value('base_child',$result['base_child']), 'id="base_child" class="form-control" placeholder="Enter Minimum "'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                             <span class="help-block"><?php echo form_error('base_child');?></span>
                                                         </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Over Booking (%)<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                             <?php echo form_input('over_booking_percentage', set_value('over_booking_percentage',$result['over_booking_percentage']), 'id="over_booking_percentage" class="form-control" placeholder="Enter Percentage"'.$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('over_booking_percentage');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                             <label class="switch  switch-small">
                                                                <!--<input type="checkbox"  value="0">-->
                                                                <?php echo form_checkbox('status', set_value('status','1'),$result['status'], 'id="status" placeholder=""'.$dis.' '.$o_dis.' '); ?>
                                                                <span></span>
                                                            </label>
                                                         </div>                                            
                                                        <span class="help-block"><?php echo form_error('status');?>&nbsp;</span>
                                                    </div>
                                                </div> 
                                            </div>
                                        
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
    
$(document).ready(function(){  
    
    $('#icon_view').addClass($('#icon').val());
    $("#icon").keyup(function(){ 
//		alert();
                $('#icon_view').removeClass();
                $('#icon_view').addClass($('#icon').val());
    });
});
</script>