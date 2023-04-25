<?php

use DataAccessLayer\ProductDAO;

$page = 'product';
require '../components/header.php';
include '../../dal/ProductDAO.php';

define('NUM_PER_PAGE', 10);

$results = ProductDAO::getList($conn);    
$count = ProductDAO::count($conn);  
$pageSize = ceil($count/NUM_PER_PAGE);
$page = $_GET['page'] ?? 1;

?>

<div class="container mb-5">
    <a href="./create.php"><button class="btn btn-success mt-3 mb-3">Add Product</button></a>
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID</th>
                <th scope="col">Name</th>                                
                <th scope="col">Description</th>
                <th scope="col">Price</th>                
                <th scope="col">Quantity</th>                
                <th scope="col">Status</th>                
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if (empty($results)) {
                    echo '<tr>
                            <td colspan="7" style="text-align: center;">
                                <img src="../imgs/empty.png" alt="empty image">                
                            </td>
                        </tr>';
                } else {
                    foreach ($results as $row) {
                        echo '<tr>
                                <th>'.$row->id.'</th>
                                <td>'.$row->name.'</td>
                                <td>'.$row->description.'</td>
                                <td>'.$row->price.'</td>
                                <td>'.$row->quantity.'</td>                                                                
                                <td>'.($row->delete_flag?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">inactive</span>').'</td>                                                                
                                <td>
                                    <a href="./edit.php?id='.$row->id.'"><button class="btn btn-primary">Edit</button></a>                                    
                                    <a href="./toggleStatus.php?id='.$row->id.'">
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
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php
            
            for ($i = 1; $i <= $pageSize; $i++) { 
                echo '<li class="page-item"><a class="page-link '.($i==$page?'active':'').' " href="#">'.$i.'</a></li>';
            }

            ?>            
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
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