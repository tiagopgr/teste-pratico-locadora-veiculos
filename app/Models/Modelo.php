<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;


class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';
    protected $fillable = ['id', 'marca_id', 'nome', 'placa', 'ano'];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format("d/m/Y H:i:s");
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function scopeDisponiveis(Builder $query)
    {
        return $query->where('situacao', '=', '1');
    }
}
