@extends('layout.master')
@section('content')
<div id="printableArea">
    <table class="table table-striped table-warning">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Section</th>
                <th scope="col">Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{$employee->name}}</td>
                <td>{{$employee->age}}</td>
                <td>{{$employee->address}}</td>
                <td>{{$employee->section}}</td>
                <td>{{$employee->salary}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-felx justify-content-center">
    <ul class='pagination pagination'>
        @php
        for($page_number = 1; $page_number<= @$total_pages; $page_number++) { @$pagLink .='<li class="page-item"><a class="page-link" href="?page=' .$page_number.'&search='.$search.'" >'.$page_number.'</a>';}
    echo @$pagLink . " </ul>" @endphp
</div>
@endsection