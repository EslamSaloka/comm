<?php

namespace App\Components\Contact\Model;

use Illuminate\Database\Eloquent\Model;
use App\Components\Coupon\Model\Coupon;
use App\Components\Stores\Model\Stores;

class Type extends Model {

    use \Astrotomic\Translatable\Translatable;

    const Reports = true;

    protected $translationForeignKey = "contact_type_id";

    public $translatedAttributes = ['name'];

    public $translationModel = 'App\Components\Contact\Model\Translation\Type';

    protected $table = "contact_type";

    protected $fillable = ['public'];


}