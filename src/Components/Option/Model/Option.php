<?php

namespace App\Components\Option\Model;

use Illuminate\Database\Eloquent\Model;
use \Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Components\Option\Model\Shipping;

class Option extends Model {

    protected $table = "option";
    protected $fillable = [
        'key',
        'value',
        'group_by',
    ];

    public static function generator_map() {
        
        $array = [
            'standard' => [
                'title' => 'Standard',
                'icon' => 'icon-wrench',
                'items' => [
                    'latitude' => [
                        'title' => 'latitude',
                        'type' => 'text',
                    ],
                    'longitude' => [
                        'title' => 'longitude',
                        'type' => 'text',
                    ],
                    'logo' => [
                        'title' => 'Logo',
                        'type' => 'image',
                    ],
                ]
            ],
            'contacts' => [
                'title' => 'Contacts',
                'icon' => 'icon-tree5',
                'items' => [
                    'email' => [
                        'title' => 'Email',
                        'type' => 'email',
                    ],
                    'mobile' => [
                        'title' => 'Phone',
                        'type' => 'number',
                    ],
                    'facebook' => [
                        'title' => 'Facebook',
                        'type' => 'url',
                    ],
                    'twitter' => [
                        'title' => 'Twitter',
                        'type' => 'url',
                    ],
                    'instagram' => [
                        'title' => 'Instagram',
                        'type' => 'url',
                    ],
                    'whatsapp' => [
                        'title' => 'Whatsapp',
                        'type' => 'number',
                    ],
                    'play_store' => [
                        'title' => 'Play Store',
                        'type' => 'url',
                    ],
                    'app_store' => [
                        'title' => 'App Store',
                        'type' => 'url',
                    ],
                ]
            ],
            'pages' => [
                'title' => 'Pages',
                'icon' => 'icon-magazine',
                'items' => [
                    'terms' => [
                        'title' => 'Terms',
                        'type' => 'list',
                        'source' => get_pages(),
                    ],
                    'about' => [
                        'title' => 'About',
                        'type' => 'list',
                        'source' => get_pages(),
                    ],
                    'policy' => [
                        'title' => 'Policy',
                        'type' => 'list',
                        'source' => get_pages(),
                    ],
                    'help' => [
                        'title' => 'Help',
                        'type' => 'list',
                        'source' => get_pages(),
                    ],
                ]
            ],
            // 'sms' => [
            //     'title' => 'SMS',
            //     'icon' => 'icon-envelop5',
            //     'items' => [
            //         'Username' => [
            //             'title' => 'Username',
            //             'type' => 'text',
            //         ],
            //         'Password' => [
            //             'title' => 'Password',
            //             'type' => 'password',
            //         ],
            //         'Sender' => [
            //             'title' => 'Sender',
            //             'type' => 'text',
            //         ],
            //         'Opration' => [
            //             'title' => 'Opration',
            //             'type' => 'text',
            //         ],
            //         'Url' => [
            //             'title' => 'Url',
            //             'type' => 'text',
            //         ],
            //     ]
            // ],
            'firebase' => [
                'title' => 'Fire Base',
                'icon' => 'icon-fire',
                'items' => [
                    'firebaseServerKey' => [
                        'title' => 'Server Key',
                        'type' => 'text',
                    ]
                ]
            ],
        ];
        foreach(config('laravellocalization.supportedLocales') as $key=>$value) {
            $array['contacts']['items']["address_{$key}"]   = ['title'=>"Address {$key}",'type'=>'text'];
            $array['standard']['items']["author_{$key}"]    = ['title'=>"Author {$key}",'type'=>'text'];
            $array['standard']['items']["slogan_{$key}"]    = ['title'=>"Slogan {$key}",'type'=>'text'];
            $array['standard']['items']["share_msg_{$key}"] = ['title'=>"Share Msg {$key}",'type'=>'text'];
        }
        return $array;
    }

    public static function insert_or_update($request_data, $group_by) {
        if(array_key_exists('shipping_place',$request_data)) {
            Shipping::createRequest($request_data['shipping_place']);
            return;
        }
        foreach ($request_data as $key => $value) {
            $value = (is_array($value)) ? Option::vlidation_array($value) : $value;
            $option = Option::where([
                                'key' => $key,
                                'group_by' => $group_by,
                            ])->first();
            if (is_null($option)) {
                Option::create([
                            'key' => $key,
                            'value' => Option::format_value($value),
                            'group_by' => $group_by,
                        ]);
            } else {
                $option->update([
                            'value' => Option::format_value($value),
                        ]);
            }
        }
    }

    public static function format_value($value) {
        if ($value instanceof UploadedFile) {
            $value = file_upload($value, 'stander');
        } else {
            if (is_array($value)) {
                $value = json_encode($value);
            }
        }
        return $value;
    }

    public static function vlidation_array($array) {
        $filtered = \Arr::where($array, function ($value, $key) {
                    return (!is_null($value['ar']));
                });
        return $filtered;
    }
}
