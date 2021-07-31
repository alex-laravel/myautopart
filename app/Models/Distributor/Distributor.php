<?php

namespace App\Models\Distributor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    use DistributorAttribute;
    use DistributorRelationship;

    protected $table = 'sh_distributors';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'import_slug',
    ];
}
