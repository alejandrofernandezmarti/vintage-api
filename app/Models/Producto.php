<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'precio',
        'nombre',
        'id_marca',
        'id_categoria',
        'id_talla',
        'id_medidas',
        'estado',
        'activo',
        'vendido',
    ];

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function talla(): BelongsTo
    {
        return $this->belongsTo(Talla::class, 'id_talla');
    }

    public function medida(): BelongsTo
    {
        return $this->belongsTo(Medida::class, 'id_medidas');
    }

    // Suponiendo que un producto puede estar en varias compras
    public function compras(): HasMany
    {
        return $this->hasMany(ProductoCompra::class, 'id_producto');
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
    protected $casts = [];
}
