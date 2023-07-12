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
            <h1>サイト一覧</h1>
            </div>
            <br>
            <div style="text-align:center;" class="information">
            @foreach($posts as $post)
                <h2>
                 <a href="/index/{{ $post->id }}">{{ $post->site_name }}</a>
                 </h2>
                 <br>
            @endforeach
            </div>
               {{ $posts->links() }}
            <br>
            
    </body>
     </x-app-layout>
</html>