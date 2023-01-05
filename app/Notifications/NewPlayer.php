<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPlayer extends Notification
{
    use Queueable;

    private $new_player;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( User $new_player )
    {
        $this->new_player = $new_player;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via( $notifiable )
    {
        return [ "mail" ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable )
    {
        $mail = new MailMessage;

        return $mail->subject( "Novo registro de usuário" )
                    ->line( "Novo usuário se registrou com nick e e-mail:" )
                    ->line( $this->new_player->nickname )
                    ->line( $this->new_player->email )
                    ->action( "Aprovar jogador", route( "admin.users.approve", $this->new_player->id ) );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray( $notifiable )
    {
        return [];
    }
}
