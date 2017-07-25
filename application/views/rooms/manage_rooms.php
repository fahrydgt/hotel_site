<?php
	
	$result = array(
                        'id'=>"",
                        'room_name'=>"",
                        'short_name'=>"",
                        'tarrif_type_id'=>"",
                        'time_base_id'=>"",
                        'hotel_id'=>"",
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
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
             <?php echo form_open_multipart("Rooms/validate"); ?> 
   
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Name<span style="color: red">*</span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                             <?php echo form_input('room_name', set_value('room_name',$result['room_name']), 'id="room_name" class="form-control" placeholder="Enter Room Name"'.$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('room_name');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Short Name<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                             <?php echo form_input('short_name', set_value('short_name',$result['short_name']), 'id="short_name" class="form-control" placeholder="Enter Room Short Name"'.$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('short_name');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Hotel<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                           <?php  echo form_dropdown('hotel_id',$hotel_list,set_value('hotel_id',$result['hotel_id']),' class="form-control select2" data-live-search="true" id="hotel_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('hotel_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Tarrif Type<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                           <?php  echo form_dropdown('tarrif_type_id',$tarrif_type_list,set_value('tarrif_type_id',$result['tarrif_type_id']),' class="form-control select2" data-live-search="true" id="tarrif_type_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('tarrif_type_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Time Base<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                           <?php  echo form_dropdown('time_base_id',$time_base_list,set_value('time_base_id',$result['time_base_id']),' class="form-control select2" data-live-search="true" id="time_base_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('time_base_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Description<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                             <?php echo form_textarea(array('name'=>'description','rows'=>'4','cols'=>'60','id'=>'description', 'class'=>'form-control', 'placeholder'=>'Enter description' ),set_value('description',$result['description'],false),$dis.' '.$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('description');?></span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Facilities<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group"> <span class="input-group-addon"><span class="fa fa-cutlery"></span></span>
                                                           <?php  echo form_dropdown('facilities[]',$facilities_list,set_value('facilities[]', json_decode($result['facilities'])),' class="form-control  select2"  multiple="multiple"  data-live-search="true" id="facilities"'.$o_dis.'');?>
                                                             
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('facilities');?></span>
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