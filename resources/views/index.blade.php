<!DOCTYPE html>
<html>
    <head>
        <title>Smart Campus</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(this).scrollTop(0);
                $("a").on('click', function (event) {
                    if (this.hash !== "") {
                        event.preventDefault();
                        var hash = this.hash;
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 800, function () {
                            window.location.hash = hash;
                        });
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".registerbutton").click(function () {
                    $(".panel").toggle("slow");
                });

                $(document).scroll(function () {
                    var UID = {
                        _current: 0,
                        getNew: function () {
                            this._current++;
                            return this._current;
                        }
                    };
                    HTMLElement.prototype.pseudoStyle = function (element, prop, value) {
                        var _this = this;
                        var _sheetId = "pseudoStyles";
                        var _head = document.head || document.getElementsByTagName('head')[0];
                        var _sheet = document.getElementById(_sheetId) || document.createElement('style');
                        _sheet.id = _sheetId;
                        var className = "pseudoStyle" + UID.getNew();
                        _this.className += " " + className;
                        _sheet.innerHTML += " ." + className + ":" + element + "{" + prop + ":" + value + "}";
                        _head.appendChild(_sheet);
                        return this;
                    };

                    var navtext1 = document.getElementById("nav-text1");
                    var navtext2 = document.getElementById("nav-text2");
                    var navtext3 = document.getElementById("nav-text3");
                    var mq = window.matchMedia("(max-device-width: 568px)");

                    function opacity() {
                        document.getElementById("nav").style.background = "white";
                        document.getElementById("nav").style.boxShadow = "0 4px 4px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1)";
                        navtext1.style.color = "grey";
                        navtext1.pseudoStyle("after", "background", "grey");
                        navtext2.style.color = "grey";
                        navtext2.pseudoStyle("after", "background", "grey");
                        navtext3.style.color = "grey";
                        navtext3.pseudoStyle("after", "background", "grey");
                        document.getElementById("logo").src = "images/icon/logoblack-01.png";
                        document.getElementById("features").style.opacity = "1";
                        document.getElementById("bar1").style.background = "black";
                        document.getElementById("bar2").style.background = "black";
                        document.getElementById("bar3").style.background = "black";

                        if (mq.matches) {
                            document.getElementById("myNavbar").style.backgroundColor = "rgba(255, 255, 255,0.9)";
                            document.getElementById("close").style.color = "grey";
                        }

                    }

                    function opacity1() {
                        document.getElementById("events").style.opacity = "1";
                    }
                    
                    var docScroll = $(document).scrollTop(),
                            distance = $(".container-features").offset().top - 300;
                    distance1 = $(".container-events").offset().top - 400;

                    if (docScroll >= distance) {
                        setTimeout(opacity, 100);
                    }
                    if (docScroll >= distance1) {
                        setTimeout(opacity1, 100);
                    } else if (docScroll <= distance) {
                        document.getElementById("nav").style.background = "none";
                        document.getElementById("nav").style.boxShadow = "none";
                        navtext1.style.color = "white";
                        navtext1.pseudoStyle("after", "background", "white");
                        navtext2.style.color = "white";
                        navtext2.pseudoStyle("after", "background", "white");
                        navtext3.style.color = "white";
                        navtext3.pseudoStyle("after", "background", "white");
                        document.getElementById("logo").src = "images/icon/logo-01.png";
                        document.getElementById("features").style.opacity = "0";
                        document.getElementById("events").style.opacity = "0";
                        document.getElementById("bar1").style.background = "white";
                        document.getElementById("bar2").style.background = "white";
                        document.getElementById("bar3").style.background = "white";
                        if (mq.matches) {
                            document.getElementById("myNavbar").style.backgroundColor = "rgba(255, 255, 255,0.9)";
                            document.getElementById("close").style.color = "grey";
                            navtext1.style.color = "grey";
                            navtext2.style.color = "grey";
                            navtext3.style.color = "grey";
                        }
                    }

                })
            });
        </script>

        <link rel="shortcut icon" type="image/png" href="images/icon/favicon.ico">

        <style>
            body{
                font-family:Corbel;
            }
            .container{
                background-image:url("images/background/bg.jpg");
                background-size:cover;
                width:100%;
                height:100%;
                padding:0;
                margin:0;
            }
            .content{
                padding:2% 0% 5% 0%;
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
            .title{
                padding:180px 0 100px 0;
                color:white;
                font-family:"Geomanist";
            }
            .title h1{
                font-size:10vw;
                letter-spacing: 10px;
            }
            .title h3{
                margin-top:40px;
                font-family:"Corbel";
                font-size:2.5vw;
                letter-spacing: 5px;
            }
            .button a{
                color:white;
                padding:5px 40px 5px 40px;
                background-color:none;
                border:1px solid white;
                font-size:25px;
                transition:0.3s;
                text-decoration:none; 
            }
            .button a:hover{
                color:#00ace6;
                background-color:white;
            }
            .container-features{
                transition:0.5s;
                margin-top:10%;
            }
            .container-events{
                transition:0.5s;
                margin-top:50%;
            }
            .features-title , .events-title{
                margin-top:9%;
                font-family:"Geomanist";
                letter-spacing: 10px;
                transition: 0.5s;
            }
            .features-title hr , .events-title hr{
                width:10%;
                border:2px solid #3c79bd;
            }
            .features-menu img{
                max-width:15%;
                max-height:15%;
            }
            .features-menu h3{
                color:#3c79bd;
            }
            .features-menu hr{
                border:0.2px solid grey;
            }
            .features-menu p{
                width:90%;
                letter-spacing: 0px;
                font-family:Corbel;
                font-size:14px;
                margin-bottom:20px;
                color:black;
            }
            .features-menu .menu{
                margin-top:50px;
            }
            .features-menu .menu , .events-menu .list{
                border:2px solid white;
                transition:0.3s;
                padding:4% 0 4% 0;
            }
            .features-menu .menu:hover , .events-menu .list-content:hover{
                box-shadow: 0px 2px 4px 4px rgba(60, 121, 189 ,0.3), 0 6px 20px 0 rgba(60, 121, 189, 0.1);
            }
            .available{
                margin-top: 30px;
                padding:0.05% 0 0.1% 0;
                background-image:url("images/background/bg.jpg");
                background-size:cover;
                color:white;
            }
            .list-content{
                width:80%;
                transition:0.5s;
            }
            #events1{
                color:white;
                background-color:#ef4076;
                padding:15% 0 15% 0;
                margin:0;
            }
            #events2{
                color:white;
                background-color:#f0992a;
                padding:15% 0 15% 0;
                margin:0;
            }
            #events3{
                color:white;
                background-color:#65cce7;
                padding:15% 0 15% 0;
                margin:0;
            }
            .list-content{
                border:1px solid rgba(60, 121, 189 ,0.3);
            }
            .list-content .faculty .IS{
                padding:1% 10% 1% 10%;
                background-color: #ed9827;
            }
            .list-content .faculty .LAW{
                background-color: #ff4d4d;
            }
            .list-content .faculty .MGM{
                background-color: #4da6ff;
            }
            .list-content .faculty .ACC{
                background-color: #73bf43;
            }
            .list-content .faculty .HOS{
                background-color: #ac3939;
            }
            .list-content .faculty .PUB{
                background-color: #aa56a1;
            }
            .list-content .faculty span{
                font-size:80%;
                border-radius: 35px;
                margin: auto;
                letter-spacing: 3px;
                color: white;
                text-align: center;
                padding:1% 8% 1% 8%;
            }
            .list-content .register{
                font-size:80%;
                font-family:Corbel;
                font-weight: bold;
                color:black;
                letter-spacing: 1px;
                margin-top:10px;
            }
            .list-content .date{
                margin:10px 0 15px 0;
                font-size:90%;
                color:#bb1f25;
            }

            .navbar-toggle{
                width:50px;
                height:50px;
                background-color:rgba(0,0,0,0.1);
            }
            .icon-bar{
                background: white;
                padding:1px 8px 1px 8px;
                margin:auto;
                transition:0.3s;
            }

            .overlay .closebtn ,.overlay1 .closebtn{
                opacity:0;
            }

            .overlay1{
                height: 0%;
                width: 100%;
                position: fixed;
                z-index: 2;
                top: 0;
                left: 0;
                background-color: rgba(255,255,255, 0.95);
                overflow-y: hidden;
                transition:0.8s;
                opacity:0;
                color:grey;
            }

            .overlay1 {overflow-y: auto;}
            .overlay1 a {font-size: 20px}
            .overlay1 .closebtn {
                font-size: 20px;
                color:grey;
                opacity: 1;
                text-decoration: none;
            }
            .overlay1 .eventdetails{
                padding:20px 0 20px 0;
                margin-top:100px;
                background-color: white;
                box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
            }
            .overlay1 .eventdetails img{
                width:40%;
                float:left;
            }
            .overlay1 .eventdetails .event-content{
                float:right;
            }
            .overlay1 .eventdetails .event-content h1{
                letter-spacing: 5px;
            }
            #eventhr1{
                border:2px solid #ef4076;
            }
            #eventhr2{
                border:2px solid #f0992a;
            }
            #eventhr3{
                border:2px solid #65cce7;
            }
            .overlay1 .eventdetails .closebtn{
                float:right;
            }
            .overlay1 .eventdetails .event-content button{
                border-radius: 5px;
                background:none;
                font-size:20px;
                padding:0px 50px 0 50px;
                bottom:0%;
                letter-spacing: 5px;
                margin-top: 45px;
                transition: 0.5s;
            }
            #registerstudent{
                border:1px solid #0db4dd;
                color:#0db4dd;
                width:45%;
                font-size: 15px;
                text-align: center;
                padding:0px 1px 0px 1px;
                margin:5px 5px 5px 5px;
            }
            #registerstudent:hover{
                background-color: #0db4dd;
                color:white;
            }
            #registerguest{
                border:1px solid #0caf4d;
                color:#0caf4d;
                width:40%;
                font-size: 15px;
                text-align: center;
                padding:0px 1px 0px 1px;
                margin:5px 5px 5px 5px;
            }
            #registerguest:hover{
                background-color: #0caf4d;
                color:white;
            }
            #registerbutton1{
                border:1px solid #ef4076;
                color:#ef4076;
            }
            #registerbutton1:hover{
                background-color: #ef4076;
                color:white;
            }
            #registerbutton2{
                border:1px solid #f0992a;
                color:#f0992a;
            }
            #registerbutton2:hover{
                background-color: #f0992a;
                color:white;
            }
            #registerbutton3{
                border:1px solid #65cce7;
                color:#65cce7;
            }
            #registerbutton3:hover{
                background-color: #65cce7;
                color:white;
            }
            .panel{
                margin-top:15px;
                display:none;
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

                .overlay1 .eventdetails img{
                    width:100%;
                    margin-top:50px;
                }
                .overlay1 .eventdetails .closebtn{
                    right:41%;
                }
                .overlay1 .eventdetails{
                    padding:0% 0% 5% 0%;
                    margin-top:100px;
                    background-color: white;
                    box-shadow:none;
                }
                .overlay1 .eventdetails .event-content button{
                    margin-bottom: 30px;
                }
            }

            @media only screen 
            and (min-device-width: 768px) 
            and (max-device-width: 1024px)
            and (-webkit-min-device-pixel-ratio: 2) {

                .overlay1 .eventdetails .event-content button{
                    margin-top: 30px;
                }
                .overlay1 .eventdetails{
                    padding:0% 0% 5% 0%;
                    margin-top:100px;
                    background-color: white;
                    box-shadow:none;
                }
                .available{
                    margin-top:80px;
                }
                .events-menu{
                    margin-top:80px;
                }
            }
        </style>
    </head>
    <body>
    <center>
        <div class="container" id="home">

            <div class="content" id="content">
                <div class="title col-xs-12 col-sm-12 col-md-12">
                    <h1>SMART CAMPUS</h1>
                    <h3>-THE NEW WAY OF INTERACTION-</h3>
                </div>
                <div class="button">
                    <a href="#features">EXPLORE</a>
                </div>
            </div>
        </div>

        <div class="container-features" id="features">
            <div class="features">
                <div class="content-features">
                    <div class="features-title col-xs-12 col-sm-12 col-md-12">
                        <h1>FEATURES</h1>
                        <hr>
                        <div class="features-menu">
                            <a href="#events"><div class="menu col-xs-12 col-sm-4 col-md-4">
                                    <img src="images/icon/events-01.svgz"><br><br>
                                    <h3>EVENTS</h3>
                                </div></a>
                            <a href="#events"><div class="menu col-xs-12 col-sm-4 col-md-4">
                                    <img src="images/icon/profile-01.svgz"><br><br>
                                    <h3>PROFILE</h3>
                                </div></a>
                            <a href="#events"><div class="menu col-xs-12 col-sm-4 col-md-4">
                                    <img src="images/icon/schedule-01.svgz"><br><br>
                                    <h3>SCHEDULE</h3>
                                </div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-events" >

            <div class="events">
                <div class="content-events">
                    <div class="overlay1">
                        <div class="col-md-2"></div>
                        <div class="eventdetails col-md-8">
                            <a href="javascript:void(0)" class="closebtn glyphicon glyphicon-remove col-md-2 col-xs-12" id="close" onclick="closeEvent()"></a>
                            <img src="images/seminar/SAP.jpg" class="col-xs-12 col-sm-4 col-md-4">
                            <div class="event-content col-xs-12 col-sm-4 col-md-4">
                                <h1>OREEDOO<hr id="eventhr1"></h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <button id="registerbutton1" class="registerbutton">REGISTER</button>
                                <div class="panel">
                                    <button id="registerstudent">STUDENT</button><button id="registerguest">GUEST</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="overlay1">
                        <div class="col-md-2"></div>
                        <div class="eventdetails col-md-8">
                            <a href="javascript:void(0)" class="closebtn glyphicon glyphicon-remove col-md-2 col-xs-12s" id="close" onclick="closeEvent()"></a>
                            <img src="images/seminar/SAP.jpg" class="col-xs-12 col-sm-4 col-md-4">
                            <div class="event-content col-xs-12 col-sm-4 col-md-4">
                                <h1>OREEDOO<hr id="eventhr2"></h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <button id="registerbutton2" class="registerbutton">REGISTER</button>
                                <div class="panel">
                                    <button id="registerstudent">STUDENT</button><button id="registerguest">GUEST</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="overlay1">
                        <div class="col-md-2"></div>
                        <div class="eventdetails col-md-8">
                            <a href="javascript:void(0)" class="closebtn glyphicon glyphicon-remove col-md-2 col-xs-12s" id="close" onclick="closeEvent()"></a>
                            <img src="images/seminar/SAP.jpg" class="col-xs-12 col-sm-4 col-md-4">
                            <div class="event-content col-xs-12 col-sm-4 col-md-4">
                                <h1>OREEDOO<hr id="eventhr3"></h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <button id="registerbutton3" class="registerbutton">REGISTER</button>
                                <div class="panel">
                                    <button id="registerstudent">STUDENT</button>
                                    <button id="registerguest">GUEST</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="events-title col-xs-12 col-sm-12 col-md-12" id="events">
                        <h1 class="eventstitle">EVENTS</h1>
                        <hr>
                        <div class="available"><h1>AVAILABLE</h1></div>
                        <center>
                            <div class="events-menu">
                              <a>
                                <div class="list col-xs-12 col-sm-4 col-md-4">
                                  <div class="list-content">
                                      <h3  id="events1">OREEDOO</h3><br>
                                      <div class="faculty">
                                          <span class="IS">IS</span>
                                          <span class="MGM">MGM</span>
                                          <span class="ACC">ACC</span>
                                      </div><br>
                                      <div class="register">REGISTERATION CLOSED AT</div>
                                      <div class="date">01-01-2017</div>
                                  </div>
                                </div>
                              </a>
                              <a>
                                <div class="list col-xs-12 col-sm-4 col-md-4">
                                  <div class="list-content">
                                      <h3 id="events2">OREEDOO</h3><br>
                                      <div class="faculty">
                                          <span class="LAW">LAW</span>
                                          <span class="HOS">HOS</span>
                                          <span class="PUB">PUB</span>
                                      </div><br>
                                      <div class="register">REGISTERATION CLOSED AT</div>
                                      <div class="date">01-01-2017</div>
                                  </div>
                                </div>
                              </a>
                              <a>
                                <div class="list col-xs-12 col-sm-4 col-md-4">
                                  <div class="list-content">
                                      <h3 id="events3">OREEDOO</h3><br>
                                      <div class="faculty">
                                          <span class="IS">LAW</span>
                                          <span class="ACC">ACC</span>
                                      </div><br>
                                      <div class="register">REGISTERATION CLOSED AT</div>
                                      <div class="date">01-01-2017</div>
                                  </div>
                                </div>
                              </a>
                            </div>
                        </center>
                    </div>
                </div>
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
                    <a class="logo navbar-brand" href="#home"><img id="logo" src="images/icon/logo-01.png"></a>
                </div>

                <div class="overlay" id="myNavbar">
                    <a href="javascript:void(0)" class="closebtn glyphicon glyphicon-remove-circle" id="close" onclick="closeNav()"></a>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="link" href="#features" id="nav-text1">FEATURES</a></li>
                        <li><a class="link" href="#" id="nav-text2">ABOUT</a></li>
                        @if (Route::has('login'))
                        @if (Auth::check())
                        <li><a class="link" href="#" id="nav-text3">PROFILE</a></li>
                        <li>
                            <a class="link"  id="nav-text4"
                               href="{{ url('/logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                LOGOUT
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" 
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @else
                        <li><a class="link" href="/login" id="nav-text3">LOGIN</a></li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <script>
            var mq = window.matchMedia("(max-device-width: 568px)");

            $( ".events-menu a" ).click(function() {
              var index = $( this ).index();
              selected = $(".overlay1")[index];
              selected.style.height = "100%"
              selected.style.opacity = "1";
            });

            function openNav() {
                if (mq.matches) {
                    document.getElementById("myNavbar").style.height = "100%";
                    document.getElementById("myNavbar").style.opacity = "1";
                }
            }

            function closeEvent() {
              $(".overlay1").css("height","0%");
              selected.css("opacity","0");
            }

            function closeNav() {
                if (mq.matches) {
                    document.getElementById("myNavbar").style.height = "0%";
                    document.getElementById("myNavbar").style.opacity = "0";
                }
            }
        </script>
    </center>
</body>
</html>