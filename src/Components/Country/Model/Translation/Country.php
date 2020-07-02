<?php

namespace App\Components\Country\Model\Translation;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $table = "countries_translations";

    protected $fillable = ['name'];
    
    protected $guarded = ['country_id'];
    
    public $timestamps = false;

}
