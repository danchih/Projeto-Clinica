<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class PacienteChegouNotification extends Notification {
    use Queueable;

    public $paciente;

    public function __construct($paciente) {
        $this->paciente = $paciente;
    }

    public function via($notifiable) {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable) {
        return new BroadcastMessage([
            'paciente' => $this->paciente,
        ]);
    }
}

