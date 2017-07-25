<?php
//echo '<pre>';print_r($this->session->userdata()); die;
$aa = ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/1').'"><span class="fa fa-eye"></span></a> |':' ';
echo $aa;  
?>
<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Room</th>
                <th>Hotel</th>
                <th>Tarrif Type</th>
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
                               <td>'.$search['room_name'].'</td>
                               <td>'.$search['hotel_name'].'</td> 
                               <td>'.$search['tarrif_type_name'].'</td> 
                               <td>';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/'.$search['id']).'"><span class="fa fa-eye"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'edit'))?'<a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['id']).'"><span class="fa fa-pencil"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'delete'))?'<a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['id']).'"><span class="fa fa-trash"></span></a> ':' ';
                                   
                                echo '</td>  ';
                       $i++;
                   }
              ?>   
        </tbody>
           <tfoot>
           <tr>
               <th>#</th>
               <th>Facility Name</th>
               <th>Category</th>
               <th>Action</th>
           </tr>
           </tfoot>
         </table>