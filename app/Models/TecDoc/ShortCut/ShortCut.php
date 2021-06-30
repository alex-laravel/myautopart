<?php

namespace App\Models\TecDoc\ShortCut;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortCut extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'td_short_cuts';

    /**
     * @var array
     */
    protected $fillable = [
        'shortCutId',
        'shortCutName',
    ];
}
