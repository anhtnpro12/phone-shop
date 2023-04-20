<?php
require './components/header.php';

if (!isset($_SESSION['user'])) {
    header('Location:./login.php');
}
$user = $_SESSION['user'];

$results = $connection->query("SELECT * FROM users;");
?>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" data-bs-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">            
            <strong class="me-auto">Welcome</strong>            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You logged successful!
        </div>
    </div>
</div>

<script>
    document.getElementById('liveToast').toast('show');
</script>

<?php require './components/footer.php'; ?>