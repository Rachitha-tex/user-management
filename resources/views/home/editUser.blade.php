@extends('layouts.css')
@section('title','Edit User')
      @include('layouts.navbar')

    @include('sweetalert::alert')

    <div class="container">
        <h2 class="text-center mt-4">Edit Users</h2>
        
        <form action="{{ route('user.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">ID Number <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" name="id_number" class="form-control" placeholder="Enter ID Number....." value="{{ $user->id_number }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Date of Birth <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth....." value="{{ $user->dob }}">
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Age <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="number" name="age" class="form-control" placeholder="Enter Age....." value="{{ $user->age }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">User Name <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" name="name" class="form-control" placeholder="Enter User Name....." value="{{$user->name }}">
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Contact Number <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" name="pnumber" class="form-control" placeholder="Contact Number....." value="{{ $user->pnumber }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Address</div>
                        <input type="text" name="address" class="form-control" placeholder="Enter Your Address....." value="{{ $user->address }}">
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Religion</div>
                        <select  class="form-select" aria-label="Default select example" name="religion">
                            <option selected value="{{ $user->religion }}">{{ $user->religion }}</option>
                            <option >Select Your Religion</option>
                            <option value="Buddhist">Buddhist</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Christian">Christian</option>
                            <option value="Other">Other</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Nationality</div>
                        <select class="form-select" name="nationality" aria-label="Default select example">
                            <option selected value="{{ $user->nationality }}">{{ $user->nationality }}</option>
                            <option >Select Your Nationality</option>
                            <option value="Sinhala">Sinhala</option>
                            <option value="Sri Lankan Tamil">Sri Lankan Tamil</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Indian Tamil">Indian Tamil</option>
                            <option value="Other">Other</option>
                          </select>
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Current Image</div>
                        <img src="/user_logo/{{ $user->user_img }}" alt="" srcset="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">User Image</div>
                        <input type="file" name="user_img" onchange="getImagePreview(event)" class="form-control" id="upload_file" placeholder="Enter Your Image.....">
                    </div>

                    <div id="preview" class="mt-3">

                    </div>
                </div>
            
             </div>
                <button class="btn btn-primary w-100 mt-4 mx-auto" type="submit">Update User</button>
        </form>
           
     </div>
   
    </div>
    <script>
        function getImagePreview(event){
          const img=URL.createObjectURL(event.target.files[0]);
          const imgDiv=document.getElementById('preview');
          const newImg=document.createElement('img');

          newImg.src=img;
          imgDiv.appendChild(newImg);
        }

        
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js" integrity="sha512-Z4QYNSc2DFv8LrhMEyarEP3rBkODBZT90RwUC7dYQYF29V4dfkh+8oYZHt0R6T3/KNv32/u0W6icGWUUk9V0jA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('layouts.js')
