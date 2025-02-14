<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory;

    /**
     * Busca o registro de acordo com id 
     *
     * @param [type] $query
     * @param [type] $id
     * @return void
     */
    public function scopeFindById($query, $id) {

        $query->where('id', $id);

        return $query;

    }

}
