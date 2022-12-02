@extends('layouts.css')
@section('title','User List')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('sweetalert::alert')
@include('layouts.navbar')
<style>
    .user_logo{
        width: 50%;
        height: 70%;
   
    }
    nav svg{
      height: 20px;
    }
</style>
<div class="container">
    <h1 class="text-center mt-2">All Users</h1>

    <div class="d-flex justify-content-between">
        <a href="{{ route('user.home') }}" class="btn btn-primary btn-md py-2 mt-1"><i class="fa-sharp fa-solid fa-plus"></i> Create User</a>
    </div>
   <form action="{{ route('user.list') }}" method="GET">
    @csrf
    <div class="row mt-3">
      <div class="col-md-2">
        
        <input type="text" name="getAge"  class="form-control" placeholder="Select Age">
      </div>
      <div class="col-md-3">
      
         <select class="form-select" aria-label="Default select example" name="getreligion">
          <option value="">Select Your Religion</option>
          @foreach ($getReligions as $item)
          <option value="{{ $item->rel_name }}">{{ $item->rel_name }}</option>
              
          @endforeach
        </select>
      </div>
      <div class="col-md-2">

          <select class="form-select" aria-label="Default select example" name="getmonths">
          <option value="">Select Month</option>
          @foreach ($getMonths as $item)
          <option value="{{ $item->id }}">{{ $item->month_name }}</option>
              
          @endforeach
        </select>
      </div>
      <div class="col-md-3 ">
        <input class="form-control me-2 w-100 ml-5" type="search" name="search" placeholder="Search" aria-label="Search">
      </div>
      <div class="col-md-2 ">
        <button class="btn btn-success w-50" type="submit">Filter</button>
      </div>

    </div>
   </form>
    


      <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Age</th>
                <th>Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id_number }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->pnumber }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->age }} years</td>
                    <td>
                       <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}"> <i class="fa-solid fa-eye"></i></a>
                       <a href="/edit-user/{{ $user->id }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></a>
                       <a href="/delete-user/{{ $user->id }}" class="btn btn-danger" onclick="confirmation(event)"> <i class="fa-solid fa-trash"></i></a>

                    </td>

                </tr>
            @endforeach
        </tbody>

      </table>

      <div class="mt-5">
        {{$users->links()}}
      </div>

</div>
@foreach ($users as $item)
<div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 fw-bold"> 
            ID Number:   <h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{$item->id_number}}</h5></div>
          <div class="col-md-6 fw-bold">
           Date of Birth : <h5 class="modal-title text-center text-danger" id="exampleModalLabel ">{{$item->dob}}</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mt-3 fw-bold"> 
            Age:   <h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{ $item->age }} years</h5>
        </div>
        <div class="col-md-6 mt-3 fw-bold"> 
            Name :   <h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{ $item->name }} </h5>
        </div>
        </div>
        
        <div class="row">
          <div class="col-md-6 mt-3 fw-bold"> 
            Phone Number :   <h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{$item->pnumber}}</h5></div>
          <div class="col-md-6 mt-3 fw-bold">
            Address : <h5 class="modal-title text-center text-danger" id="exampleModalLabel ">{{$item->address}}</h5>
          </div>
      </div>
      <div class="row">
        <div class="col-md-6  mt-3 fw-bold"> 
         Religion :<h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{ $item->religion }}</h5>
        </div>
        <div class="col-md-6  mt-3 fw-bold"> 
            Nationality :<h5 class="modal-title text-center text-danger" id="exampleModalLabel">{{ $item->nationality }}</h5>
           </div>
    </div>
    <div class="row">
    <div class="col-md-12 mt-3 fw-bold">
     User Image : <h5 class="modal-title text-center text-danger" id="exampleModalLabel "><img src="{{asset('user_logo/'.$item->user_img)}}" class="user_logo"></h5>
    </div>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
  </div>
</div>
</div>
@endforeach 
<script>
    function confirmation(ev){
        ev.preventDefault();
        var urlToRedirect=ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect)

        swal({
            title:'Are you sure to delete this user?',
            text:'You will not be able to recover this!',
            icon:"warning",
            buttons:true,
            dangerMode:true
        })
        .then((willCancel)=>{
            if(willCancel){
                window.location.href=urlToRedirect
            }
        });
    }
   </script>
@include('layouts.js')