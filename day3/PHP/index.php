<?php
    require './components/header.php';

    if (!isset($_SESSION['user'])) {
        header('Location:./login.php');
    }
    $user = $_SESSION['user'];

    $results = $connection->query("SELECT * FROM users;");    
?>

<div class="container mb-5">
    <a href="./create.php?id='.$row['id'].'"><button class="btn btn-success mt-3 mb-3">Add User</button></a>
    <table class="table">
        <thead>
            <tr class="table-secondary">
                <th scope="col">ID</th>
                <th scope="col">User name</th>
                <th scope="col">Password</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Sex</th>                
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $results->fetch_array()) {
                    echo '<tr>
                            <th>'.$row['id'].'</th>
                            <td>'.$row['user_name'].'</td>
                            <td>'.$row['password'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['age'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.($row['sex']==='1'?'Male':'Female').'</td>                            
                            <td>
                                <a href="./delete.php?id='.$row['id'].'"><button class="btn btn-danger">Delete</button></a>
                                <a href="./edit.php?id='.$row['id'].'"><button class="btn btn-primary">Edit</button></a>
                            </td>
                        </tr>';
                }
            ?>
                        
        </tbody>
    </table>
</div>

<?php require './components/footer.php'; ?>