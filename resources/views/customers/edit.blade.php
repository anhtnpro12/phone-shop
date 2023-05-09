@extends('layouts.default')

@section('customer', 'active')

@section('content')

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="#" method="post" style="width: 50%;">
        <h3 class="text-center">Update Customer</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" value="" min='0' name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" value="" name="phone" class="form-control" id="phone" required>
        </div>        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_flag" id="active" value="1"  >
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