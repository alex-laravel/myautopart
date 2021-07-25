<?php

namespace App\Models\Distributor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    use DistributorAttribute;

    protected $table = 'sh_distributors';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];
}
