@extends('layouts.default')

@section('content')
    
    <div class="container mb-5">
        <a href="./create.php"><button class="btn btn-success mt-3 mb-3">Add Customer</button></a>
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>                                
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>                
                    <th scope="col">Email</th>                
                    <th scope="col">Status</th>                
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>Há há há </td>
                    <td>Hà Nội</td>
                    <td>012346777</td>
                    <td>aothat@aothat.com</td>                                                                
                    <td><span class="badge bg-success">Active</span></td>                                                                
                    <td>
                        <a href="#"><button class="btn btn-primary">Edit</button></a>                                    
                        <a href="#">
                            <button class="btn btn-danger">Deactivate</button>
                        </a>
                    </td>
                </tr>                
                <tr>
                    <th>1</th>
                    <td>Há há há </td>
                    <td>Hà Nội</td>
                    <td>012346777</td>
                    <td>aothat@aothat.com</td>                                                                
                    <td><span class="badge bg-success">Active</span></td>                                                                
                    <td>
                        <a href="#"><button class="btn btn-primary">Edit</button></a>                                    
                        <a href="#">
                            <button class="btn btn-danger">Deactivate</button>
                        </a>
                    </td>
                </tr>                
                <tr>
                    <th>1</th>
                    <td>Há há há </td>
                    <td>Hà Nội</td>
                    <td>012346777</td>
                    <td>aothat@aothat.com</td>                                                                
                    <td><span class="badge bg-success">Active</span></td>                                                                
                    <td>
                        <a href="#"><button class="btn btn-primary">Edit</button></a>                                    
                        <a href="#">
                            <button class="btn btn-danger">Deactivate</button>
                        </a>
                    </td>
                </tr>                
                <tr>
                    <th>1</th>
                    <td>Há há há </td>
                    <td>Hà Nội</td>
                    <td>012346777</td>
                    <td>aothat@aothat.com</td>                                                                
                    <td><span class="badge bg-success">Active</span></td>                                                                
                    <td>
                        <a href="#"><button class="btn btn-primary">Edit</button></a>                                    
                        <a href="#">
                            <button class="btn btn-danger">Deactivate</button>
                        </a>
                    </td>
                </tr>                
                            
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>                                                        
                <li class="page-item"><a class="page-link" href="#">2</a></li>                                                        
                <li class="page-item"><a class="page-link" href="#">3</a></li>                                                        
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>    
@endsection