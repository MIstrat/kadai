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
            <br>
            <div style="text-align:center;" class="information">
            @foreach($post as $posts)
                 <h2>{{$posts->email }}</h2>
                 <br>
                 <h2>{{ $posts->address }}</h2>
                 <br>
                 <h2>{{ $posts->tel }}</h2>
                 <br>
                @endforeach
            </div>
            
            <br>
            <div style="text-align:center;" class="edit-button">
            <a href='/index/edit'>編集</a>
            </div>
            
            
            
        </form>
       
    </body>
     </x-app-layout>
</html>