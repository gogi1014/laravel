@extends('layout.master')
@section('content')
<form action="{{ url('update/'.$employees->id) }}" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  @method('PUT')
  <div class="form-group">
    <input type="hidden" class="form-control" name="id" value="{{$employees->id}}" id="id" placeholder="Name">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="{{$employees->name}}" id="name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" class="form-control" name="age" value="{{$employees->age}}" id="age" placeholder="Age">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" value="{{$employees->address}}" id="address" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="section">Section</label>
    <input type="text" class="form-control" name="section" value="{{$employees->section}}" id="section" placeholder="Section">
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <input type="text" class="form-control" name="salary" value="{{$employees->salary}}" id="salary" placeholder="Salary">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  @endsection