<?php
    require './components/header.php';

    if (!isset($_SESSION['user'])) {
        header('Location:./login.php');
    }
    $user = $_SESSION['user'];

    $results = UserDAO::getListUser();    
?>

<div class="container mb-5">
    <a href="./create.php"><button class="btn btn-success mt-3 mb-3">Add User</button></a>
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
                foreach ($results as $row) {
                    echo '<tr>
                            <th>'.$row->getId().'</th>
                            <td>'.$row->getUserName().'</td>
                            <td>'.$row->getPassword().'</td>
                            <td>'.$row->getName().'</td>
                            <td>'.$row->getAge().'</td>
                            <td>'.$row->getAddress().'</td>
                            <td>'.($row->getSex()==='1'?'Male':'Female').'</td>                            
                            <td>
                                <a href="./edit.php?id='.$row->getId().'"><button class="btn btn-primary">Edit</button></a>
                                <a href="./delete.php?id='.$row->getId().'"><button class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>';
                }
            ?>
                        
        </tbody>
    </table>
</div>

<?php require './components/footer.php'; ?>