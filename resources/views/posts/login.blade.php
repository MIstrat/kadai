<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <div style="text-align:center;" class="title">
            <h1>Home</h1>
            </div>
        <form action="/login" method="POST">
            @csrf
            <div style="text-align:center;" class="email">
                 <h2>メールアドレス</h2>
                 <input type="text" name="information[email]" placeholder="メールアドレス" value="{{ old('information.email') }}"/>
                 <p class="email-error" style="color:red">{{ $errors->first('information.email') }}</p>
            </div>
            <div style="text-align:center;" class="address">
                 <h2>住所</h2>
                 <input type="text" name="information[address]" placeholder="住所" value="{{ old('information.address') }}"/>
                 <p class="address-error" style="color:red">{{ $errors->first('information.address') }}</p>
            </div>
             <div style="text-align:center;" class="TEL">
                 <h2>電話番号</h2>
                 <input type="text" name="information[TEL]" placeholder="電話番号" value="{{ old('information.TEL') }}"/>
                 <p class="TEL-error" style="color:red">{{ $errors->first('information.TEL') }}</p>
            
            <div style="text-align:center;" class="login-button">
            <input type="submit" value="登録"/>
            </div>
            
            
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
        </x-app-layout>
        
       
    </body>
</html>