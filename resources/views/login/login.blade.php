@include('login.layouts.header')
    <div class="logo"><img src="{{url('design')}}/imgs/logo.png"/>
        <span style="color:#2ecc71;">h<font color="#e74c3c">4</font><font color="#ecf0f1">r</font><font color="#f1c40f">e </font><font color="#3498db">M</font><font color="#e67e22">y </font><font color="#bdc3c7">P</font><font color="#9b59b6">!</font><font color="#1abc9c">c</font>
        </span>
    </div>
    <login></login>
    <div class='reg'><h1><a href='{{url('register')}}'>or you can Register</a></h1></div>
@include('login.layouts.footer')