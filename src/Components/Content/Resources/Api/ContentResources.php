<?php

namespace App\Components\Content\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResources extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        return [
            'pageId' => $this->id,
            'pageTitle' => $this->page_title,
            'pageType' => $this->pageType($this->type),
            'headerImage' => (!is_null($this->header_image)) ? url($this->header_image) : '',
            'headerText' => (is_null($this->header_text)) ? '' : $this->header_text,
            'content' => $this->{$this->type . 'Function'}($this),
            'footerText' => (is_null($this->footer_text)) ? '' : $this->footer_text,
            'footerImage' => (!is_null($this->footer_image)) ? url($this->footer_image) : '',
        ];
    }

    public function pageType($type) {
        $types = [
            'text' => 'html',
            'ol' => 'ordered_list',
            'ul' => 'unordered_list',
            'questions' => 'questions',
        ];
        return $types[$type];
    }
    
    public function textFunction($data) {
        $text = preg_replace('#<[^>]+>#', ' ', $data->content['text']);
        return preg_replace('/([\s])\1+/', ' ', $text);
    }

    public function questionsFunction($data) {
        $array = [];
        $x = 0;
        foreach ($data->content['questions'] as $val) {
            $array[] = [
                'question' => $val,
                'answer' => $data->content['answer'][$x],
            ];
            $x++;
        }
        return $array;
    }

    public function olFunction($data) {
        $array = [];
        foreach ($data->content['ol'] as $val) {
            if(!is_null($val)) {
                $array[] = $val;
            }
        }
        return $array;
    }

    public function ulFunction($data) {
        $array = [];
        foreach ($data->content['ul'] as $val) {
            if(!is_null($val)) {
                $array[] = $val;
            }
        }
        return $array;
    }

}
