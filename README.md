# Tasawk Component

# Install
``````````````
first clone tasawk project
composer dump-autoload
composer require tasawk/component:dev-master
>>config>>app.php
  providers = [
    Tasawk\TasawkComponent\TasawkServiceProvider::class,
  ];
php artisan vendor:publish --tag=public_assets --force
``````````````
# Used
```````````````
for create new component
php artisan component:create {component_name}
for create view
php artisan component:view {component_name} --type=index --type=edit --type=create
for create migrate
php artisan component:migrate {component_name} --M=file_name
````````````````


