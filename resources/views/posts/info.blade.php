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
            <h1>個人情報</h1>
            </div>
            <br>
            <div style="text-align:center;" class="information">
            
                 <h2>{{ $post->email }}</h2>
                 <br>
                 <h2>{{ $post->address }}</h2>
                 <br>
                 <h2>{{ $post->tel }}</h2>
                 <br>
                 <h2>{{ $post->site_name }}</h2>
                 <br>
                 <h2>{{ $post->site_url }}</h2>
            
            </div>
            <br>
            <div style="text-align:center;" class="edit-button">
            <a href='/index/{{ $post->id }}/edit '>編集</a>
            </div>
            <br>
            <div style="text-align:center;" class="delete-button">
            <form action="/index/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
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
       
    </body>
     </x-app-layout>
</html>