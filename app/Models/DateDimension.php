<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DateDimension extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'date';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'day',
        'month',
        'year',
        'day_name',
        'day_suffix',
        'day_of_week',
        'day_of_year',
        'is_weekend',
        'week',
        'iso_week',
        'week_of_month',
        'week_of_year',
        'iso_week_in_year',
        'month_name',
        'month_year',
        'month_name_year',
        'first_day_of_month',
        'last_day_of_month',
        'first_day_of_next_month',
        'quarter',
        'quarter_name',
        'first_day_of_quarter',
        'last_day_of_quarter',
        'first_day_of_year',
        'last_day_of_year',
        'first_day_of_next_year',
        'dow_in_month',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date:Y-m-d',
        'first_day_of_month' => 'date:Y-m-d',
        'last_day_of_month' => 'date:Y-m-d',
        'first_day_of_next_month' => 'date:Y-m-d',
        'first_day_of_quarter' => 'date:Y-m-d',
        'last_day_of_quarter' => 'date:Y-m-d',
        'first_day_of_year' => 'date:Y-m-d',
        'last_day_of_year' => 'date:Y-m-d',
        'first_day_of_next_year' => 'date:Y-m-d',
    ];
}