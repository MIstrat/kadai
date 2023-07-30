<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use App\Models\Information;

class InformationNotification extends Notification
{
    use Queueable;
    
    private Information $information;
    protected $channel;
    protected $icon;
    protected $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Information $information)
    {
        $this->information = $information;
        $this->channel = config('slack.channel');
        $this->icon = config('slack.icon');
        $this->name = config('slack.sender_name');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail','slack'];
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
    
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from($this->name)
            ->to($this->channel)
            ->content('個人情報が変更されました')
            ->content('サイト名：' . $this->information->site_name)
            ->content('サイトURL：' . $this->information->site_url);
    }
}
