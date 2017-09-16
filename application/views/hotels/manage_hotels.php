<?php
	
	$result = array(
                        'id'=>"",
                        'hotel_id'=>"",
                        'hotel_name'=>"",
                        'title'=>"",
                        'description'=>"",
                        'tags'=>"",
                        'street_address'=>"",
                        'city'=>"",
                        'state'=>"",
                        'country'=>"",
                        'zipcode'=>"",
                        'phone'=>"",
                        'fax'=>"",
                        'other_phone'=>"",
                        'email'=>"",
                        'website'=>"",
                        'hotel_type'=>"",
                        'hotel_grade'=>"",
                        'reg_no'=>"",
                        'logo'=>"default.jpg",
                        'status'=>"",
            
                        'first_name'=>"", 
                        'last_name' => "", 
                        'admin_email' => "",
                        'admin_contact' => "",
                        'admin_username' => "",
                        'password' => "",
                        'confirm_password' => "",
                        'user_role_id' => "",
                        'status' => "",
                        "pic"=> 'default.jpg',
            
                        'check_in' => 1500445800,
                        'check_out' => 1500445800,
                        'facilities' => "",
                        'property_surroundings' => "",
                        'policy' => "",
            
                        'default_image' => 'default.jpg',
                        'images' => "",
                        );   	
	 	
	
	 $hide_spec='';
	switch($action):
	case 'Add':
                $result['payments_policy'] = (isset($_POST['policy']))?$_POST['policy']:'';
                $result['pets'] = (isset($_POST['pets']))?$_POST['pets']:'';
		$heading	= 'Add';
		$dis		= '';
		$view		= '';
		$o_dis		= ''; 
	break;
	
	case 'Edit':
		if(!empty($user_data[0])){$result= $user_data[0];}
                $result['payments_policy'] = json_decode($result['payments_policy'],true);
                $result['pets'] = json_decode($result['pets'],true);
		$heading	= 'Edit';
		$dis		= '';
		$view		= '';
		$o_dis		= ''; 
		$hide_spec	= 'hidden'; 
                
                
	break;
	
	case 'Delete':
		if(!empty($user_data[0])){$result= $user_data[0];} 
                $result['payments_policy'] = json_decode($result['payments_policy'],true);
                $result['pets'] = json_decode($result['pets'],true);
		$heading	= 'Delete';
		$dis		= 'readonly';
		$view		= '';
		$o_dis		= ''; 
		$check_bx_dis		= 'disabled'; 
	break;
      
	case 'View':
		if(!empty($user_data[0])){$result= $user_data[0];} 
                $result['payments_policy'] = json_decode($result['payments_policy'],true);
                $result['pets'] = json_decode($result['pets'],true);
		$heading	= 'View';
		$view		= 'hidden';
		$dis        = 'readonly';
		$o_dis		= 'disabled'; 
	break;
endswitch;	 
//                echo '<pre>';print_r(($result['images']));
        
            // add files to our array with
            // made to use the correct structure of a file
            if($result['images'] != null && isset($result['images']) && $result['images'] != 'null'){
                foreach(json_decode($result['images']) as $file) {
                        // skip if directory
                        if(is_dir($file))
                                continue; 
                        // add file to our array
                        // !important please follow the structure below
                        $appendedFiles[] = array(
                                                "name" => $file,
                                                "type" => get_mime_by_extension(HOTEL_IMAGES.$result['hotel_id'].'/'.$file),
                                                "size" => filesize(HOTEL_IMAGES.$result['hotel_id'].'/'.$file),
                                                "file" => base_url(HOTEL_IMAGES.$result['hotel_id'].'/'.$file),
                                                "data" => array(  "url" => base_url(HOTEL_IMAGES.$result['hotel_id'].'/'.$file)
                                            )
                        ); 
                }

                // convert our array into json string
                $result['images'] = json_encode($appendedFiles);
            }
//            echo '<pre>';            print_r($appendedFiles); die;
?> 
<style>
    .policy_tbl td, .pets_tbl  td{
        padding: 5px;
    }
</style>
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
                <?php echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'add'))?'<a href="'.base_url($this->router->fetch_class().'/add').'" class="btn btn-app "><i class="fa fa-plus"></i>Create New</a>':''; ?>
                <?php echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'index'))?'<a href="'.base_url($this->router->fetch_class()).'" class="btn btn-app "><i class="fa fa-search"></i>Search</a>':''; ?>
                <?php echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'delete'))?'<a href="'.base_url($this->router->fetch_class().'/delete/'.$result['hotel_id']).'" class="btn btn-app "><i class="fa fa-trash"></i>Delete</a>':''; ?>
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
              
             <?php echo form_open_multipart("Hotels/validate"); ?> 
   
                    <div class="box-body ">
                              
                        <div class="row"> 
                            
                            <div class="col-md-12">
                                 <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li> 
                                    <li><a href="#tab_3" data-toggle="tab">Rules/Payments</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Images</a></li> 

                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                  </ul>
                                  <div class="tab-content fl_scroll">
                                      <div class="tab-pane active" id="tab_1"> 
                                              <div class="row"> 
                                                        <div class="col-md-12">
                                                                  <h4>Hotel Information</h4>
                                                                  <hr>
                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Hotel Name<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('hotel_name', set_value('hotel_name',$result['hotel_name']), 'id="hotel_name" class="form-control" placeholder="Enter Hotel Name"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('hotel_name');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Title<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('title', set_value('title',$result['title']), 'id="title" class="form-control" placeholder="Enter Hotel title"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('title');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12"><br>
                                                                      <div class="form-group">
                                                                          <label class="col-md-1 control-label">Description<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group" style="padding-left: 50px;"> 
                                                                                        <?php echo form_textarea(array('name'=>'description','rows'=>'4','cols'=>'120','id'=>'description', 'class'=>'textarea_editor form-control', 'placeholder'=>'Enter description' ),set_value('description',$result['description'],false),$dis.' '.$o_dis.' '); ?>
                                                                            </div>                                            
                                                                              <span class="help-block"><?php echo form_error('description');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Tags<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('tags', set_value('tags',$result['title']), 'id="tags" class="form-control" placeholder="Enter tags"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('tags');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                                <h4>Contact Information</h4>
                                                                <hr>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Street Address<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('street_address', set_value('street_address',$result['street_address']), 'id="street_address" class="form-control" placeholder="Enter Street Address"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('street_address');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">City<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('city', set_value('city',$result['city']), 'id="city" class="form-control" placeholder="Enter city"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('city');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">State</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('state', set_value('state',$result['state']), 'id="state" class="form-control" placeholder="Enter State"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('state');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">Country<span style="color: red">*</span></label>
                                                                        <div class="col-md-9">                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                 <?php  echo form_dropdown('country',$country_list,set_value('country',$result['country']),' class="form-control select2" data-live-search="true" id="country"'.$o_dis.'');?>
                                                                             </div>                                            
                                                                            <span class="help-block"><?php echo form_error('country');?>&nbsp;</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Zip Code</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('zipcode', set_value('zipcode',$result['zipcode']), 'id="zipcode" class="form-control" placeholder="Enter Zip Code" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('zipcode');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Phone<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('phone', set_value('phone',$result['phone']), 'id="phone" class="form-control" placeholder="Enter Phone Number" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('phone');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Fax</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('fax', set_value('fax',$result['fax']), 'id="fax" class="form-control" placeholder="Enter Fax Number" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('fax');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Other Phone</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('other_phone', set_value('other_phone',$result['other_phone']), 'id="other_phone" class="form-control" placeholder="Enter Secendory Phone Number.." style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('other_phone');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Email</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('email', set_value('email',$result['email']), 'id="email" class="form-control" placeholder="Enter Company Email Address.." style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('email');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Web site</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('website', set_value('website',$result['website']), 'id="website" class="form-control" placeholder="Enter Website URL.." style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('website');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-12">
                                                                  <h4>Other Information</h4> 
                                                                          <hr>
                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Hotel type<span style="color: red">*</span></label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('hotel_type', set_value('hotel_type',$result['hotel_type']), 'id="hotel_type" class="form-control" placeholder="Enter Company Type" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('hotel_type');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Hotel Grade</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('hotel_grade', set_value('hotel_grade',$result['hotel_grade']), 'id="hotel_grade" class="form-control" placeholder="Eg: 3 Star" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('hotel_grade');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Registration No</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input('reg_no', set_value('reg_no',$result['reg_no']), 'id="reg_no" class="form-control" placeholder="Enter registraion Number" style="z-index: 1;"'.$dis.' '.$o_dis.' '); ?>

                                                                              </div>                                            
                                                                              <span class="help-block"><?php echo form_error('reg_no');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Hotel Logo</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input(array('name'=>'logo', 'id'=>'logo', 'class'=>'form-control', 'type'=>'file'));?>

                                                                              </div>    
                                                                              <div><img style="size: 100%; width:100px;"  src="<?php echo base_url().HOTEL_LOGO.$result['hotel_id'].'/'.$result['logo'];?>"></div>
                                                                              <span class="help-block"><?php echo form_error('logo');?></span>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6">
                                                                      <div class="form-group">
                                                                          <label class="col-md-3 control-label">Company Active</label>
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

                                      </div>
                                  
                                      <div class="tab-pane" id="tab_3"> 
                                         <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Check-in Time<span style="color: red">*</span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                           <?php echo form_input('check_in', set_value('check_in',date('H:s A',$result['check_in'])), 'id="check_in" class="form-control timepicker" placeholder="Enter Hotel Check in Time"'.$dis.' '.$o_dis.' '); ?>
                                                             <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                             
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('check_in');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Check-out Time<span style="color: red">*</span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group"> 
                                                             <?php echo form_input('check_out', set_value('check_out',date('H:s A',$result['check_out'])), 'id="check_out" class="form-control timepicker" placeholder="Enter Hotel Check Out Time"'.$dis.' '.$o_dis.' '); ?>
                                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('check_out');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                 <hr>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Payments & Cancellation Policy<span style="color: red"></span></label>
                                                        <div class="col-md-10  input-group">  
                                                            <table class="policy_tbl table-bordered">
                                                                <?php
                                                                    if(isset($result['payments_policy']) && count($result['payments_policy'])>1){
                                                                        $policy_qty = 0;
                                                                        foreach ($result['payments_policy'] as $key_policy=>$policy_1){
                                                                            $policy_qty++;
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo form_input('policy['.$key_policy.'][title]', set_value('policy['.$key_policy.'][title]',$policy_1['title']), 'id="check_out" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                                <td><?php echo form_textarea(array('name'=>'policy['.$key_policy.'][description]','rows'=>'4','cols'=>'120','id'=>'policy['.$key_policy.'][description]', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('policy['.$key_policy.'][description]',$policy_1['description']),$dis.' '.$o_dis.' '); ?></td>
                                                                                <td>
                                                                                    <?php if($policy_qty==1){?><button id="add_element" type="button" class="btn btn-info pull-right add_element_policy"><i class="fa fa-plus"></i></button><?php }?>
                                                                                    <?php if($policy_qty>1){?><button id="del_btn" type="button" class="del_btn_policy btn btn-danger"><i class="fa fa-trash"></i></button><?php }?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }else{
                                                                        ?>
                                                                            
                                                                            <tr>
                                                                                <td><?php echo form_input('policy[0][title]', set_value('policy[0][title]'), 'id="check_out" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                                <td><?php echo form_textarea(array('name'=>'policy[0][description]','rows'=>'4','cols'=>'120','id'=>'policy[0][description]', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('policy[0][description]'),$dis.' '.$o_dis.' '); ?></td>
                                                                                <td><button id="add_element" type="button" class="btn btn-info pull-right add_element_policy"><i class="fa fa-plus"></i></button></td>

                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </table> 
                                                        </div>
                                                    </div>
                                                </div>
                                             <div class="col-md-12">
                                                 <hr>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Pets<span style="color: red"></span></label>
                                                        <div class="col-md-10  input-group">  
                                                            <table class="pets_tbl table-bordered">
                                                                 <?php
                                                                    if(isset($result['pets']) && !empty($result['pets'])){
                                                                        $pets_qty=0;
                                                                        foreach ($result['pets'] as $key_pets=>$pets_1){
                                                                            $pets_qty++;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo form_input('pets['.$key_pets.'][title]', set_value('pets['.$key_pets.'][title]',$pets_1['title']), 'id="pets['.$key_pets.'][title]" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                                    <td><?php echo form_textarea(array('name'=>'pets['.$key_pets.'][description]','rows'=>'4','cols'=>'120','id'=>'pets['.$key_pets.'][description]', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('pets['.$key_pets.'][description]',$pets_1['description']),$dis.' '.$o_dis.' '); ?></td>
                                                                                    <td>
                                                                                        <?php if($pets_qty==1){?><button id="add_element" type="button" class="btn btn-info pull-right add_element_pets"><i class="fa fa-plus"></i></button><?php }?>
                                                                                        <?php if($pets_qty>1){?><button id="del_btn" type="button" class="del_btn_pets btn btn-danger"><i class="fa fa-trash"></i></button> <?php }?>
                                                                                    </td>
                                                                                </tr> 
                                                                            <?php
                                                                            }
                                                                    }else{
                                                                        ?>
                                                                            
                                                                           <tr>
                                                                                <td><?php echo form_input('pets[0][title]', set_value('pets[0][title]'), 'id="title_pets" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                                <td><?php echo form_textarea(array('name'=>'pets[0][description]','rows'=>'4','cols'=>'120','id'=>'pets[0][description]', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('pets[0][description]'),$dis.' '.$o_dis.' '); ?></td>
                                                                                <td> <button id="add_element" type="button" class="btn btn-info pull-right add_element_pets"><i class="fa fa-plus"></i></button></td>
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                
                                                            </table> 
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                          <div class="row"> 
                                              <br>
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
                                                    <label class="col-md-3 control-label">Properies Surrounding<span style="color: red"></span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-university"></span></span>
                                                           <?php  echo form_dropdown('property_surroundings[]',$property_sur_list,set_value('property_surroundings[]', json_decode($result['property_surroundings'])),' class="form-control  select2"  multiple="multiple"  data-live-search="true" id="property_surroundings"'.$o_dis.'');?>
                                                             
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('property_surroundings[]');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_4">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Default Picture</label>
                                                <div class="col-md-6">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                         <?php // echo form_input(array('name'=>'pic1[]', 'multiple'=>'multiple','id'=>'pic1', 'class'=>'form-control fl_file', 'type'=>'file'));?>
                                                        <?php echo form_input(array('name'=>'hotel_default_pic','id'=>'hotel_default_pic', 'class'=>'form-control fl_file', 'type'=>'file'));?>
                                                    </div>    
                                                    <span class="help-block"><?php echo form_error('hotel_default_pic');?></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(HOTEL_IMAGES.$result['hotel_id'].'/'.$result['default_image']); ?>" alt="User profile picture">
                                                </div>
                                            </div>
                                        </div>
                                           <div class="col-md-12">
                                               <br>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">All Images</label>
                                                    <div class="col-md-9">                                            
                                                           
                                                        <div class="fl_file_uploader2">
                                                            <input type="file" name="hotel_images" class="fl_files" data-fileuploader-files='<?php echo $result['images'];?>'> 
                                                        </div> 
                                                        <span class="help-block"><?php echo form_error('hotel_images');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                      <!-- /.tab-pane --> 
                                  </div>
                                  <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
                            </div>
                            
                                             
                                            
                                        
                        </div>
                    </div>
                          <!-- /.box-body -->

                    <div class="box-footer">
                          <!--<butto style="z-index:1" n class="btn btn-default">Clear Form</button>-->                                    
                                    <!--<button class="btn btn-primary pull-right">Add</button>-->  
                                    <?php if($action != 'View'){?>
                                    <?php echo form_hidden('id', $result['hotel_id']); ?>
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

$(".add_element_policy").on("click", function() {
    var rowCount = $('.policy_tbl tr').length;
    
    alert(rowCount);
    var counter = rowCount+1;
    event.preventDefault(); 
    var newRow = jQuery('<tr style="padding:10px" id="tr_'+rowCount+'">'+'<td><div class="input-group"><input type="text" name="policy['+rowCount+'][title]" id="policy['+rowCount+'][title]" class="form-control" placeholder="Enter Title"></div></td>'+'<td><div class="input-group"><textarea name="policy['+rowCount+'][description]" cols="120" rows="4" id="policy['+rowCount+'][description]" class=" form-control" placeholder="Enter description"></textarea></div></td> <td> '+'<button id="del_btn" type="button" class="del_btn_policy btn btn-danger"><i class="fa fa-trash"></i></button> '+'</td></tr>');

    jQuery('table.policy_tbl').append(newRow);
    
    $('.del_btn_policy').click(function(){      
        $(this).closest('tr').remove(); 
    });
});

$(".add_element_pets").on("click", function() {
    var rowCount = $('.pets_tbl tr').length;
    
    alert(rowCount);
    var counter = rowCount+1;
    event.preventDefault(); 
    var newRow = jQuery('<tr style="padding:10px" id="tr_'+rowCount+'">'+'<td><div class="input-group"><input type="text" name="pets['+rowCount+'][title]" id="pets['+rowCount+'][title]" class="form-control" placeholder="Enter Title"></div></td>'+'<td><div class="input-group"><textarea name="pets['+rowCount+'][description]" cols="120" rows="4" id="pets['+rowCount+'][description]" class=" form-control" placeholder="Enter description"></textarea></div></td> <td> '+'<button id="del_btn" type="button" class="del_btn_pets btn btn-danger"><i class="fa fa-trash"></i></button> '+'</td></tr>');

    jQuery('table.pets_tbl').append(newRow);
    
    $('.del_btn_pets').click(function(){      
        $(this).closest('tr').remove(); 
    });
});


$(".del_btn_pets").on("click", function() {
     $(this).closest('tr').remove(); 
});
$(".del_btn_policy").on("click", function() {
     $(this).closest('tr').remove(); 
});
</script>