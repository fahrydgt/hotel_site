<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Hotel Name</th>
                <th>City</th>
                <th>Contact Person</th>
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
                               <td>'.$search['first_name'].' '.$search['last_name'].'</td> 
                               <td>'.$search['email'].'</td> 
                               <td>'.$search['phone'].'</td> 
                               <td>
                                   <a href="'.  base_url($this->router->fetch_class().'/view/'.$search['hotel_id']).'"><span class="fa fa-eye"></span></a> |
                                   <a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['hotel_id']).'"><span class="fa fa-pencil"></span></a> |
                                   <a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['hotel_id']).'"><span class="fa fa-trash"></span></a> 
                               </td>  ';
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