
<script>
    
$(document).ready(function(){  
	get_results();
    $("#name").keyup(function(){ 
		event.preventDefault();
		get_results();
    });
	 
    $("#activity_id").change(function(){
		event.preventDefault();
		get_results();
    });
    $("#tarrif_type_id").change(function(){
		event.preventDefault();
		get_results();
    });
    $("#date").change(function(){
//        alert()
		event.preventDefault();
		get_results();
    }); 
	
	
	function get_results(){
        $.ajax({
			url: "<?php echo site_url('Activity_rates/search');?>",
			type: 'post',
			data : jQuery('#form_search').serializeArray(),
			success: function(result){
                             $("#result_search").html(result);
                             $(".dataTable").DataTable();
        }
		});
	}
});
</script>
 
<?php // echo '<pre>'; print_r($facility_list); die;?>

<div class="row">
<div class="col-md-12">
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

        </div>
    </div>
    
 <br><hr>
    <section  class="content"> 
        <div class="">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Search </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
            <?php echo form_open("", 'id="form_search" class="form-horizontal"')?>  
   
                    <div class="box-body">
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="col-md-12"> 
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Name<span style="color: red">*</span></label>
                                            <div class="col-md-9">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <?php echo form_input('name', set_value('name'), 'id="name" class="form-control" placeholder="Search by Facility Name"'); ?>

                                                </div>                                            
                                                <span class="help-block"><?php echo form_error('name');?></span>
                                            </div>
                                        </div> 
                                </div>
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                           <label class="col-md-3 control-label">Activity place</label>
                                               <div class="col-md-9">                                            
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><span class="fa fa-search"></span></span>
                                                        <?php  echo form_dropdown('activity_id',$hotel_list,set_value('activity_id'),' class="form-control select2" id="activity_id"');?>
                                                   </div>                                             
                                               </div>
                                           </div> 
                                    </div> 
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                           <label class="col-md-3 control-label">Tarrif Type</label>
                                               <div class="col-md-9">                                            
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><span class="fa fa-search"></span></span>
                                                        <?php  echo form_dropdown('tarrif_type_id',$tarrif_type_list,set_value('tarrif_type_id'),' class="form-control select2" id="tarrif_type_id"');?>
                                                   </div>                                             
                                               </div>
                                           </div> 
                                    </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date from<span style="color: red"></span></label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <?php echo form_input('date', set_value('date'), 'id="date" readonly class="form-control  datepicker" placeholder="Click to Select Date"'); ?>

                                        </div>                                            
                                        <span class="help-block"><?php echo form_error('date');?></span>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>
                    </div>
                <div class="panel-footer">
                    <button type="reset" class="btn btn-default">Clear Form</button>                                    
                                    <a id="search_btn" class="btn btn-primary pull-right"><span class="fa fa-search"></span>Search</a>
                                </div>
              </div>
    </section>
                            <?php echo form_close(); ?>               
                                
                         
                            
                        </div>
     <div class="col-md-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div  id="result_search" class="box-body"> </div>
            <!-- /.box-body -->
          </div>
       
     </div>
</div> 