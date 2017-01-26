<!DOCTYPE html>
<html lang="en">
<head>
    <title>SmartCampus | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="js/jquery.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="images/icon/favicon.ico">
    <style>
        body{
           font-family:Corbel;
           background-image:url("images/background/bg.jpg");
           background-size:cover;
        }
        .container{ 
          width:100%;
          height:100%;
          padding-bottom:3.25%;
          margin:0;
        }
        .header{
          transition:0.5s;
        }
        .link{
          display:inline-block;
          color:white;
          letter-spacing: 3px;
          padding:0% 2% 0% 2%;
          text-decoration: none;
        }
        .link:hover{
          color:white;
          background-color: none;
        }
        .link:after{
          content:"";
          display: block;
          width:0;
          height:2px;
          background:white;
          transition: width .3s;
          color:white;
        }
        .link:hover:after{
          width:100%;
        }
        .nav ul{
          margin-top:10px;
          padding: 0% 0% 0% 30%;
        }
        .nav li{
          display:inline;
          margin-top:10px;
        }
        .nav li a{
          background:none;
          transition:0.5s;
        }
        .nav li a:hover{
          background:none;
        }
        .logo img{
          max-width:300%;
          max-height:300%;
          margin-top:-13px;
        }
        .login-button{
            border:none;
            background-color: lightblue;
            color: white;
            font-size:120%;
        }
        .loginform{
            margin-top:180px;
            width:90%;
            letter-spacing: 3px;
        }
        .loginform .login{
            background:white;
            border-radius:10px;
            padding:10px 0 40px 0;
        }
        .loginname{
            width:50%;
        }
        .loginname hr{
            width:30%;
            border:1px solid black;
            margin-top:15px;
        }
        .loginform .form{
            padding:10px;
        }
        .form .username , .form .password{
            margin-top:10px;
            padding:2% 0 2% 0;
      border:1px solid rgba(75,76,76,0.3);
        }
        .login-button{
            margin-top:20px;
            color:white;
        border:none;
        background:#6bcdee;
        padding: 5% 0 5% 0;
        transition:0.3s;
        letter-spacing: 3px;
         }
         .form a{
            color:grey;
            letter-spacing: 2px;
            text-decoration:none;
            font-size:110%;
            transition: 0.3s;
         }
         .form a:hover{
            color:#6bcdee;
         }
     .navbar-toggle{
      width:50px;
      height:50px;
      background-color:rgba(0,0,0,0.1);
     }
     .icon-bar{
      background-color: white;
      padding:1px 8px 1px 8px;
      margin:auto;
     }
     .overlay .closebtn{
        opacity:0;
        }

       @media only screen 
    and (min-device-width: 320px) 
    and (max-device-width: 568px)
    and (-webkit-min-device-pixel-ratio: 2) {
      .overlay{
        height: 0%;
        width: 100%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgba(255,255,255, 0.9);
        overflow-y: hidden;
        transition:0.8s;
        opacity:0;
        color:grey;
      }
      .content{
        padding:10% 0 25% 0;
      }
      .title h1{
        font-size:15vw;
      }
      .title h3{
        font-size:3.5vw;
      }
      .features-title h1{
        margin-top:15%;
      }
      .eventstitle{
        margin-top:50%;
      }
      .nav{
        position: relative;
        top: 25%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
      }
      .nav li{
        border: 1px solid grey;
      }
      .nav li a{
        color:grey;
      }
      .overlay {overflow-y: auto;}
      .overlay a {font-size: 20px}
      .overlay .closebtn {
        font-size: 40px;
        top: 20px;
        color:grey;
        opacity: 1;
        text-decoration: none;
      }
    }
    </style>
</head>
<body>
<center>
<div class="container">
<div id="login" class="loginform">
<div class="col-sm-4 col-md-4"></div>
      <div class="login col-xs-12 col-sm-4 col-md-4">
      <div class="loginname"><h3>LOGIN<hr></h3></div>
        <table>
          <form method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}
            <tr>
              <td>
                <span class="form col-xs-12 col-sm-12 col-md-12">
                  <span class="col-xs-12 col-sm-12 col-md-6">USERNAME</span>
                  <input type="text" name="username" class="username col-xs-12 col-sm-12 col-md-12" 
                          value="{{ old('username') }}"required autofocus>
                  @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <span class="form col-xs-12 col-sm-12 col-md-12">
                  <span class="col-xs-12 col-sm-12 col-md-6">PASSWORD</span>
                  <input type="password" name="password" class="password col-xs-12 col-sm-12 col-md-12" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <span class="form col-xs-12 col-sm-12 col-md-12">
                    <input type="submit" id="login" value="LOGIN" class="login-button col-xs-12 col-sm-12 col-md-12">
                </span>
              </td>
            </tr>

            <tr>
              <td>
                <span class="form col-xs-12 col-sm-12 col-md-12">
                  <center>
                    <a class="forgot col-xs-12 col-sm-12 col-md-12" href="{{ url('/password/reset') }}">Forgot Password?</a>
                  </center>
                </span>
              </td>
            </tr>
          </form>
        </table>
      </div>
  </div>

<nav class=" header navbar navbar-fixed-top" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" onclick="openNav()">
          <span class="icon-bar" id="bar1"></span>
          <span class="icon-bar" id="bar2"></span>
          <span class="icon-bar" id="bar3"></span> 
      </button>
      <a class="logo navbar-brand" href="index.html"><img id="logo" src="images/icon/logo-01.png"></a>
    </div>

    <div class="overlay" id="myNavbar">
    <a href="javascript:void(0)" class="closebtn glyphicon glyphicon-remove-circle" id="close" onclick="closeNav()"></a>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="link" href="index.html#features" id="nav-text1" onclick="closeNav()">FEATURES</a></li>
        <li><a class="link" href="#" id="nav-text2" onclick="closeNav()">ABOUT</a></li>
        <li><a class="link" href="login.html" id="nav-text3" onclick="closeNav()">LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>
<script>
var mq = window.matchMedia( "(max-device-width: 568px)" );

function openNav() {
  if(mq.matches){
    document.getElementById("myNavbar").style.height = "100%";
    document.getElementById("myNavbar").style.opacity = "1";
  }
}

function closeNav() {
  if(mq.matches){
    document.getElementById("myNavbar").style.height = "0%";
    document.getElementById("myNavbar").style.opacity = "0";
  }
}
</script>
</center>
</div>
</body>
</html>