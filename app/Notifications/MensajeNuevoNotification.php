<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification; 

class MensajeNuevoNotification extends Notification
{
    use Queueable;

    public $mensaje;

    /**
     * Create a new notification instance.
     */
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Nuevo mensaje recibido')
        ->greeting('Hola Admin')
        ->line('Tienes un nuevo mensaje.')
        ->line($this->mensaje)
        ->action('Ver panel', url('/admin'))
        ->line('Revisa tu panel de administración.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        'mensaje' => $this->mensaje,
        'url' => '/admin/mensajes'
    ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'mensaje' => $this->mensaje,
            'url' => '/admin/mensajes'
        ];
    }   
}
