<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PacienteChegou {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $paciente;

    public function __construct($paciente) {
        $this->paciente = $paciente;
    }

    public function broadcastOn() {
        return ['paciente-chegou'];
    }

    public function broadcastAs() {
        return 'paciente.chegou';
    }
}



