<?php

namespace App\Components\Content\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

    use \Dimsav\Translatable\Translatable;

    protected $translationForeignKey = "content_id";
    public $translatedAttributes = [
        "page_title",
        "page_slug",
        "header_image",
        "header_text",
        "content",
        "footer_text",
        "footer_image",
    ];
    public $translationModel = 'App\Components\Content\Model\Translation\Content';
    protected $table = "contents";
    protected $fillable = [
        'type',
        'status'
    ];

    public static function generator_map($type = 'create', $content = null) {
        if ($type == 'create') {
            $data = [
                "type" => request('type'),
                "status" => (request()->has('status'))?(request('status', 'on') == 'on') ? 1 : 0:1,
            ];
        } else {
            if(request()->has('type')) {
                $data = [
                    "type"   => request('type', $content->type),
                ];
            } else {
                $data = [
                    "status" => (request('status', $content->status) == 'on') ? 1 : 0,
                ];
            }
        }
        // dd(request()->all());
        $locales_keys = array_keys(config('laravellocalization.supportedLocales'));
        if (request()->has('ar')) {
            foreach ($locales_keys as $val) {
                $data[$val] = [
                    "page_title" => request($val . '.page_title'),
                    "page_slug" => str_replace(' ', '-', request($val . '.page_title')),
                    "header_text" => request($val . '.header_text'),
                    "footer_text" => request($val . '.footer_text'),
                    'content' => self::{"Map_" . request('type')}($val)
                ];
                if (request()->hasFile($val . '.header_image')) {
                    $data[$val] = array_merge(
                            $data[$val], [
                        'header_image' => file_upload(request($val . '.header_image'), 'content')
                            ]
                    );
                }
                if (request()->hasFile($val . '.footer_image')) {
                    $data[$val] = array_merge(
                            $data[$val], [
                        'footer_image' => file_upload(request($val . '.footer_image'), 'content')
                            ]
                    );
                }
            }
        }
        if ($type == 'create') {
            Content::create($data);
        } else {
            $content->update($data);
        }
    }

    public static function Map_ul($val) {
        return ['ul' => request("{$val}.ul")];
    }

    public static function Map_ol($val) {
        return ['ol' => request("{$val}.ol")];
    }

    public static function Map_text($val) {
        return ['text' => request("{$val}.textarea")];
    }

    public static function Map_questions($val) {
        return ['questions' => request("{$val}.questions"), 'answer' => request("{$val}.answer")];
    }

}
