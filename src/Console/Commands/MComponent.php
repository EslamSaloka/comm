<?php

namespace Tasawk\TasawkComponent\Console\Commands;

use Illuminate\Console\Command;

class MComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:migrate {name=default} {--M=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $translate = false;


    public function handle() {
        $this->option('M');
        if($this->argument('name') == 'default') {
            $this->info('Component Name Missing');
        } else {
            if(empty($this->options()['M'])) {
                $this->info('migrate name Missing');
            } else {
                $this->createComponent();  
            }
        }
    }

    protected function createComponent() {
        $this->migrateFunction('Migration/migrations.php');
    }

    protected function migrateFunction($val) {
        $path = app_path('Components').'/'.$this->argument('name');
        $dir = explode('/',$val);
        unset($dir[count($dir)-1]);
        $dir = implode('/',$dir);
        if (! is_dir($directory = $path.'/'.$dir)) {
            mkdir($directory, 0755, true);
        }
        $val   = str_replace('migrations',$this->options()['M'][0],$val);
        $place = str_replace(' ','_',strtolower($this->options()['M'][0]));
        $val   = str_replace(
                    $this->options()['M'][0].'.php',
                    date('Y_m_d').'_'.substr((string) time(), -6).'_'.$place.'.php',
                    $val);
        if($this->translate != true) {
            file_put_contents(
                $path.'/'.$val,
                $this->compileMigrateStub($dir)
            ); 
        } else {
            file_put_contents(
                $path.'/'.$val,
                $this->compileMigrateStub($dir,'_translate')
            );
        }
    }

    protected function compileMigrateStub($dir,$translate = '') {
        $name       = str_replace('_','',$this->options()['M'][0]);
        $mm         = lcfirst($this->argument('name'));
        $mmm        = rtrim($mm,'s');
        return str_replace(
            ['{{migrate}}','{{mm}}','{{mmm}}'],
            [$name,$mm,$mmm],
            file_get_contents(__DIR__.'/stubs/migrate/migrations'.$translate.'.stub')
        );
    }

}