@extends('layouts.default')

@section('product', 'active')

@section('content')

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="#" method="post" style="width: 50%;">
        <h3 class="text-center">Update Product</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="Máy tính" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" value="Đây là cái máy tính" name="description" class="form-control" id="description" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" value="1234" name="price" class="form-control" id="price" required>
        </div>        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" value="12" name="quantity" class="form-control" id="quantity" required>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_flag" id="active" value="1" checked >
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_flag" id="inactive" value="0" >
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
        </div>
        <input type="hidden" name="id" value="">
        <input type="submit" name="submit" value="Update now" class="btn btn-primary">
    </form>
</div>

@endsection