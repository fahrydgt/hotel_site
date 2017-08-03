<?php
	
	$result = array(
                        'id'=>"",
                        'season_name'=>"",
                        'date_from'=>strtotime(date('m/d/Y')),
                        'date_to'=>strtotime('+1 months',strtotime(date('m/d/Y'))),
                        'short_name'=>"",
                        'tarrif_type_id'=>"",
                        'time_base_id'=>1,
                        'currency_id'=>"LKR",
                        'activity_id'=>"",
                        'description'=>"",
                        'facilities'=>"",
                        'status'=>1,
                        'price_all'=>"",
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

$result['price'] = json_decode($result['price_all'],TRUE)
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
              
             <?php echo form_open_multipart("Activity_rates/validate"); ?> 
   
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                            
                            <div class="col-md-12"><h4>Informaton</h4></div> 
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Season Name<span style="color: red">*</span></label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                             <?php echo form_input('season_name', set_value('season_name',$result['season_name']), 'id="season_name" class="form-control" placeholder="Enter Room Name"'.$dis.' '.$o_dis.' '); ?>
                                        </div>                                            
                                        <span class="help-block"><?php echo form_error('season_name');?></span>
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
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date from<span style="color: red">*</span></label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                             <?php echo form_input('date_from', set_value('date_from',date('m/d/Y',$result['date_from'])), 'id="date_from" class="form-control datepicker" readonly placeholder="Select Date"'.$dis.' '.$o_dis.' '); ?>
                                        </div>                                            
                                        <span class="help-block"><?php echo form_error('date_from');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date to<span style="color: red">*</span></label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                             <?php echo form_input('date_to', set_value('date_to',date('m/d/Y',$result['date_to'])), 'id="date_to" class="form-control datepicker" readonly placeholder="Select Date"'.$dis.' '.$o_dis.' '); ?>
                                        </div>                                            
                                        <span class="help-block"><?php echo form_error('date_to');?></span>
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
                            <hr>
                        <div class="row"> 
                            <div class="col-md-12"><h4>Activity Price Plan</h4></div> 
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Activity Place<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-list"></span></span>
                                                           <?php  echo form_dropdown('activity_id',$activity_list,set_value('activity_id',$result['activity_id']),' class="form-control select2" data-live-search="true" id="activity_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('activity_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Tarrif Type<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-list"></span></span>
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
                                                          <span class="input-group-addon"><span class="fa fa-list"></span></span>
                                                           <?php  echo form_dropdown('time_base_id',$time_base_list,set_value('time_base_id',$result['time_base_id']),' class="form-control select2" data-live-search="true" id="time_base_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('time_base_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>    
                                             <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Currency<span style="color: red">*</span></label>
                                                  <div class="col-md-9">                                            
                                                      <div class="input-group">
                                                          <span class="input-group-addon"><span class="fa fa-list"></span></span>
                                                           <?php  echo form_dropdown('currency_id',$currency_list,set_value('currency_id',$result['currency_id']),' class="form-control select2" data-live-search="true" id="currency_id"'.$o_dis.'');?>
                                                       </div>                                            
                                                      <span class="help-block"><?php echo form_error('currency_id');?>&nbsp;</span>
                                                  </div>
                                              </div>
                                            </div>    
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2 control-label">Rates for Activity<span style="color: red">*</span></label>
                                    <div class="col-md-9">    
                                        <?php // echo '<pre>'; print_r($result);?>
                                        <table class="table-bordered" width="400px;">
                                            <tr>
                                                <th>Mealplan</th>
                                                <th> Rates (LKR)</th>
                                            </tr>
                                            <?php
                                                    foreach ($activity_price_cat_list as $apc_key=>$activity_price_cat){
                                                        echo '<tr>
                                                                <td width="40%">'.$activity_price_cat.':</td>
                                                                <td width="60%"> '.form_input('price['.$apc_key.'][amount]', set_value('price['.$apc_key.'][amount]',$result['price'][$apc_key]['amount']), 'id="price['.$apc_key.'][amount]" class="form-control currency_field" placeholder="Enter Price for '.$activity_price_cat.'"'.$dis.' '.$o_dis.' ').form_error('price['.$apc_key.'][amount]').' </td>
                                                              </tr>     ';
                                                    }
                                            ?> 
                                        </table>
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
     $(".currency_field").on("keyup", function(){
            var valid = /^\d{0,15}(\.\d{0,2})?$/.test(this.value),
            val = this.value;

            if(!valid){
                console.log("Invalid currency input!");
                this.value = val.substring(0, val.length - 1);
            }
        });
//    $("input[name='submit']").click(function(){ 
//        alert();
//        return false;
//    });
});
</script>