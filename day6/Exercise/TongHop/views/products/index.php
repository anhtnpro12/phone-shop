<?php

use DataAccessLayer\ProductDAO;

$page = 'product';
require '../components/header.php';
include '../../dal/ProductDAO.php';

$results = ProductDAO::getList($conn);      

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
                                <td>'.($row->status?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">inactive</span>').'</td>                                                                
                                <td>
                                    <a href="./edit.php?id='.$row->id.'"><button class="btn btn-primary">Edit</button></a>                                    
                                    <a href="./toggleStatus.php?id='.$row->id.'">
                                        '.($row->status?'<button class="btn btn-danger">Deactivate</button>':'<button class="btn btn-success">Activate</button>').'
                                    </a>
                                </td>
                            </tr>';
                    }
                }
            ?>
                        
        </tbody>
    </table>
</div>

<?php require '../components/footer.php'; ?>