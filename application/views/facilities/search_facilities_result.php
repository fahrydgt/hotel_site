<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Facility Name</th>
                <th>Category</th>
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
                               <td>'.$search['name'].'</td>
                               <td>'.$search['category_name'].'</td> 
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