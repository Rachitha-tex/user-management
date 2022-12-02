@extends('layouts.css')
@section('title','Home Page')
      @include('layouts.navbar')
<style>
    .errors {
  color: #F00;
}
</style>
    @include('sweetalert::alert')

    <div class="container">
        <h2 class="text-center mt-4">User Registration</h2>
        
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" name="registration" id="signupForm">
            @csrf
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">ID Number <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" id="nic" name="id_number" class="form-control" placeholder="Enter ID Number....." value="{{ old('id_number') }}">
                        <p id="msg" class="text-danger mt-2">

                        </p>
                        @error('id_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Date of Birth <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="date" id="dob" name="dob" class="form-control" placeholder="Enter Date of Birth....." >
                        @error('dob')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Age <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" class="form-control" name="age" placeholder="Enter Age...."  id="age">
                    </div>
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                     @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">User Name <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" name="name" class="form-control" placeholder="Enter User Name....." value="{{ old('name') }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Contact Number <i class="fa-solid fa-star-of-life"></i></div>
                        <input type="text" name="pnumber" class="form-control" placeholder="Contact Number....." value="{{ old('pnumber') }}">
                        @error('pnumber')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Address</div>
                        <input type="text" name="address" class="form-control" placeholder="Enter Your Address....." value="{{ old('address') }}">
                    </div>
                </div>
        
             </div>
             <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-label fw-bold">Religion</div>
                        <select class="form-select" aria-label="Default select example" name="religion">
                            <option selected>Select Your Religion</option>
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
                            <option selected>Select Your Nationality</option>
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
                        <div class="form-label fw-bold">User Image</div>
                        <input type="file" name="user_img" onchange="getImagePreview(event)" class="form-control" id="upload_file" placeholder="Enter Your Image.....">
                    </div>
                    <div id="preview" class="mt-3">

                    </div>
                </div>
             </div>
                <button class="btn btn-primary w-100 mt-4 mx-auto" type="submit">Submit</button>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>
        $(document).ready(function () {
    $('#dob').change(function () {
                var now = new Date();   //Current Date
                var past = new Date($('#dob').val());  //Date of Birth
                if (past > now) {
                    alert('Entered Date is Greater than Current Date');
                    return false;
                }
                var nowYear = now.getFullYear();  //Get current year
                var pastYear = past.getFullYear();//Get Date of Birth year
                var age = nowYear - pastYear;  //calculate the difference
                $('#age').val(age);
            })
    })
    </script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $().ready(function(){
        $('#signupForm').validate({
            errorClass: 'errors',
            rules:{
              id_number:{
                required:true,
                minlength:10
              }
            },
            messages:{
                id_number:{
                    required:"Please Enter valid ID Number",
                    minlength:'Your ID number must be contain 10 digits'
                }
            }
        })
    })
</script>

@include('layouts.js')
