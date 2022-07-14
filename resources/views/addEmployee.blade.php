@extends('layout.master')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form action="/create" method="post">
  @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" class="form-control" name="age" id="age" placeholder="Age">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" id="address" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="section">Section</label>
    <input type="text" class="form-control" name="section" id="section" placeholder="Section">
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <input type="text" class="form-control" name="salary" id="salary" placeholder="Salary">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection