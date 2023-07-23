<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Information;

class InformationNotification extends Notification
{
    use Queueable;
    
    private Information $information;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Information $information)
    {
        $this->information = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'site_name' => $this->information->site_name,
            'site_url' => $this->information->site_url,
            
             //  通知からリンクしたいURLがあれば設定しておくと便利
             //'url' => route('infos.show', ['information' => $this->information])
        ];
    }
    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('個人情報が変更されました')
            ->line('サイト名：' . $this->information->site_name)
            ->line('サイトURL：' . $this->information->site_url);
    }
}
