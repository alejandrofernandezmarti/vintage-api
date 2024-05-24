<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'direccion',
        'id_user',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Suponiendo que una compra tiene muchos productos
    public function productos(): HasMany
    {
        return $this->hasMany(ProductoCompra::class, 'id_compra');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date'
    ];
}
