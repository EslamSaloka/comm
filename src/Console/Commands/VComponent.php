<?php

namespace Tasawk\TasawkComponent\Console\Commands;

use Illuminate\Console\Command;

class VComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:view {name=default} {--type=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Component Views';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $ViewsMap = [
        'index'     =>  'index.stub',
        'create'    =>  'create.stub',
        'edit'      =>  'edit.stub',
    ];

    public function handle() {
        $this->option('type');
        if($this->argument('name') == 'default') {
            $this->info('Component Name Missing');
        } else {
            if(empty($this->options()['type'])) {
                $this->info('Component Types Missing');
            } else {
                $this->checkOfComponent();    
            }
        }
    }

    protected function checkOfComponent() {
        if (! is_dir($directory = app_path('Components').'/'.$this->argument('name'))) {
            $this->info('Component '.$this->argument('name').' Not Found');
        } else {
            $this->generatorComponent();
            $this->info('Component Created');
        }
    }

    protected function generatorComponent() {
        $types = $this->options()['type'];
        $path  = app_path('Components').'/'.$this->argument('name').'/View/Dashboard';
        foreach($types as $key=>$val) {
            if(array_key_exists($val,$this->ViewsMap)) {
                file_put_contents(
                    $path.'/'.$val.'.blade.php',
                    $this->compileStub($val,$val)
                );
            }
        }
    }

    protected function compileStub($file,$type) {
        $name       = $this->argument('name');
        $mm         = lcfirst($name);
        $mmm        = rtrim($mm,'s');
        if($type == 'index') {
            return str_replace(
                ['{{name}}'],
                [$mm],
                file_get_contents(__DIR__.'/stubs/views/index.stub')
            );
        } else if($type == 'create') {
            return str_replace(
                ['{{name}}','{{Nm}}'],
                [$mm,$mmm],
                file_get_contents(__DIR__.'/stubs/views/create.stub')
            );
        } else {
            return str_replace(
                ['{{name}}','{{Nm}}'],
                [$mm,$mmm],
                file_get_contents(__DIR__.'/stubs/views/edit.stub')
            );
        }
    }
}