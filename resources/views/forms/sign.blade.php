@extends('layouts.template')
@section('css')
<style type="text/css">

#main{
    margin: 15px auto;
    background:white;
    overflow: auto;
  width: 100%;
}
#header{
    background:white;
    margin-bottom:15px;
}
#mainbody{
    background: white;
    width:100%;
  display:none;
}
#footer{
    background:white;
}
#v{
    width:320px;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
  margin-left:35px;
  margin-right:35px;
  padding-top:10px;
  padding-bottom:10px;
  border-radius:20px;
}
.selector{
    margin:0;
    padding:0;
    cursor:pointer;
    margin-bottom:-5px;
}
#outdiv
{
    width:320px;
    height:240px;
  border: solid;
  border-width: 3px 3px 3px 3px;
}
#result{
    border: solid;
  border-width: 1px 1px 1px 1px;
  padding:20px;
  width:70%;
  margin-top: 20px;
}


</style>

@stop
@section('pageContent')




<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">         
            <div class="item form-group ">
              <div class="x_title">
                  <h1 class="text-center">{{$event->name}}</h1>
                  <div class="clearfix"></div>
              </div>
              <table class="tsel" border="0" width="100%">
                <tr>
                  <td valign="top" align="center" width="50%">
                    <table class="tsel" border="0">
                      <tr>
                        <td><img class="selector" id="webcamimg" src="vid.png" onclick="setwebcam()" align="left" /></td>
                        <td><img class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right"/></td></tr>
                      <tr>
                        <td colspan="2" align="center">
                          <div id="outdiv">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" align="center">
                    <div id="result"></div>
                  </td>
                </tr>
                

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
@stop
@section('js')
<script type="text/javascript" src="{{ asset("js/llqrcode.js") }}"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="{{ asset("js/webqr.js") }}"></script>
<script type="text/javascript">

  @if($type == 'in')
    route = 'signin/{{ $event->id }}/';
  @else 
    route = 'signout/{{ $event->id }}/';
  @endif 
  function read(a)
  {
    document.getElementById("result").innerHTML= "<br>" + route + a + "</br>";
    jQuery( document ).ready( function( $ ) {
      $.ajax({
          type: "POST",
          url: '/admin/event/' + route + a,
          data: {
            "_method": "post",
            "_token": "{{ csrf_token() }}",
          },
          beforeSend: function(jqXHR, settings) {
              console.log(settings.url);
          },
          success: function(data) {
            if(data.status == 'success'){
              document.getElementById("result").innerHTML= "<br>" + data.profile.name + "</br>";
              swal("Done!");
            }else {
              swal('Not Registered');
            }
          },
          error: function(data, textStatus, xhr) {
            console.log("error", data.status);
            console.log("STATUS: "+xhr);
          }
      });
    });
    
  } 

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24451557-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">load();</script>
@stop