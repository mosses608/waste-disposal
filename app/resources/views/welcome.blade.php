@extends('layout')

@section('content')

<x-error-message />

<x-logout_flash_message />

<center>
    <form action="/authenticate" method="POST" class="_lgx-container-sub">
        @csrf
        <div class="image-slider-clxx-">
            <img src="{{asset('assets/images/logo-profile.png')}}" alt="Image Slider">
           <!--<img src="{{asset('assets/images/slider-img2.jpg')}}" alt="Image Slider">
            <img src="{{asset('assets/images/slider-img3.jpg')}}" alt="Image Slider">
            <img src="{{asset('assets/images/slider-img4.jpg')}}" alt="Image Slider">
            <img src="{{asset('assets/images/slider-img5.jpg')}}" alt="Image Slider">-->
        </div>

        <div class="form-container-data">
            <p>Waste Disposal Management System</p><br>
            <label for=""><i class="fa fa-user"></i> Username</label><br>
            <input type="text" name="username" id="" placeholder="Enter your username" value="{{old('username')}}"><br>
            @error('username')
            <span>Username is required!</span>
            @enderror
            <br>
            <label for=""><i class="fa fa-key"></i> Password</label><br>
            <input type="password" name="password" id="" placeholder="Enter your password"><br>
            @error('password')
            <span>Password is required!</span>
            @enderror
            <br>
            <button type="submit" class="submit-compone-x"><i class="fa fa-sign-in"></i> Login</button>
        </div>

    </form>

    <script>
        const imageSlider=document.querySelectorAll('.image-slider-clxx- img');
        const intervalTime=3000;
        let initialImageIndex=0;

        function showNextImage(){

            imageSlider[initialImageIndex].style.display='none';
            initialImageIndex++;

            if(initialImageIndex>=imageSlider.length){
                initialImageIndex=0;
            }

            imageSlider[initialImageIndex].style.display='block';
        }

        setInterval(showNextImage,intervalTime);
    </script>
</center>
@endsection

