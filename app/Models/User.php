<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCpfAttribute($value)
    {
        return $this->value_mask("cpf", $value);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format("d/m/Y H:i:s");
    }

    public function getFullNameAttribute($value)
    {
        return $this->nome . " - " . $this->cpf;
    }

    protected function cleanData($value)
    {
        return preg_replace("/[^0-9]/", "", $value);
    }

    protected function value_mask($mask, $value)
    {

        $type_mask = [
            "cep" => "%s%s%s%s%s-%s%s%s",
            "cpf" => "%s%s%s.%s%s%s.%s%s%s-%s%s",
            "cnpj" => "%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s",
            "tel8" => "%s%s%s%s-%s%s%s%s",
            "tel8ddd" => "(%s%s) %s%s%s%s-%s%s%s%s",
            "tel9" => "%s%s%s%s%s-%s%s%s%s",
            "tel9ddd" => "(%s%s) %s%s%s%s%s-%s%s%s%s",

        ];

        $newValue = preg_replace("/[^0-9]/", "", $value);

        if ($mask == "tel") {
            switch (strlen($newValue)) {
                case 8:
                    $newValue = vsprintf($type_mask["tel8"],
                        str_split($newValue));
                    break;
                case 10:
                    $newValue = vsprintf($type_mask["tel8ddd"],
                        str_split($newValue));
                    break;
                case 9:
                    $newValue = vsprintf($type_mask["tel9"],
                        str_split($newValue));
                    break;
                case 11:
                    $newValue = vsprintf($type_mask["tel9ddd"],
                        str_split($newValue));
                    break;
            } // end switch
        } else {
            if ($mask == 'cpf' && strlen($newValue) == 11) {
                $newValue = vsprintf($type_mask[$mask],
                    str_split($newValue));
            }

            if ($mask == 'cnpj' && strlen($newValue) == 14) {
                $newValue = vsprintf($type_mask[$mask],
                    str_split($newValue));
            }

            if ($mask == 'cep' && strlen($newValue) == 8) {
                $newValue = vsprintf($type_mask[$mask],
                    str_split($newValue));
            }
        } // end if

        return $newValue;
    } // end value_mask
}
