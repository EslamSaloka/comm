<?php

namespace App\Components\Country\Model;

use Illuminate\Database\Eloquent\Model;
use App\Components\Coupon\Model\Coupon;
use App\Components\Stores\Model\Stores;

class Country extends Model {

    use \Astrotomic\Translatable\Translatable;

    const Reports = true;

    protected $translationForeignKey = "country_id";

    public $translatedAttributes = ['name'];

    public $translationModel = 'App\Components\Country\Model\Translation\Country';

    protected $table = "countries";

    protected $fillable = [
        'public',
        'image',
        'parent',
        'country_code',
        'country_number',
    ];

    public function getDisplayImageAttribute()
    {
        return url($this->image ?? '/uploads/logo.png');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent', 'id');
    }

}