<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Trang quản trị')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      @include('admin.layouts.navbar')
      @include('admin.layouts.sidebar')
      <div class="content-wrapper">
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card card-primary mt-3">
                        <div class="card-header">
                           <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <div class="card-body">
                           @yield('content')</div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      @include('admin.layouts.footer')
   </div>
   @include('admin.layouts.javascript')
</body>

</html>