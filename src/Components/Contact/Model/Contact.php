<?php

namespace App\Components\Contact\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = "contact";

    const Reports = true;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'seen',
        'type_id'
    ];


    public function type() {
        return $this->hasOne(\App\Components\Contact\Model\Type::class, 'id','type_id');
    }

    public static function Listing()
    {
        if (request()->has('search')) {
            $lists = Contact::search();
        } else {
            $lists = Contact::orderBy('id', 'DESC')->paginate();
        }
        return $lists;
    }

    public static function search()
    {
        $lists = new Contact;
        $search_keys = [
            'name',
            'email',
            'phone',
            'seen',
            'type_id',
        ];
        foreach (request('search', []) as $key => $value) {
            if (!is_null($value)) {
                if (in_array($key, $search_keys)) {
                    if ($key == 'name') {
                        $lists = $lists->where('name', 'like', '%' . request('search')['name'] . '%');
                    } else {
                        $lists = $lists->where([$key => $value]);
                    }
                }
            }
        }
        return $lists->orderBy('id', 'DESC')->paginate();
    }
}
