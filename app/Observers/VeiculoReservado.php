<?php

namespace App\Observers;

use App\Models\Reserva;

class VeiculoReservado
{
    /**
     * Handle the Reserva "created" event.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return void
     */
    public function created(Reserva $reserva)
    {
        \Log::info("Veiculo reservado: Id Usuário => $reserva->user_id,  Veículo Id => $reserva->modelo_id");
    }

    /**
     * Handle the Reserva "updated" event.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return void
     */
    public function updated(Reserva $reserva)
    {
        //
    }

    /**
     * Handle the Reserva "deleted" event.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return void
     */
    public function deleted(Reserva $reserva)
    {
        //
    }

    /**
     * Handle the Reserva "restored" event.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return void
     */
    public function restored(Reserva $reserva)
    {
        //
    }

    /**
     * Handle the Reserva "force deleted" event.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return void
     */
    public function forceDeleted(Reserva $reserva)
    {
        //
    }
}
