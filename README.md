[![Codenetix](https://www.codenetix.com/img/codenetix-logo-light.svg)](https://www.codenetix.com/)

# Laravel 5.6 CRUD stubs classes generator

This generator makes life easier and helps to develop Laravel applications much faster by skipping tedious creation CRUD classes manually. Just run `php artisan make:crud Dog` and get ready to test code for your Dog entity!

## Supported structures out of the box

1. CRUD API project structure based on [Laravel Repository](https://github.com/andersao/l5-repository)
  * Entity controller - `app/Http/Controllers/EntityController.php`
  * Update Request - `app/Http/Requests/EntityUpdateRequest.php`
  * Create Request - `app/Http/Requests/EntityCreateRequest.php`
  * Collection Resource - `app/Http/Resources/EntityCollectionResource.php`
  * Single item resource - `app/Http/Resources/EntityResource.php`
  * Model - `app/Entities/Entity.php`
  * [Repository interface](https://github.com/andersao/l5-repository) `app/Repositories/EntityRepository.php`
  * [Repository class](https://github.com/andersao/l5-repository) `app/Repositories/EntityRepositoryEloquent.php`
  * Service (put your entity business logic here) `app/Services/EntityService.php`
  * Faker factory `database/factories/EntityFactory.php`
  * Migration `database/migrations/Y_m_d_His_create_entity_table.php`
  * Feature test `tests/Feature/EntityTest.php`

## Installation
1. Add the next git repository definition into your composer.json file:
    ```
    "repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/codenetix-ltd/laravel-crud-code-generator"
        }
        ...
    ]
    ```
2. Run composer install:
    ```
    $ composer require codenetix/stub-generator
    ```
3. Publish vendor definitions:
    ```
    $ php artisan vendor:publish --provider="Codenetix\StubGenerator\StubGeneratorServiceProvider"
    ```
## CRUD generation
1. Generate classes:
    ```
    $ php artisan make:crud Dog --force
    ```
    > --force flag instructs the script to force override already exist classes. Be care!

2. Register new routes into `routes/api.php` like:
    ```
    Route::resource('dogs', 'DogsController');
    ```

3. Add Repository binding in `app/Providers/RepositoryServiceProvider.php` like:
    ```
    ...
    public function register()
    {   ...
        $this->app->bind(\App\Repositories\DogRepository::class, \App\Repositories\DogRepositoryEloquent::class);
        ...
    }
    ```

4. Run newly generated migration:
    ```
    $ php artisan migrate
    ```

5. Run your new PHPUnit feature test
    ```
    $ vendor/bin/phpunit --filter=DogTest
    ```

## Extending

TODO!

## Contribution

TODO!