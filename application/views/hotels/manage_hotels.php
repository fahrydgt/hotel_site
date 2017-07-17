<?php
	
	$result = array(
                        'id'=>"",
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
                        'logo'=>"",
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
            
                        'check_in' => "",
                        'check_out' => "",
                        'facilities' => "",
                        'property_surroundings' => "",
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

//var_dump($result);
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
              
             <?php echo form_open_multipart("Hotels/validate"); ?> 
   
                    <div class="box-body ">
                              
                        <div class="row"> 
                            
                            <div class="col-md-12">
                                 <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Contact User</a></li>
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
                                                                                        <?php echo form_textarea(array('name'=>'description','rows'=>'4','cols'=>'120','id'=>'description', 'class'=>'textarea_editor form-control', 'placeholder'=>'Enter description' ),set_value('description',$result['description']),$dis.' '.$o_dis.' '); ?>
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
                                                                          <label class="col-md-3 control-label">Company Logo</label>
                                                                          <div class="col-md-9">                                            
                                                                              <div class="input-group">
                                                                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                   <?php echo form_input(array('name'=>'logo', 'id'=>'logo', 'class'=>'form-control', 'type'=>'file'));?>

                                                                              </div>    
                                                                              <div><img style="size: 100%; width:100px;"  src="<?php echo base_url().COMPANY_LOGO.$result['logo'];?>"></div>
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
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_2"> 
                                              <div class="row"> 
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="col-md-3 control-label">First Name</label>
                                                      <div class="col-md-9">                                            
                                                          <div class="input-group">
                                                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                               <?php echo form_input('first_name', set_value('first_name',$result['first_name']), 'id="first_name" class="form-control" placeholder="Enter First Name"'.$dis.' '.$o_dis.' '); ?>

                                                          </div>                                            
                                                          <span class="help-block"><?php echo form_error('first_name');?></span>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="col-md-3 control-label">Last Name</label>
                                                      <div class="col-md-9">                                            
                                                          <div class="input-group">
                                                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                               <?php echo form_input('last_name', set_value('last_name',$result['last_name']), 'id="last_name" class="form-control" placeholder="Enter Last Name"'.$dis.' '.$o_dis.' '); ?>

                                                          </div>                                            
                                                          <span class="help-block"><?php echo form_error('last_name');?>&nbsp;</span>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="col-md-3 control-label">Email</label>
                                                      <div class="col-md-9">                                            
                                                          <div class="input-group">
                                                              <span class="input-group-addon"><span>@</span></span>
                                                               <?php echo form_input('admin_email', set_value('admin_email',$result['admin_email']), 'id="admin_email" class="form-control" placeholder="Enter Contact person Email addreess"'.$dis.' '.$o_dis.' '); ?>
                                                           </div>                                            
                                                          <span class="help-block"><?php echo form_error('admin_email');?>&nbsp;</span>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label class="col-md-3 control-label">Contact Number</label>
                                                      <div class="col-md-9">                                            
                                                          <div class="input-group">
                                                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                               <?php echo form_input('admin_contact', set_value('admin_contact',$result['admin_contact']), 'id="admin_contact" class="form-control" placeholder="Enter Contact number"'.$dis.' '.$o_dis.' '); ?>
                                                           </div>                                            
                                                          <span class="help-block"><?php echo form_error('admin_contact');?>&nbsp;</span>
                                                      </div>
                                                  </div>
                                              </div>

                                          </div>
                                          <hr>
                                          <div class="row">
                                        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">User Name</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                 <?php echo form_input('admin_username', set_value('admin_username',$result['admin_username']), 'id="admin_username" class="form-control" placeholder="User Name"'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                            <span class="help-block"><?php echo form_error('admin_username');?>&nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">User Role</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                 <?php  echo form_dropdown('user_role',$user_role_list,set_value('user_role',$result['user_role_id']),' class="form-control select" data-live-search="true" id="user_role"'.$o_dis.'');?>
                                                             </div>                                            
                                                            <span class="help-block"><?php echo form_error('user_role');?>&nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Password</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                                                 <?php echo form_password('password', set_value('password'), 'id="password" class="form-control" placeholder=""'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                            <span class="help-block"><?php echo form_error('password');?>&nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Confirm Password</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                                                 <?php echo form_password('confirm_password', set_value('confirm_password'), 'id="confirm_password" class="form-control"  style="z-index: 1;"  placeholder=""'.$dis.' '.$o_dis.' '); ?>
                                                             </div>                                            
                                                            <span class="help-block"><?php echo form_error('confirm_password');?>&nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">User Active</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                 <label class="switch  switch-small">
                                                                    <!--<input type="checkbox"  value="0">-->
                                                                    <?php echo form_checkbox('status', set_value('status','1'), 'id="status" placeholder=""'.$dis.' '.$o_dis.' '); ?>
                                                                    <span></span>
                                                                </label>
                                                             </div>                                            
                                                            <span class="help-block"><?php echo form_error('status');?>&nbsp;</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Profile Picture</label>
                                                        <div class="col-md-6">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                 <?php // echo form_input(array('name'=>'admin_pic[]', 'multiple'=>'multiple','id'=>'admin_pic', 'class'=>'form-control fl_file', 'type'=>'file'));?>
                                                                <?php echo form_input(array('name'=>'admin_pic','id'=>'admin_pic', 'class'=>'form-control fl_file', 'type'=>'file'));?>
                                                            </div>    
                                                            <span class="help-block"><?php echo form_error('admin_pic');?></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(USER_PROFILE_PIC.$result['admin_username'].'/'.$result['pic']); ?>" alt="User profile picture">
                                                        </div>
                                                    </div>
                                                </div>


                                        </div>
                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_3"> 
                                         <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Check-in Time<span style="color: red">*</span></label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">
                                                           <?php echo form_input('check_in', set_value('check_in',$result['check_in']), 'id="check_in" class="form-control timepicker" placeholder="Enter Hotel Check in Time"'.$dis.' '.$o_dis.' '); ?>
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
                                                             <?php echo form_input('check_out', set_value('check_out',$result['check_out']), 'id="check_out" class="form-control timepicker" placeholder="Enter Hotel Check Out Time"'.$dis.' '.$o_dis.' '); ?>
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
                                                                <tr>
                                                                    <td><?php echo form_input('title_policy[0]', set_value('title_policy'), 'id="check_out" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                    <td><?php echo form_textarea(array('name'=>'policy_description[0]','rows'=>'4','cols'=>'120','id'=>'policy_description', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('description'),$dis.' '.$o_dis.' '); ?></td>
                                                                    <td><button id="add_element" type="button" class="btn btn-info pull-right add_element_policy"><i class="fa fa-plus"></i></button></td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td><?php echo form_input('title_pets[0]', set_value('title_pets'), 'id="title_pets" class="form-control " placeholder="Enter Title"'.$dis.' '.$o_dis.' '); ?></td>
                                                                    <td><?php echo form_textarea(array('name'=>'pets_description[0]','rows'=>'4','cols'=>'120','id'=>'pets_description', 'class'=>' form-control', 'placeholder'=>'Enter description' ),set_value('pets_description'),$dis.' '.$o_dis.' '); ?></td>
                                                                    <td><button id="add_element" type="button" class="btn btn-info pull-right add_element_pets"><i class="fa fa-plus"></i></button></td>
                                                                </tr>
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
                                                           <?php  echo form_dropdown('facilities',$facilities_list,set_value('facilities',$result['facilities']),' class="form-control  select2"  multiple="multiple"  data-live-search="true" id="facilities"'.$o_dis.'');?>
                                                             
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
                                                           <?php  echo form_dropdown('property_surroundings',$property_sur_list,set_value('property_surroundings',$result['property_surroundings']),' class="form-control  select2"  multiple="multiple"  data-live-search="true" id="property_surroundings"'.$o_dis.'');?>
                                                             
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('property_surroundings');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="tab_4"> 
                                           <div class="col-md-12">
                                               <br>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Images</label>
                                                    <div class="col-md-9">                                            
                                                           
                                                        <div class="fl_file_uploader2">
                                                            <input type="file" name="hotel_images" class="fl_files"> 
                                                        </div> 
                                                        <span class="help-block"><?php echo form_error('logo');?></span>
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

$(".add_element_policy").on("click", function() {
    var rowCount = $('.policy_tbl tr').length;
    
    alert(rowCount);
    var counter = rowCount+1;
    event.preventDefault(); 
    var newRow = jQuery('<tr style="padding:10px" id="tr_'+rowCount+'">'+'<td><div class="input-group"><input type="text" name="title_policy['+rowCount+']" id="title_policy" class="form-control" placeholder="Enter Title"></div></td>'+'<td><div class="input-group"><textarea name="policy_description['+rowCount+']" cols="120" rows="4" id="policy_description['+rowCount+']" class=" form-control" placeholder="Enter description"></textarea></div></td> <td> '+'<button id="del_btn" type="button" class="del_btn_policy btn btn-danger"><i class="fa fa-trash"></i></button> '+'</td></tr>');

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
    var newRow = jQuery('<tr style="padding:10px" id="tr_'+rowCount+'">'+'<td><div class="input-group"><input type="text" name="title_pets['+rowCount+']" id="title" class="form-control" placeholder="Enter Title"></div></td>'+'<td><div class="input-group"><textarea name="pets_description['+rowCount+']" cols="120" rows="4" id="pets_description['+rowCount+']" class=" form-control" placeholder="Enter description"></textarea></div></td> <td> '+'<button id="del_btn" type="button" class="del_btn_pets btn btn-danger"><i class="fa fa-trash"></i></button> '+'</td></tr>');

    jQuery('table.pets_tbl').append(newRow);
    
    $('.del_btn_pets').click(function(){      
        $(this).closest('tr').remove(); 
    });
});
</script>