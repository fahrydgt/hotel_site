<?php
//echo '<pre>';print_r($room_types);  
//$aa = ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/1').'"><span class="fa fa-eye"></span></a> |':' ';
//echo $aa;  
?>
<div class="col-md-4 pull-right  ">                                  
        <ul class="list-group ">
            <li class="list-group-item">
                <b>Hotel Name:</b> <a class="pull-right"><?php echo $search_inputs['hotel_name']; ?></a><br> 
              <b>Check-in:</b> <a class="pull-right"><?php echo $search_inputs['check_in']; ?></a><br> 
              <b>Check-in:</b> <a class="pull-right"><?php echo $search_inputs['check_out']; ?></a><br> 
              <b>Agent:</b> <a class="pull-right"><?php echo $search_inputs['agent_name']; ?></a><br> 
              <b>Market:</b> <a class="pull-right"><?php echo $search_inputs['market_name']; ?></a> 
            </li>
          </ul>
    </div> 
<div class="col-md-12">
    <table class="table dataTable table-striped table-bordered">
    <tbody>
        <tr>
          <th width="5%">#</th>
          <th width="25%">Room type</th>
          <th width="15%">Available Rooms</th>
          <th width="60%">Tarrifs</th>
        </tr>
        <?php
        $i=1;
        if(empty($room_types)){
            echo '<tr><td colspan="4">No resutls found</td></tr>';
        }else{
            foreach ($room_types as $tarrif_type_id=>$rooms_type){
                echo '
                        <tr>
                            <td>'.$i.'</td>
                            <td>'.$rooms_type['name'].'</td>
                            <td>'.$rooms_type['rooms_count'].'</td>
                            <td>
                                <table class="table ">
                                    <tr>
                                        <th width="20%">Mealplan</th> 
                                        <th width="50%">Amount</th>
                                        <th width="5%">Room(s)</th>
                                    </tr>';
                                foreach ($rooms_type['mealplan_rates'] as $mealplan=>$priceplan){
                                    echo '<tr>
                                                <td>'.$mealplan.'</td>
                                                <td>';
//                                    echo '<pre>'; print_r($room_types); die;
                                    foreach ($priceplan as $rate){
//                                    echo '<pre>'; print_r($rate); die;
                                        $amount = get_default_currency_amount($rate['amount'], $rate['currency_code']);
                                        echo '<b>'.$amount->code.' '.number_format($amount->amount, 2).'</b> ('.date('M d',$rate['date_from']).'-'.date('M d',$rate['date_to']).') <br>';
                                    }
                                    echo '</td><td><input name="room_qty['.$tarrif_type_id.']['.$mealplan.']" id="room_qty['.$tarrif_type_id.']['.$mealplan.']" type="number" min="0"></td>
                                        </tr>';
                                }
                                echo '                
                                     
                                </table>
                            </td>
                          </tr>
                    ';
                $i++;
            }
        }
        ?>
        
         

      </tbody>
    </table> 
    
    <!--<button id="" class="btn btn-primary btn-md"><i class="fa fa-calculator"></i> Calculate</button>-->
</div>

<div class="col-md-12">

<hr>
    <h4>Room Customization</h4>
    <table class="room_custom_table table">
        <tr>
            <td>Customization </td>
            <td>Change from</td>
            <td>Change to</td>
            <td>Qty</td>
            <td><button id="add_element" type="button" class="btn btn-info pull-right add_element_custom"><i class="fa fa-plus"></i></button></td>
        </tr> 
    </table>
</div>