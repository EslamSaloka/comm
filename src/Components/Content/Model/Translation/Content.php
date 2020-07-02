<?php

namespace App\Components\Content\Model\Translation;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

    protected $table = "contents_translations";
    protected $fillable = [
        'page_title',
        'page_slug',
        'header_image',
        'header_text',
        'content',
        'footer_text',
        'footer_image',
    ];
    protected $guarded = ['content_id'];
    protected $casts = [
        'content' => 'array'
    ];
    public $timestamps = false;

}
