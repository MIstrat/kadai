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
                
                 <h2>{{$posts->find(1)->email }}</h2>
                 <br>
                 <h2>{{ $posts->find(1)->address }}</h2>
                 <br>
                 <h2>{{ $posts->find(1)->tel }}</h2>
                 <br>
            </div>
            
            <br>
            <div style="text-align:center;" class="edit-button">
            <input type="submit"  href='/edit' value="編集"/>
            <a href='/edit'>編集</a>
            </div>
            
            
            
        </form>
       
    </body>
     </x-app-layout>
</html>