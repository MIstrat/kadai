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
                <h1>サイト一覧</h1>
            </div>
            
            <br>
            
            <div style="flex space-x-4" class="ml-10">
                <form method="GET" action="/index">
                    @csrf
                    <input type="search" placeholder="検索したい文字を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    <!--<div>-->
                        <button type="submit" class="h-10 px-6 font-semibold rounded-md bg-black text-white">検索</button>
                        <button class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900">
                            <a href="/index" class="text-black">
                                クリア
                            </a>
                        </button>
                    <!--</div>-->
                </form>
            </div>
            
            <br>
            
            <ul role="list" class="p-6 divide-y divide-slate-200">
              
                <!-- Remove top/bottom padding when first/last child -->
                <li class="flex py-4 first:pt-0 last:pb-0">
                  <div class="ml-3 overflow-hidden">
                        @foreach($posts as $post)
                            <h2>
                             <a href="/index/{{ $post->id }}" class="text-bsae font-medium text-slate-900">{{ $post->site_name }}</a>
                             </h2>
                             <p class="text-sm text-slate-500 truncate">{{$post->site_url}}</p>
                             <br>
                        @endforeach
                  </div>
                
                </li>
              
            </ul>
              {{ $posts->links() }}           
            
            <!--<div style="text-left" class="font-semibold">-->
            <!--@foreach($posts as $post)-->
            <!--    <h2>-->
            <!--     <a href="/index/{{ $post->id }}" class="ml-20">{{ $post->site_name }}</a>-->
            <!--     </h2>-->
            <!--     <br>-->
            <!--@endforeach-->
            <!--</div>-->
            <!-- {{ $posts->links() }}  -->
            <!--<br>-->
        
            <button style="text-align:center;" class="ml-20 h-10 px-6 font-semibold rounded-md bg-black text-white">
                <a href="/index/store">新規作成</a>
            </button>   
        </div>
       
    </body>
     </x-app-layout>
</html>