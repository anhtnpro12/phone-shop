<?php
require './components/header.php';

if (!isset($_SESSION['user'])) {
    header('Location:./login.php');
}

$id = $_GET['id'] ?? $_POST['id'];

$isOk = false;
if (isset($_POST['submit'])) {
    $user_name = $_POST['user-name'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];

    $sql = "UPDATE `users` SET `user_name` = ?, `password` = ?, `name` = ?, `age` = ?
            , `address` = ?, `sex` = ?, `last_active` = NOW() WHERE `users`.`id` = ?";

    $statement = $connection->prepare($sql);
    $statement->bind_param('sssisii', $user_name, $password, $name, $age, $address, $sex, $id);

    if ($statement->execute()) {
        $isOK = true;
    } else {
        die('Error: (' . $connection->errno . ') ' . $connection->error);
    }
}

$result = $connection->query("SELECT * FROM `users` WHERE `id`=$id");
while($row = $result->fetch_array()) {
    $user = $row;
}
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Update User</h3>
        <?php
        if (isset($_POST['submit'])) {
            if ($isOK) {
                echo '<span class="fs-4 text-success">Update successful.</span>';
            } else {
                echo '<span class="fs-4 text-success">Update failed</span>';
            }
        }
        ?>

        <div class="mb-3">
            <label for="user-name" class="form-label">User Name</label>
            <input type="text" value="<?php echo $user['user_name']; ?>" name="user-name" class="form-control" id="user-name" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" value="<?php echo $user['password']; ?>" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="<?php echo $user['name']; ?>" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" min='0' value="<?php echo $user['age']; ?>" name="age" class="form-control" id="age" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" value="<?php echo $user['address']; ?>" name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="male" value="1" <?php echo $user['sex']==='1'?'checked':''; ?> >
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="female" value="0" <?php echo $user['sex']==='0'?'checked':''; ?>>
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update now" class="btn btn-primary">
    </form>
</div>

<?php require './components/footer.php'; ?>