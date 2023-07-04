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
            <div style="text-align:center;" class="information">
                @foreach ($posts as $post)
                 <h2>{{ $post->email }}</h2>
                 <h2>{{ $post->address }}</h2>
                 <h2>{{ $post->tel }}</h2>
            </div>
            @endforeach
            <br>
            <div style="text-align:center;" class="edit-button">
            <input type="submit" value="編集"/>
            </div>
            
            
        </form>
       
    </body>
     </x-app-layout>
</html>