@extends('web.layouts.entrance')
@section('title')
    登录
@stop
@section('content')
    <form action="{{url('login')}}" method="post">
        {{csrf_field()}}
        <div class="error">{{ Session::get('error') }}</div>
        <div class="user-name">

            <input type="text" name="username" id="user" placeholder="手机号码">
        </div>
        <div class="user-pass">

            <input type="password" name="password" id="password" placeholder="请输入密码">
        </div>

    </form>
    <div class="login-links">
        {{--<label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>--}}
        <a href="{{url('forgetPwd')}}" class="am-fr">忘记密码</a>
        {{--<a href="register.html" class="zcnext am-fr am-btn-default">注册</a>--}}
        <br/>
    </div>
    <div class="am-cf">
        <input type="submit" name="" id="form_submit" onclick="Common.submit(this)" value="登 录" class="am-btn am-btn-primary am-btn-sm">
    </div>
@stop
@section('js')
    {{--<script type="text/javascript" src="js/web/common.js"></script>--}}
    <script type="text/javascript">
       var formPost="{{url('login')}}";
       var url="{{url('/')}}";

    </script>
@stop
