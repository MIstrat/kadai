<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <div class="bg-blue-500 bg-opacity-50">
            <div style="text-align:center;" class="text-xl font-medium">
            <h1>個人情報</h1>
            </div>
            <br>
            <div style="text-left" class="ml-20 font-semibold">
                
                 <h2>メールアドレス： {{ $post->email }}</h2>
                 <br>
                 <h2>住所： {{ $post->address }}</h2>
                 <br>
                 <h2>電話番号： {{ $post->tel }}</h2>
                 <br>
                 <h2>クレジットカード種類： {{ $post->creditCardType }}</h2>
                 <br>
                 <h2>クレジットカード番号： {{ $post->creditCardNumber }}</h2>
                 <br>
                 <h2>登録サイト名： {{ $post->site_name }}</h2>
                 <br>
                 <h2>サイトURL： {{ $post->site_url }}</h2>
            
            </div>
            <br>
            <div style="text-align:center;" >
            <a href='/index/{{ $post->id }}/edit' class="underline hover:underline-offset-4">編集</a>
            </div>
            <br>
            <div style="text-align:center;" >
            <form action="/index/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})" class="h-10 px-6 font-semibold rounded-md bg-black text-white">削除</button> 
            <script>
                function deletePost(id) {
                    'use strict'
            
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            </form>
            
            </div>
            <br>
            <div style="text-align:center;" class="footer">
                <a href="/index">戻る</a>
            </div>
       </div>
    </body>
     </x-app-layout>
</html>