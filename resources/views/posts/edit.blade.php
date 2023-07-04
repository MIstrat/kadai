<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        
            <div style="text-align:center;" class="title">
            <h1>Home</h1>
            </div>
        <form action="/login" method="POST">
            @csrf
            <div style="text-align:center;" class="login-address">
                 <h2>メールアドレス</h2>
                 <input type="text" name="login[email]" placeholder="メールアドレス" value="{{ old('post.email') }}"/>
                 <p class="email-error" style="color:red">{{ $errors->first('login.email') }}</p>
            </div>
            <div style="text-align:center;" class="login-pass">
                 <h2>パスワード</h2>
                 <input type="text" name="login[password]" placeholder="パスワード" value="{{ old('post.password') }}"/>
                 <p class="password-error" style="color:red">{{ $errors->first('login.password') }}</p>
            </div>
            <br>
            <div style="text-align:center;" class="login-button">
            <input type="submit" value="ログイン"/>
            </div>
            
            
        </form>
       
    </body>
     </x-app-layout>
</html>