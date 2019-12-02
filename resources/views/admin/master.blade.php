<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.top')
    <!-- End css -->
</head>
<body class="vertical-layout">
<!-- Start Infobar Setting Sidebar -->
@include('admin.layout.infobar')
<!-- End Infobar Setting Sidebar -->
<!-- Start Containerbar -->
<div id="containerbar">
    <!-- Start Leftbar -->
   @include('admin.layout.leftbar')
    <!-- End Leftbar -->
    <!-- Start Rightbar -->
    <div class="rightbar">
 @include('admin.layout.topbar')
@yield('content')
@include('admin.layout.footbar')
    </div>
    <!-- End Rightbar -->
</div>
<!-- End Containerbar -->
@include('admin.layout.bottom')
</body>
</html>
