<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/template/client/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="/template/client/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


</head>

<body>
    @include('client.layouts.header')
    @yield('content')
    @include('client.layouts.footer')
    @include('client.layouts.javascript')
    <!-- Biểu tượng Chat -->
    <div class="chat-icon bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" onclick="toggleChat()" style="width: 50px; height: 50px; position: fixed; bottom: 20px; right: 20px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <i class="fa-solid fa-headset"></i>
    </div>

    <!-- Form Chatbox -->
    <div id="chatbox" class="card position-fixed" style="bottom: 80px; right: 20px; width: 370px; display: none; z-index: 1000;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <b>FitSmart</b>
            <button type="button" class="btn-close btn-close-white" onclick="toggleChat()"></button>
        </div>
        <div class="card-body overflow-auto" id="chat-box" style="white-space: pre-line; max-height: 400px;"><div class="message ai-message">Chào mừng bạn đến với FitSmart!</div></div>
        <div class="card-footer d-flex">
            <input type="text" id="user-message" class="form-control me-2" placeholder="Nhập tin nhắn...">
            <button id="send-button" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i></button>
        </div>
    </div>
</body>

</html>