<?php

namespace App\Components\Content\Controller\Api;

use Illuminate\Http\Request;
use Tasawk\TasawkComponent\Controller;
use App\Components\Content\Model\Content;
use App\Components\Content\Resources\Api\ContentResources;
use App\Components\Option\Model\Option;
use Tasawk\TasawkComponent\Common\Support\API;

class ApiController extends Controller {

    public function index($page_name = '') {
        $page = Content::where($page_id);
        if (is_null($page)) {
            return resolve('API')->ApiErrorResponse(MsgError('page_id', 'this page not found'), 'Page not Found');
        }
        return (new API())->setMessage(__('Page Info'))
            ->setData(new ContentResources($page))
            ->setStatusOK()
            ->build();
    }

    public function pageByType($type) {
        $type   = lcfirst($type);
        if($type == 'faqs'){
            $type = 'help';
        }
        $option = Option::generator_map();
        if(!array_key_exists($type,$option['pages']['items'])) {
            return resolve('API')->ApiErrorResponse(MsgError($type, 'this page not found'), 'Page not Found');
        }
        $page   = Content::find(WebSettingGet($type));
        if (is_null($page)) {
            return resolve('API')->ApiErrorResponse(MsgError($type, 'this page not found'), 'Page not Found');
        }
        if ($page->status == 0) {
            return resolve('API')->ApiErrorResponse(MsgError($type, 'this page not found'), 'Page not Found');
        }
        return (new API())->setMessage(__('Page Info'))
            ->setData(new ContentResources($page))
            ->setStatusOK()
            ->build();
    }

}
