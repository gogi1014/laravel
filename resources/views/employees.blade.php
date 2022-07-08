@extends('layout.master')
@section('content')

<form action="{{ url('/') }}" method="GET">
    <input type="text" name="search" required />
    <button type="submit">Search</button>
    <input type="button" onclick="printDiv('printableArea')" value="Print" />
    <a class="btn btn-primary" href="{{ URL::to('/pdf') }}">Export to PDF</a>
    <a class="btn btn-primary" href="{{ URL::to('/excel') }}">Export to Excel</a>
</form>

<div id="printableArea">
    <table class="table table-striped table-dark">
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
                <td><a href="{{ url('edit/'.$employee->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-felx justify-content-center">

    @php
    for($page_number = 1; $page_number<= @$total_pages; $page_number++) { echo '<a href = "?search=' . $search . '?page=' . $page_number . '">' . $page_number . ' </a>' ; } @endphp </div>
        @endsection


        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                document.body.innerHTML = printContents;
                window.print();
            }
        </script>