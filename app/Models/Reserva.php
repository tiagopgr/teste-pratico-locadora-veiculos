<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $fillable = ['user_id', 'modelo_id', 'data_retirada', 'data_entrega', 'situacao'];

    protected $situacoes = [
        1 => 'Reservado',
        2 => 'Entregue'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function getSituacaoAttribute($value)
    {
        return $this->situacoes[$value];
    }

    public function getDataRetiradaAttribute($value)
    {
        return Carbon::parse($value)->format("d/m/Y H:i:s");
    }

    public function getDataEntregaAttribute($value)
    {
        if($value !== null){
            return Carbon::parse($value)->format("d/m/Y H:i:s");
        }

        return null;
    }

    /**
     * Scope uma consulta para exibir apenas veiculos reservados
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAlugados(Builder $query)
    {
        return $query->where('situacao', '=', '1');
    }

}
