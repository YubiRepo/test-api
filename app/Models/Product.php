<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'unit_id', 'price', 'stock', 'description', 'image'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['name' => 'string', 'stock' => 'integer', 'description' => 'string', 'image' => 'string', ];

	public function unit()
	{
		return $this->belongsTo(\App\Models\Unit::class);
	}
}
