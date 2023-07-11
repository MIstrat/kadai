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
            <br>
            </div>
            @foreach($post as $posts)
            <form action="/index" method="POST">
            @csrf
            <div style="text-align:center;" class="posts-email">
                 <h2>メールアドレス</h2>
                 <input type="text" name="posts[email]" placeholder="{{ $posts->email }}" value="{{ old('posts.email') }}"/>
                 <p class="email-error" style="color:red">{{ $errors->first('spost.email') }}</p>
            </div>
            <br>
            <div style="text-align:center;" class="posts-address">
                 <h2>住所</h2>
                 <input type="text" name="posts[address]" placeholder="{{ $posts->address }}" value="{{ old('posts.address') }}"/>
                 <p class="address-error" style="color:red">{{ $errors->first('post.address') }}</p>
            </div>
            <br>
             <div style="text-align:center;" class="posts-tel">
                 <h2>電話番号</h2>
                 <input type="text" name="posts[tel]" placeholder="{{ $posts->tel }}" value="{{ old('posts.tel') }}"/>
                 <p class="tel-error" style="color:red">{{ $errors->first('post.tel') }}</p>
            </div>
            <div>
                <input type="hidden" name="posts[user_id]" value="{{ $posts->user_id }}">
            </div>
             <div>
                <input type="hidden" name="posts[site_id]" value="{{ $posts->site_id }}">
            </div>
            @endforeach
            <br>
            <div style="text-align:center;" class="save-button">
            <input type="submit" value="保存"/>
            <br>
            <div style="text-align:center;" class="sitesave-button">
            <input type="submit" value="サイト情報を保存" href='/index/edit/siteedit'  />
            
            </form>
            
            </div>
            <div class="footer">
                <a href="/index">戻る</a>
            </div>
            
        
       
    </body>
     </x-app-layout>
</html>