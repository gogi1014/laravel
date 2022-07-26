@extends('layout.master')
@section('content')

<br>
<form action="{{ url('/') }}" method="GET">
    <input type="text" name="search" required />
    <button type="submit">Search</button>
    <input type="button" onclick="printDiv('printableArea')" value="Print" />
    <a class="btn btn-primary" href="{{ URL::to('/pdf') }}" value="pdf">Export to PDF</a>
    <a class="btn btn-primary" href="{{ URL::to('/excel') }}">Export to Excel</a>
</form>

<script type="importmap">
  {
    "imports": {
      "vue": "https://unpkg.com/vue@3/dist/vue.esm-browser.js"
    }
  }
</script>
<div id="app">@{{ posts }}</div>

<script type="module">
  import { createApp } from 'vue'
  


  createApp({
    data() {
      return {
        posts: []
      }
    },
    methods: {
            showBlogs: function () {
                axios.get('/blog').then(function (res) {
                    this.posts = res.data;
                }.bind(this));
            }
        },
        created: function () {
            this.showBlogs()
        },
    template: `
    <table class="table table-striped table-dark">
    <thead>
        <tr>
          <th class="text-left">
            Name
          </th>
          <th class="text-left">
            Age
          </th>
          <th class="text-left">
            Address
          </th>
          <th class="text-left">
            Section
          </th>
          <th class="text-left">
            Salary
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in posts"
          :key="item.name"
        >
          <td>@{{ item.name }}</td>
          <td>@{{ item.age }}</td>
          <td>@{{ item.address }}</td>
          <td>@{{ item.secion }}</td>
          <td>@{{ item.salary }}</td>
          <td><a href="@{{ url('edit/'.$itemid) }}" class="btn btn-primary btn-sm">Edit</a></td>
        </tr>
      </tbody>
      </table>`
  }
  ).mount('#app')
</script>


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
    <ul class='pagination pagination-sm'>
        {{$employees->appends($_GET)->links('pagination::bootstrap-4')}}
    </ul>
</div>



<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        document.body.innerHTML = printContents;
        window.print();
    }
</script>
@endsection