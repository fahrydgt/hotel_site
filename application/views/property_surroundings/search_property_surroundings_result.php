     <?php
        $i = 0;
         foreach ($search_list as $search){ 
             echo '
                 <tr>
                     <td>'.($i+1).'</td>
                     <td>'.$search['property_name'].'</td>
                     <td>'.$search['category_name'].'</td> 
                     <td>
                         <a href="'.  base_url($this->router->fetch_class().'/view/'.$search['id']).'"><span class="fa fa-eye"></span></a> |
                         <a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['id']).'"><span class="fa fa-pencil"></span></a> |
                         <a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['id']).'"><span class="fa fa-trash"></span></a> 
                     </td>  ';
             $i++;
         }
    ?>   