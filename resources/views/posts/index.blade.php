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
                        <button type="submit" class="h-10 px-6 font-semibold rounded-md bg-black text-white">検索</button>
                        <button class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900">
                            <a href="/index" class="text-black">
                                クリア
                            </a>
                        </button>
                </form>
            </div>
            <br>
            @if(isset($search))
                <table class="border-separate border-spacing-2 border border-slate-400 ml-20">
                    <thead>
                        <tr>
                            <th>メールアドレス</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>クレジットカード</th>
                            <th>クレジットカード番号</th>
                        </tr>
                    </thead>
                @forelse($posts as $post)
                    <tbody>
                        <tr>
                            <td>
                                <a href="/index/{{ $post->id }}" class="text-bsae font-medium text-slate-900">{{ $post->email }}</a>
                            </td>
                            <td class="text-sm text-slate-500 truncate">{{ $post->address }}</td>
                            <td class="text-sm text-slate-500 truncate">{{ $post->tel }}</td>
                            <td class="text-sm text-slate-500 truncate">{{ $post->creditCardType }}</td>
                            <td class="text-sm text-slate-500 truncate">{{ $post->creditCardNumber }}</td>
                        </tr>
                    </tbody>
                    @empty
                        <p>まだ情報はありません</p>
                    @endforelse
                </table>  
                @if(!empty($posts))
                    {{ $posts->appends(request()->query())->links() }}
                @endif
            @else
                <table class="border-separate border-spacing-2 border border-slate-400 ml-10">
                    <thead>
                        <tr>
                            <th>サイト名</th>
                            <th>サイトURL</th>
                            <th>メールアドレス</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>クレジットカード</th>
                            <th>クレジットカード番号</th>
                        </tr>
                    </thead>
                @forelse($sites as $site)
                    <tbody>
                        <tr>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">
                                <a href="/index/{{ $site->post_id }}" class="text-bsae font-medium text-slate-900">{{ $site->site_name }}</a>
                            </td>
                            <td class="text-sm text-slate-500 truncate w-1/6" style="text-align:center;">{{ $site->site_url }}</td>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">{{ $site->post->email }}</td>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">{{ $site->post->address }}</td>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">{{ $site->post->tel }}</td>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">{{ $site->post->creditCardType }}</td>
                            <td class="text-sm text-slate-500 truncate w-1/8" style="text-align:center;">{{ $site->post->creditCardNumber}}</td>
                        </tr>
                    </tbody>
               
                    @empty
                        <p>まだ情報はありません</p>
                        
                    @endforelse
                </table>
                @if(!empty($sites))
                    {{ $sites->links() }}
                @endif
            @endif
            
            
            <br>
            <button style="text-align:center;" class="ml-20 h-10 px-6 font-semibold rounded-md bg-black text-white">
                <a href="/index/store">新規作成</a>
            </button>   
        </div>
    </body>
     </x-app-layout>
</html>