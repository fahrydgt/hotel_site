<?php
//echo '<pre>';print_r($search_list); die;
//$aa = ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/1').'"><span class="fa fa-eye"></span></a> |':' ';
//echo $aa;  
?>
<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Hotel</th>
                <th>Plan name</th>
                <th>Tarrif Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Approved</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
              <?php
                  $i = 0;
                   foreach ($search_list as $search){ 
                       echo '
                           <tr>
                               <td>'.($i+1).'</td>
                               <td>'.$search['season_name'].'</td>
                               <td>'.$search['hotel_name'].'</td>
                               <td>'.$search['tt_name'].'</td> 
                               <td>'.date('m/d/Y',$search['date_from']).'</td> 
                               <td>'.date('m/d/Y',$search['date_to']).'</td> 
                               <td>'.(($search['approved'])?'Approved':'Pending').'</td> 
                               <td>';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/'.$search['id']).'"><span class="fa fa-eye"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'edit'))?'<a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['id']).'"><span class="fa fa-pencil"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'delete'))?'<a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['id']).'"><span class="fa fa-trash"></span></a> ':' ';
                                   
                                echo '</td>  ';
                       $i++;
                   }
              ?>   
        </tbody>
           <tfoot>
           <tr>
               <th>#</th>
                <th>Plan name</th>
                <th>Hotel</th>
                <th>Tarrif Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Approved</th>
                <th>Action</th>
           </tr>
           </tfoot>
         </table>