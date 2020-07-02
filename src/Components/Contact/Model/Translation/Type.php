<?php

namespace App\Components\Contact\Model\Translation;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

    protected $table = "contact_type_translations";

    protected $fillable = ['name'];
    
    protected $guarded = ['contact_type_id'];
    
    public $timestamps = false;

}
