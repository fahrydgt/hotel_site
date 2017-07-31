<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Hotel Name</th>
                <th>City</th> 
                <th>Email</th>
                <th>Phone</th>
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
                               <td>'.$search['hotel_name'].'</td>
                               <td>'.$search['city'].'</td>  
                               <td>'.$search['email'].'</td> 
                               <td>'.$search['phone'].'</td> 
                               <td>';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/'.$search['hotel_id']).'"><span class="fa fa-eye"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'edit'))?'<a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['hotel_id']).'"><span class="fa fa-pencil"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata('user_role_ID'), $this->router->class, 'delete'))?'<a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['hotel_id']).'"><span class="fa fa-trash"></span></a> ':' ';
                                   
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