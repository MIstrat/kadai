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
            @foreach($site as $sites)
            <form action="/index" method="POST">
            @csrf
            <div style="text-align:center;" class="posts-email">
                 <h2>サイト名</h2>
                 <input type="text" name="sites[name]" placeholder="{{ $sites->name }}" value="{{ old('sites.name') }}"/>
                 <p class="email-error" style="color:red">{{ $errors->first('sites.name') }}</p>
            </div>
            <br>
            <div style="text-align:center;" class="posts-address">
                 <h2>URL</h2>
                 <input type="text" name="sites[address]" placeholder="{{ $sites->address }}" value="{{ old('sites.address') }}"/>
                 <p class="address-error" style="color:red">{{ $errors->first('sites.address') }}</p>
            </div>
            <br>
            <div>
                <input type="hidden" name="posts[id]" value="{{ $posts->id }}">
            </div>
             <div>
                <input type="hidden" name="posts[site_id]" value="{{ $posts->site_id }}">
            </div>
            @endforeach
            <br>
            <div style="text-align:center;" class="login-button">
            <input type="submit" value="保存"/>
            
            </form>
            
            </div>
            <div class="footer">
                <a href="/index">戻る</a>
            </div>
            
        
       
    </body>
     </x-app-layout>
</html>