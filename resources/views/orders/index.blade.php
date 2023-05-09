@extends('layouts.default')

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('order.create') }}"><button class="btn btn-success mt-3 mb-3">Add Order</button></a>
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Products</th>                                
                    <th scope="col">Creator</th>
                    <th scope="col">Amount</th>                
                    <th scope="col">State</th>                
                    <th scope="col">Payment</th>                
                    <th scope="col">Date</th>                
                    <th scope="col">Status</th>                                                
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>1</td>
                    <td>may tinh</td>
                    <td>test</td>
                    <td>123</td>
                    <td>12</td>
                    <td>paid</td>
                    <td>12/12/2023</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td>
                        <a href="{{ route('order.edit') }}"><button class="btn btn-primary">Edit</button></a>                                    
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