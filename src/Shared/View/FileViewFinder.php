<?php

namespace Tasawk\TasawkComponent\Shared\View;

class FileViewFinder extends \Illuminate\View\FileViewFinder {

    public function find($name) {
        $this->prependLocation(resource_path('views'));
        $baseDIR = str_replace(_fixDirSeparator('\Shared\View'), '', __DIR__) . _fixDirSeparator('/themes/');
        $this->prependLocation(_fixDirSeparator($baseDIR));
        return parent::find($name);
    }

}
