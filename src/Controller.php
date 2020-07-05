<?php

namespace Tasawk\TasawkComponent;

use \App\Http\Controllers\Controller as BaseController;
use Validator;

class Controller extends BaseController {
    /**
     *
     * @var Tasawk\TasawkComponent\Common\Support\API 
     */
    protected $API = '';

    public function __construct() {
        if (request()->is('dashboard*')) {
            $this->setViewPath();
        } else {
            $this->setViewPath();
        }
    }

    private function setViewPath() {
        $_this = new \ReflectionClass($this);
        $filename = $_this->getFilename();
        $basePath = str_replace(substr($filename, strpos($filename, 'Controller')), '', $filename);
        $path_end = 'Front';
        if (strpos($filename, _fixDirSeparator('Controller\Dashboard'))) {
            $path_end = 'Dashboard';
        }
        foreach (config('config.Components') as $component) {
            view()->addNamespace($component, app_path("/Components/$component/View/$path_end"));
        }
        view()->addNamespace('this', _fixDirSeparator($basePath . 'View/' . $path_end));
    }

}
