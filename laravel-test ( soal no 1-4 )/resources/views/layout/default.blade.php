<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield("title")</title>
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">  
  <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
  <style>
     .parsley-errors-list{
      color:red;
      list-style:none;
      padding:8px;
      opacity: 0.8;
     }
  </style>
  @yield("sc_header")
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="collapse navbar-collapse">
   <ul class="navbar-nav mr-auto"
      style="z-index:10001">
      <li class="nav-item">                
        <a href="{{route('location.index')}}" class="nav-link">      
          Location
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('employee.index')}}" class="nav-link">      
        Employee
        </a>
      </li>
    </li>
   </ul>
  </div>
</nav>

@yield("content")

<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/dist/js/toastr.min.js')}}"></script>

<!-- JIKA ADA SESSION SUCCESS DARI SERVER -->
@if(Session::has("fallback")) 
  @if(Session::get('fallback')['status'] == "success")
    <script>
        toastr.success(
          "{{Session::get('fallback')['message']}}",
          "Berhasil"
        );
    </script>
  @endif

  @if(Session::get('fallback')['status'] == "failed")
    <script>
      toastr.error(
          "{{Session::get('fallback')['message']}}",
          "Terjadi Kesalahan"
      )
    </script>
  @endif
@endif


@yield("sc_footer")
</body>
</html>
