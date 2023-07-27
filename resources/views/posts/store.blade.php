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
           
            <form action="/index" method="POST">
                @csrf
                    <div style="text-align:center;" class="post-email">
                        <h2>メールアドレス</h2>
                        <input type="text" name="post[email]" >
                        <p class="email-error" style="color:red">{{ $errors->first('post.email') }}</p>
                    </div>
                    <br>
                    <div style="text-align:center;" class="post-address">
                        <h2>住所</h2>
                        <input type="text" name="post[address]"  >
                        <p class="address-error" style="color:red">{{ $errors->first('post.address') }}</p>
                    </div>
                    <br>
                    <div style="text-align:center;" class="post-tel">
                        <h2>電話番号</h2>
                        <input type="text" name="post[tel]">
                        <p class="tel-error" style="color:red">{{ $errors->first('post.tel') }}</p>
                    </div>
                     <br>
                    <div style="text-align:center;" class="post-creditCardType">
                        <h2>クレジットカード種類</h2>
                        <input type="text" name="post[creditCardType]"  >
                        <p class="creditCardType-error" style="color:red">{{ $errors->first('post.creditCardType') }}</p>
                    </div>
                     <br>
                    <div style="text-align:center;" class="post-creditCardNumber">
                        <h2>クレジットカード番号</h2>
                        <input type="text" name="post[creditCardNumber]" >
                        <p class="creditCardNumber-error" style="color:red">{{ $errors->first('post.creditCardNumber') }}</p>
                    </div>
                    <br>
                    <div style="text-align:center;" class="post-site_name">
                        <h2>サイト名</h2>
                        <input type="text" name="post[site_name]" >
                        <p class="site_name-error" style="color:red">{{ $errors->first('post.site_name') }}</p>
                    </div>
                    <br>
                    <div style="text-align:center;" class="post-site_url">
                        <h2>サイトURL</h2>
                        <input type="text" name="post[site_url]"  >
                        <p class="site_url-error" style="color:red">{{ $errors->first('post.site_url') }}</p>
                    </div>
                    <br>
                    
            
            
                    <div style="text-align:center;" class="save-button">
                        <input type="submit" value="保存"/>
                    </div>
                    <br>
            </form>
        
            <div style="text-align:center;" class="footer">
                <a href="/index">戻る</a>
            </div>
       
    </body>
     </x-app-layout>
</html>