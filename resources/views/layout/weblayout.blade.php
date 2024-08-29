<!DOCTYPE html>
<html lang="en">
<head>
@include('layout.webpartials.head')
</head>
<body>
@include('layout.webpartials.header') 
@yield('content')
@include('layout.webpartials.footer') 
</body>
</html>