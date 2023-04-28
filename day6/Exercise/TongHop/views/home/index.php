<?php

use DataAccessLayer\CustomerDAO;
use DataAccessLayer\OrderDAO;
use DataAccessLayer\OrderDetailDAO;

$page = 'home';
require '../components/header.php';
include '../../dal/OrderDAO.php';
include '../../dal/PaymentDAO.php';
include '../../dal/ShippingDAO.php';
include '../../dal/OrderDetailDAO.php';
include '../../dal/CustomerDAO.php';

$results = OrderDAO::getList($conn);

define('NUM_PER_PAGE', 5);

// pagination
$count = OrderDAO::count($conn);  
$pageSize = ceil($count/NUM_PER_PAGE);
$page = $_GET['page'] ?? 1;

$results = OrderDAO::getListInRange($conn, ($page-1)*NUM_PER_PAGE, NUM_PER_PAGE);   

?>

<div class="container mb-5 d-flex">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mt-0">
                    <h5 class="card-title">Sales</h5>
                </div>

                <div class="col-auto">
                    <div class="stat text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3">2.382</h1>
            <div class="mb-0">
                <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                <span class="text-muted">Since last week</span>
            </div>
        </div>
    </div>    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mt-0">
                    <h5 class="card-title">Sales</h5>
                </div>

                <div class="col-auto">
                    <div class="stat text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3">2.382</h1>
            <div class="mb-0">
                <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                <span class="text-muted">Since last week</span>
            </div>
        </div>
    </div>    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mt-0">
                    <h5 class="card-title">Sales</h5>
                </div>

                <div class="col-auto">
                    <div class="stat text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3">2.382</h1>
            <div class="mb-0">
                <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                <span class="text-muted">Since last week</span>
            </div>
        </div>
    </div>    
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