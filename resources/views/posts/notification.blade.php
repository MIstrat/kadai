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
        <h1>通知一覧</h1>
        </div>
        <br>
                <div style="text-align:center;" class="notifications">
                    
                        @forelse($notifications as $notification)
                            <p>{{ $notification->data['site_name'] }}で情報が変更されました。</p>
                            <a href="{{ $notification->data['site_url'] }}">{{ $notification->data['site_url'] }}</a>
                            <br>
                            <a href="{{ route('notifications.read', $notification) }}">既読にする</a><br>
                            <br>
                             @empty
                            <p>まだ通知はありません</p>
                        @endforelse
                    </div>
                {{ $notifications->links() }}
                </div>
        </form>
    </body>
     </x-app-layout>
</html>