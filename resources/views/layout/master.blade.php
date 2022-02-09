<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css2/bootstrap.min.css')}}">
    
	<title>@yield('title')</title>
   <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

	
  <style>
 @import url('https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i');

    body{
      /*background:#20c997;*/
      margin-bottom: 10px;
       font-family: 'Muli', sans-serif;
     /*background:#ddd;*/
      
    }
    
    * {box-sizing:border-box}
.topnav {
  background-color: #333;
  overflow: hidden;
  margin-top: 40px;
  
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.cartcount{
    background: brown;
    padding: 2px;
    border-radius: 50%;
    margin-top: -10px;
    margin-left: -5px;
    position: absolute;
    font-size: 10px;
    width: 20px;
    height: 20px;
}

  </style>


	@yield('links')
  
</head>
<body>
	<div class="container">
@include('layout.header')
@yield('content')
@include('layout.footer')
</div>
@yield('script') 
</body>
</html>