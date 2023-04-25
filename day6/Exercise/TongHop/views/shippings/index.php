<?php

use DataAccessLayer\ShippingDAO;

$page = 'ship';
require '../components/header.php';
include '../../dal/ShippingDAO.php';   

define('NUM_PER_PAGE', 2);

// pagination
$count = ShippingDAO::count($conn);  
$pageSize = ceil($count/NUM_PER_PAGE);
$page = $_GET['page'] ?? 1;

$results = ShippingDAO::getListInRange($conn, ($page-1)*NUM_PER_PAGE, NUM_PER_PAGE); 

?>

<div class="container mb-5">
    <a href="./create.php"><button class="btn btn-success mt-3 mb-3">Add Shipping Method</button></a>
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID</th>
                <th scope="col">Name</th>                                
                <th scope="col">Description</th>                               
                <th scope="col">Status</th>                
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if (empty($results)) {
                    echo '<tr>
                            <td colspan="5" style="text-align: center;">
                                <img src="../imgs/empty.png" alt="empty image">                
                            </td>
                        </tr>';
                } else {
                    foreach ($results as $row) {
                        echo '<tr>
                                <th>'.$row->id.'</th>
                                <td>'.$row->name.'</td>
                                <td>'.$row->description.'</td>                                                                                                
                                <td>'.($row->delete_flag?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">inactive</span>').'</td>                                                                
                                <td>
                                    <a href="./edit.php?id='.$row->id.'"><button class="btn btn-primary">Edit</button></a>                                    
                                    <a href="./toggleStatus.php?id='.$row->id.'&page='.$page.'">
                                        '.($row->delete_flag?'<button class="btn btn-danger">Deactivate</button>':'<button class="btn btn-success">Activate</button>').'
                                    </a>
                                </td>
                            </tr>';
                    }
                }
            ?>
                        
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link <?php echo ($page==1?'disabled':''); ?>" 
                                    href="<?php echo $_SERVER['PHP_SELF'].'?page='.($page-1); ?>">Previous</a></li>
            <?php
            
            for ($i = 1; $i <= $pageSize; $i++) { 
                echo '<li class="page-item"><a class="page-link '.($i==$page?'active':'')
                    .' " href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a></li>';
            }

            ?>            
            <li class="page-item"><a class="page-link <?php echo ($page==$pageSize?'disabled':''); ?>" 
                                    href="<?php echo $_SERVER['PHP_SELF'].'?page='.($page+1); ?>">Next</a></li>
        </ul>
    </nav>
</div>

<script>
    <?php

    $type = $_GET['type'];              
    $mess = $_GET['mess'];                

    if (isset($type)) {
        if ($type == 'success') {
            echo 'showSuccessToast("'.$mess.'")';
        } else {
            echo 'showErrorToast("'.$mess.'")';            
        }
    }

    ?>
</script>

<?php require '../components/footer.php'; ?>