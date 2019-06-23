<?php

namespace Tasawk\TasawkComponent\Console\Commands;

use Illuminate\Console\Command;

class FComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:create {name=default}';

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

    protected $stubMap = [
        'controller' => [
            'type'=>'controller',
            'files'=>[
                'Controller/Dashboard/DashboardController.php',
                'Controller/Front/FrontController.php',
                'Controller/Api/ApiController.php',
            ]
        ],
        'view' => [
            'type'=>'view',
            'files'=>[
                'View/Dashboard/index.blade.php',
                'View/Dashboard/create.blade.php',
                'View/Dashboard/edit.blade.php',
                'View/Dashboard/show.blade.php',
                'View/Front/index.blade.php',   
                'View/Front/create.blade.php',   
                'View/Front/edit.blade.php',   
                'View/Front/show.blade.php',   
            ]
        ],
        'models' => [
            'type'=>'model',
            'files'=>[
                'Model/model.php',
            ]
        ],
        'routes' => [
            'type'=>'route',
            'files'=>[
                'Route/Dashboard.php',
                'Route/Front.php',
                'Route/Api.php',
            ]
        ],
        'migrations' => [
            'type'=>'migrations',
            'files'=>[
                'Migration/migrations.php',
            ]
        ],
        'Resources'=>[
            'type'=>'resources',
            'files'=>[
                'Resources/menu/menu.php',
                'Resources/view/view.json',
            ]
        ]
    ];


    public function handle() {
        if($this->argument('name') == 'default') {
            $this->info('Component Name Missing');
        } else {
            $this->createComponent();    
        }
    }

    protected function createComponent() {
        $name    = $this->argument('name');
        $stubMap = $this->stubMap;
        $map     = [];
        // Check Map
        foreach($stubMap as $key=>$val) {
            $ask = $this->ask('You Want '.$key.' ? [Y | N]');
            if(lcfirst($ask) != 'y') {
                $map[] = $key;
            }
        }
        foreach($map as $val) {
            unset($stubMap[$val]);
        }
        $ask = $this->ask('You Want Make Translate ? [Y | N]');
        if(lcfirst($ask) == 'y') {
            $this->translate = true;
        }
        $this->createDirectories($stubMap);
        $this->info($name.' Component Created');
    }

    protected function createDirectories($map) {
        if (! is_dir($directory = app_path('Components'))) {
            mkdir($directory, 0755, true);
        }
        $check_name = false;
        if (! is_dir($directory = app_path('Components').'/'.$this->argument('name'))) {
            mkdir($directory, 0755, true);
        } else {
            $check_name = true;
        }

        $this->createOptions();

        if($check_name == true) {
            $ask = $this->ask('This Component Name Is Found Do Yo Want Replace This ? [Y | N]');    
            if(lcfirst($ask) == 'y') {
               $this->exportComponent($map); 
            } else {
                $this->info(' Component Create Stop');
                die;
            }
        } else {
            $this->exportComponent($map);
        }

    }

    protected function createOptions() {
        if(!file_exists(app_path('Components').'provider.php')) {
            $path = app_path('Components');
            file_put_contents(
                $path.'/Provider.php',
                $this->compileStub('Provider')
            ); 
            file_put_contents(
                $path.'/helpers.php',
                $this->compileStub('helpers')
            ); 
            file_put_contents(
                $path.'/controller.php',
                $this->compileStub('controller')
            );
        }
    }

    protected function compileStub($type='') {
        $directory      = 'App\Components';
        if($type == 'Provider') {
            return str_replace(
                ['{{namespace}}','{{ComponentPath}}'],
                [$directory,$directory],
                file_get_contents(__DIR__.'/options/provider.stubs')
            );
        } else if($type == 'helpers') {
            return file_get_contents(__DIR__.'/options/helpers.stubs');
        } else {
            return file_get_contents(__DIR__.'/options/controller.stubs');
        }
    }


    protected function exportComponent($stubMap) {
        foreach ($stubMap as $key => $value) {
            if($value['type'] == 'controller') {
               $this->controllerFunction($value['files']);
            } else if($value['type'] == 'model') {
               $this->modelFunction($value['files']);
            } else if($value['type'] == 'route'){
                $this->routeFunction($value['files']);
            } else if($value['type'] == 'migrations') {
                $this->migrateFunction($value['files']);
            } else if($value['type'] == 'view') {
               $this->viewFunction($value['files'],$key.'.stub');
            } else {
                $this->resourcesFunction($value['files']);
            }
       }
   }

   protected function resourcesFunction($value) {
        $path = app_path('Components').'/'.$this->argument('name');
        foreach($value as $val) {
            $dir = explode('/',$val);
            unset($dir[count($dir)-1]);
            $dir = implode('/',$dir);
            if (! is_dir($directory = $path.'/'.$dir)) {
                mkdir($directory, 0755, true);
            }     
            $dir = explode('/',$dir);
            $dir = $dir[1];
            file_put_contents(
                $path.'/'.$val,
                $this->compileResourcesStub($dir)
            );       
        }
   }

   protected function compileResourcesStub($dir) {
        $name       = $this->argument('name');
        $mm         = lcfirst($name);
        if($dir == "menu") {
            return str_replace(
                ['{{name}}','{{Nname}}'],
                [$name,$mm],
                file_get_contents(__DIR__.'/options/menu.stubs')
            );
        } else {
            return file_get_contents(__DIR__.'/options/style.stubs');
        }
   }

   protected function migrateFunction($value) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           $val = str_replace('migrations',$this->argument('name'),$val);
           $val = str_replace(
                    $this->argument('name').'.php',
                    date('Y_m_d').'_'.rand(000000,999999).'_'.lcfirst($this->argument('name').'.php'),
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
   }
   
   protected function routeFunction($value) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           file_put_contents(
               $path.'/'.$val,
               $this->compileRouteStub($dir.'/'.$val)
           );   
       }
   }
   
   protected function controllerFunction($value) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           file_put_contents(
               $path.'/'.$val,
               $this->compileControllerStub($dir)
           );   
       } 
   }
   
   protected function modelFunction($value) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           $val = str_replace('model',$this->argument('name'),$val);

           if($this->translate != true) {
               file_put_contents(
                   $path.'/'.$val,
                   $this->compileModelStub($dir)
               ); 
           } else {
               if (! is_dir($directory = $path.'/'.$dir.'/'.'Translation')) {
                   mkdir($directory, 0755, true);
               }
               $val = str_replace('.php','',$val);
               file_put_contents(
                   $path.'/'.$val.'.php',
                   $this->compileModelStub($dir,1,'model_translate')
               );
               file_put_contents(
                   $directory.'/'.$this->argument('name').'.php',
                   $this->compileModelStub($dir.'/Translation',1,'translate')
               );
           }
       }
   }
   
   protected function viewFunction($value,$key) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           copy(
               __DIR__.'/stubs/'.$key,
               $path.'/'.$val
           );
       }
   }

   protected function compileControllerStub($dir) {
       $view_name = explode('/',$dir);
       $view_name = $view_name[count($view_name)-1];
       $directory      = 'App\Components\\'.$this->argument('name').'\\'.str_replace('/','\\',$dir);
       $control        = explode('\\',$directory);
       $controlar_name = $control[count($control)-1];
       $view           = $control[2];
       $lcfirst        = lcfirst($view);
       $lcfirst        = rtrim($lcfirst,'s');
       $model          = $control[0].'\\'.$control[1].'\\'.$control[2];
       return str_replace(
           ['{{namespace}}','{{controlar_name}}','{{view}}','{{route}}','{{model}}','{{lcfirst}}','{{view_name}}'],
           [$directory,$controlar_name,$view,$this->argument('name'),$model,$lcfirst,$view_name],
           file_get_contents(__DIR__.'/stubs/Controller.stub')
       );
   }
   
   protected function compileModelStub($dir,$translate = 0,$file = '') {
       $directory        = 'App\Components\\'.$this->argument('name').'\\'.str_replace('/','\\',$dir);
       $controlar_name   = $this->argument('name');
       $model_name_small = lcfirst($this->argument('name'));
       if($translate == 0) {
           return str_replace(
               ['{{namespace}}','{{model_name}}','{{model_name_small}}'],
               [$directory,$controlar_name,$model_name_small],
               file_get_contents(__DIR__.'/stubs/model.stub')
           );
       } else {
           return str_replace(
               ['{{namespace}}','{{model_name}}','{{model_name_small}}'],
               [$directory,$controlar_name,$model_name_small],
               file_get_contents(__DIR__.'/stubs/'.$file.'.stub')
           );
       }
   }
   
   protected function compileRouteStub($dir) {
       $nn = str_replace('.php','',$dir);
       $nn = explode('/',$nn);
       $nn = $nn[count($nn)-1];
       $directory      = $this->argument('name').'\Controller\\'.$nn.'\\'.$nn.'Controller';
       $directory      = str_replace('.php','',$directory);
       $name           = lcfirst($this->argument('name'));
       return str_replace(
           ['{{directory}}','{{name}}'],
           [$directory,$name],
           file_get_contents(__DIR__.'/stubs/routes.stub')
       );
   }
   
   protected function compileMigrateStub($dir,$translate = '') {
       $name       = $this->argument('name');
       $mm         = lcfirst($name);
       $mmm        =  rtrim($mm,'s');
       return str_replace(
           ['{{migrate}}','{{mm}}','{{mmm}}'],
           [$name,$mm,$mmm],
           file_get_contents(__DIR__.'/stubs/migrations'.$translate.'.stub')
       );
   }
}