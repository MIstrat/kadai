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
                <h1>通知一覧</h1>
            </div>
            <br>
 
                @forelse($notifications as $notification)
            <div class="flex justify-start ml-20">
                    <div class="w-2/6">
                        <p class="text-base font-medium text-slate-900">
                            {{ $notification->data['site_name'] }}で情報が変更されました。
                        </p>
                        <a href="{{ $notification->data['site_url'] }}" class="text-sm text-slate-500 truncate">
                            {{ $notification->data['site_url'] }}
                        </a>
                    </div>
                    <div>
                        <button class="h-10 px-6 font-semibold rounded-md bg-black text-white">
                            <a href="{{ route('notifications.read', $notification) }}" >
                                既読にする
                            </a>
                        </button>
                    </div>
                    
            </div>
                <br>
                @empty
                <p>まだ通知はありません</p>
                @endforelse
            {{ $notifications->links() }}
        </div>
    </body>
    </x-app-layout>
</html>