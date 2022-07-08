@extends('layout.master')
@section('content')
<form action="/create" method="get">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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