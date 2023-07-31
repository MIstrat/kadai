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
          <div style="text-align:center;" class="search">
        <form method="GET" action="/index">
            @csrf
            <input type="search" placeholder="検索したい文字を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <div>
                <button type="submit">検索</button>
                <button>
                    <a href="/index" class="text-black">
                        クリア
                    </a>
                </button>
            </div>
        </form>
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
    
        <div style="text-align:center;" class="footer">
            <a href="/index/store">新規作成</a>
        </div>
    </body>
     </x-app-layout>
</html>