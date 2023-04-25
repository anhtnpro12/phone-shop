<?php

use DataAccessLayer\CustomerDAO;
use DataAccessLayer\OrderDAO;
use DataAccessLayer\OrderDetailDAO;
use DataAccessLayer\PaymentDAO;
use DataAccessLayer\ShippingDAO;

$page = 'order';
require '../components/header.php';
include '../../dal/OrderDAO.php';
include '../../dal/PaymentDAO.php';
include '../../dal/ShippingDAO.php';
include '../../dal/OrderDetailDAO.php';
include '../../dal/CustomerDAO.php';

$results = OrderDAO::getList($conn);      

?>

<div class="container mb-5">
    <a href="./create.php"><button class="btn btn-success mt-3 mb-3">Add Order</button></a>
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID</th>
                <th scope="col">Products</th>                                
                <th scope="col">Creator</th>
                <th scope="col">Amount</th>                
                <th scope="col">State</th>                
                <th scope="col">Payment</th>                
                <th scope="col">Status</th>                                                
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if (empty($results)) {
                    echo '<tr>
                            <td colspan="8" style="text-align: center;">
                                <img src="../imgs/empty.png" alt="empty image">                
                            </td>
                        </tr>';
                } else {
                    foreach ($results as $row) {
                        $cus = CustomerDAO::getByID($conn, $row->customer_id);
                        $pay = PaymentDAO::getDetailById($conn, $row->payment_id);
                        $ship = ShippingDAO::getDetailById($conn, $row->ship_id);
                        $od = OrderDetailDAO::getListByOrderId($conn, $row->id);
                        echo '<tr>
                                <th>'.$row->id.'</th>
                                <td>'.$od[0]->product->name.(count($od)>1?'...':'').'</td>
                                <td>'.$cus->name.'</td>
                                <td>'.$row->amount.'</td>
                                <td>'.$row->state.'</td>                                                                
                                <td>'.($pay->paid_at?'Paid':'Unpaid').'</td>                                                                
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