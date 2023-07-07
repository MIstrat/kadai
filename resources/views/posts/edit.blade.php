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
            <h1>個人情報編集</h1>
            </div>
            <form action="/" method="POST">
            @csrf
            <div style="text-align:center;" class="post-email">
                 <h2>メールアドレス</h2>
                 <input type="text" name="posts[email]" placeholder="{{ $posts->find(1)->email }}" value="{{ old('post.email') }}"/>
                 <p class="email-error" style="color:red">{{ $errors->first('spost.email') }}</p>
            </div>
            <br>
            <div style="text-align:center;" class="posts-address">
                 <h2>住所</h2>
                 <input type="text" name="posts[address]" placeholder="{{ $posts->find(1)->address }}" value="{{ old('post.address') }}"/>
                 <p class="address-error" style="color:red">{{ $errors->first('post.address') }}</p>
            </div>
            <br>
             <div style="text-align:center;" class="posts-tel">
                 <h2>電話番号</h2>
                 <input type="text" name="posts[tel]" placeholder="{{ $posts->find(1)->tel }}" value="{{ old('post.tel') }}"/>
                 <p class="tel-error" style="color:red">{{ $errors->first('post.tel') }}</p>
            </div>
            
            <br>
            <div style="text-align:center;" class="login-button">
            <input type="submit" value="保存"/>
            </div>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
            
        </form>
       
    </body>
     </x-app-layout>
</html>