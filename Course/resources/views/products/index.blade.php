@extends('layouts.default')

@section('product', 'active')

@section('content')

<div class="container mb-5">
    <a href="{{ route('product.create') }}"><button class="btn btn-success mt-3 mb-3">Add Product</button></a>
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
            
            <tr>
                <th>1</th>
                <td>Máy tính</td>
                <td>Đây là cái máy tính</td>
                <td>1235</td>
                <td>12</td>                                                                
                <td><span class="badge bg-success">Active</span></td>                                                                
                <td>
                    <a href="{{ route('product.edit') }}"><button class="btn btn-primary">Edit</button></a>                                    
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