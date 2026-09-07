<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RYSE') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<style>
    body{
        margin: 0;
        background-color: #07182f;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    .hero-section{    
        min-height: 100vh; 
        margin: 0;
        background-image:
        linear-gradient(to right, #ffffff 0%, #ffffffa9 35%, rgba(255, 255, 255, 0) 70%),
        url("{{ asset('images/background.jpg') }}");
        
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding-bottom: 60px;
    }
    h1 {
        font-weight: 500;
        font-size: 85px;
        padding: 0px 80px;
        color: #07182f;
        margin-top: 80px;
        margin-bottom: 0px;
        line-height: 1; 
    }
    p.hero-text{
      font-size: 18px;
      padding: 0px 85px;
      color: #0e0d47a1; 
      margin-top: 50px;
      margin-bottom: 30px; 
    }
    a.aboutUs-btn {
        font-size: 20px;
        background-color: transparent; 
        padding: 10px 50px; 
        border-radius: 50px;
        color: #135db2be;
        text-decoration: none;
        margin-left: 85px;
        display: inline-block;
        border: 2px solid #135db2be;
    }
    a.services-btn {
        font-size: 20px;
        background-color: #135db2be; 
        padding: 12px 55px; 
        border-radius: 50px;
        color: #ffff;
        text-decoration: none;
        margin-left: 18px;
        display: inline-block;
        border: 2px;
    }
    .aboutUs-btn:hover{
        color: rgba(49, 134, 231, 0.81);
        border: 2px solid rgba(49, 134, 231, 0.81);
    }
    .services-btn:hover{
        background-color: rgba(49, 134, 231, 0.81);
    }
    .cards-container{
        display: flex;
        justify-content: flex-start;
        gap: 24px;
        padding: 0 85px 80px 85px;
        max-width: 1200px;
        margin: -60px auto 0 auto;
        position: relative;
        z-index: 10;
    }
    .card{
        flex: 1;
        max-width: 360px;
        width: 100%;
        background-color: #0b1f38;
        border-radius: 6px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    }
    .card-image{
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    .card-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-fit: cover;
    }
    .card-body{
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .card-header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }
    .card-header h3{
        font-family: 'Segoe UI', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }
    .card-body p.card-text{
        font-family: 'Segoe UI', sans-serif;
        font-size: 13px;
        color: #94a3b8;
        padding: 0;
        margin: 0 0 24px 0;
        line-height: 1.5;
    }
    .card-btn{
        align-self: flex-start;
        font-family: Inter, sans-serif;
        font-size: 12px;
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: 8px 18px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    .card-btn:hover{
        background-color: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
    }
</style>
<body>
    <div class="hero-section">
        @include('partials.header')
        <h1>Seamless User<br>Management</h1>
        <p class="hero-text">A tool that helps you handle user management smoothly,
        giving you full control over your everyday accounts.</p>
        <div class="hero-btns">
            <a href="#" class="aboutUs-btn">About Us</a>
            <a href="#" class="services-btn">Services</a>
        </div>
    </div>

    <div class="cards-container">

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('images/meeting.jpg')}}" alt="Meeting">
            </div>
            <div class="card-body">
                <div class="card-header">
                    <h3>Meeting</h3>
                </div>
                <p class="card-text">Tect here</p>
                <a href="#" class="card-btn">Learn More</a>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('images/meeting.jpg')}}" alt="Meeting">
            </div>
            <div class="card-body">
                <div class="card-header">
                    <h3>Meeting</h3>
                </div>
                <p class="card-text">Tect here</p>
                <a href="#" class="card-btn">Learn More</a>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('images/meeting.jpg')}}" alt="Meeting">
            </div>
            <div class="card-body">
                <div class="card-header">
                    <h3>Meeting</h3>
                </div>
                <p class="card-text">Tect here</p>
                <a href="#" class="card-btn">Learn More</a>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>

</html>
