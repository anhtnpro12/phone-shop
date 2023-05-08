@extends('layouts.default')

@section('payment', 'active')

@section('content')

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="#" method="post" style="width: 50%;">
        <h3 class="text-center">Add Shipping Method</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>                      
        <input type="submit" name="submit" value="Add now" class="btn btn-primary">
    </form>
</div>

@endsection