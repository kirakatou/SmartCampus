<!DOCTYPE html>
<html>
<head>
	<title>Email Invoice</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,height=device-height">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="js/jquery.min.js">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="shortcut icon" type="image/png" href="image/icon/favicon.ico">

  	<style>
      body{
        font-family:Arial;
        width:100%;
      }
      .title img{
        width:45vh;
      }
      .box{
        margin-top:15vh;
        border:none;
        box-shadow: 0.45vh 0.45vh 0.45vh 0.45vh #e8e8e8;
        border:0.3vh solid #e8e8e8;
        width:55%;
        padding:2vh 0;
        font-size: 2vh;
      }
      .inv-title{
        color:#AAAAAA;
        letter-spacing: 0.3vh;
      }
      .inv-code{
        font-size: 3vh;
        letter-spacing: 0.2vh;
      }
      .inv-code hr{
        border:0.31vh solid #27A9E1;
      }
      .footer{
        margin-top:6vh;
        font-size:2vh;
        bottom:0;
        color:#AAAAAA;
        letter-spacing: 0.1vh;
      }
      table{
        border-collapse: separate;
        border-spacing: 1vh 3vh;
      }
      tr,td{
        padding:1vh 5vh;
      }
      th{
        padding:1vh 3vh;
      }
      td{
        border:0.35vh solid #e8e8e8;
      }

      @media only screen 
    and (min-device-width: 320px) 
    and (max-device-width: 736px)
    and (-webkit-min-device-pixel-ratio: 2) {
      .container{
        margin-top: 5vh;
      }
      .title img{
        width:35vh;
      }
      .box{
        width:90%;
      }
      .inv-title h2{
        font-size: 3vh;
        color:#AAAAAA;
        letter-spacing: 0.3vh;
      }
      .inv-code{
        font-size: 3vh;
        letter-spacing: 0.2vh;
      }
      .inv-code hr{
        border:0.31vh solid #27A9E1;
      }
      .footer{
        margin-top:6vh;
        font-size:2vh;
        bottom:0;
        color:#AAAAAA;
        letter-spacing: 0.1vh;
      }
      table{
        border-collapse: separate;
        border-spacing: 2vh 2vh;
      }
      tr,td{
        padding:1vh 2vh;
      }
      th{
        padding:1vh 1vh;
      }
      td{
        border:0.35vh solid #e8e8e8;
      }
    }

    </style>
</head>
<body>
<center>
<div class="container">
	<div class="title col-xs-12 col-sm-12 col-md-12">
		<h1><img src="{{ asset("images/icon/email-icon.png") }}"></h1>
	</div>
		<div class="box">
			<div class="inv-title">
				<h2>INVOICE</h2>
			</div>
			<div class="inv-content">
				<table>
						<tr><th class="inv-code">{{$no}}<hr></th></tr>
						<tr><th>Name</th><th> :</th><td>{{$name}}</td></tr>
						<tr><th>Event Name</th><th> :</th><td>{{$event_name}}</td></tr>
						<tr><th>Price</th><th> :</th><td>Rp. {{$price}},-</td></tr>
						<tr><th>Status</th><th> :</th><td>PENDING</td></tr>
						<tr><th>Valid Until</th><th> :</th><td>{{$valid_date}}</td></tr>
				</table>
			</div>
		</div>
	
	<div class="footer col-xs-12 col-sm-12 col-md-12">
		<p>&copy;2017 SMARTCAMPUS</p>
	</div>
</div>
</center>
</body>
</html>