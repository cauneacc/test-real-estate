### Starting docker containers
```shell
docker-compose up
```

After running the docker compose setup you should run the commands below to set up the project.

### Installing Composer packages

```
docker-compose exec app composer install
```

### Generating key and optimizing app
```
# needed for generating application app key 
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize
```

### Running laravel and nodejs commands in docker
```
docker-compose exec app php artisan migrate:refresh --seed
docker-compose exec app npm install
```


### Set owner of storage folder
```shell
docker-compose exec app chown www-data:www-data -R storage
```

### Prepare javascript files
```shell
docker-compose exec app npm run dev
```

### Create keys used by oauth and fix permissions
```shell
docker-compose exec app php artisan passport:keys
docker-compose exec app chmod 600 storage/oauth-private.key
docker-compose exec app chmod 600 storage/oauth-public.key
docker-compose exec app chown www-data:www-data storage/oauth-private.key
docker-compose exec app chown www-data:www-data storage/oauth-public.key

```


To use the application, go to http://localhost:8080/listEntries. You will be redirected to the login page.

email: test@test.com
password: secret

There are 3 vue.js components. 

Communication between the vue.js components and the Laravel backend is done using the axios library.
The components communicate between them using a event bus made using a vue.js component.
AddEntryForm.vue displays the form at the top of the page. Form validation is done by Laravel, it is not done on the browser side.
When an entry is successfully created an event is emited on the event bus and the Entries.vue component, updates it's data.
Entries.vue displays a search form and a table with the results. 
When a row of the results table is clicked, an event is emitted on the event bus and the ShowEntry.vue component displays the details.
ShowEntry.vue displays a modal windows with the details of a real estate listing.

Example cURL requests are in the file /curlExamples.txt
An export of an Insomnia folder is in the file /Insomnia_2019-02-07.json
The api endpoints used by the vue.js components are protected using Laravel Passport. For ease of manually testing I have made a second set of routes accessing the same controllers in Laravel.
```php
Route::get('lists', 'ListsController@index')->middleware('auth:api');
Route::get('lists/{list}', 'ListsController@show')->middleware('auth:api');
Route::post('lists', 'ListsController@store')->middleware('auth:api');
Route::get('countries', 'CitiesController@indexCountries')->middleware('auth:api');
Route::get('cities', 'CitiesController@index')->middleware('auth:api');
Route::get('developers', 'DevelopersController@index')->middleware('auth:api');

//these are for simple testing with curl or insomnia
Route::get('notProtectedLists', 'ListsController@index');
Route::get('notProtectedLists/{list}', 'ListsController@show');
Route::post('notProtectedLists', 'ListsController@store');
Route::get('notProtectedCountries', 'CitiesController@indexCountries');
Route::get('notProtectedCities', 'CitiesController@index');
Route::get('notProtectedDevelopers', 'DevelopersController@index');
```

Testing /api/notProtectedDevelopers 

```shell
docker-compose exec app vendor/bin/phpunit
```



# Original content of readme

# Real estate backendb

Develop a simple real estate application with Laravel and Vue.js. 

The task is separated into two subtasks.
- The first task is to create the admin panel where the user can filter and add a new real estate item. The app should be implemented with Vue.js on the frontend and Laravel on the backend. Points:
    - Listing the real estate entries (2 points)
    - Showing details of a real estate entry (2 points)
    - Filtering the real estate entries based on criteria (2 points)
    - Adding a new real estate entry that uses an API endpoint – see below (2 points)
    - Bonus task: Add validation to the form for adding new real estate entries  (2 points)
- The second task is to create an API backend which we will expose all the real estate data to other applications. We need these endpoints:
    - listing real estate entries with possibility to filter based on criteria – like in the UI (2 points)
    - listing countries (2 points)
    - listing developers (2 points)
    - adding a real esate entry (2 points)
    - retrieving details of a real estate entry (2 points)
- Please make an example cURL request or export a Postman/Insomnia collection so we're able to test the API
- Bonus task: write an integration test for a single API endpoint (2 points)

In total you can receive 22 points for completing this task.

See the running application we expect you to build here:
[https://youtu.be/wEdtx1H284U](https://youtu.be/wEdtx1H284U)

**It's critical that you provide clear instructions on running the code, so we can test it. If that's at all different from the instructions below**

## Requirements

### Installing docker

[Instalation for mac](https://docs.docker.com/docker-for-mac/install/)

[Instalation for windows](https://docs.docker.com/docker-for-windows/install/)


### Database schema

![alt text](./database_schema.jpeg "Database schema")


### Running docker container

The default database configuration for running locally is already configured, so just run:

```shell
docker-compose up
```

After running the docker compose setup you should run the commands below to set up the project.

### Installing Composer packages

```
docker-compose exec app composer install
```

### Generating key and optimizing app
```
# needed for generating application app key 
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize
```

### Running laravel and nodejs commands in docker
```
docker-compose exec app php artisan migrate
docker-compose exec app npm install
```

### Set correct permisions if api router is not working
```
 docker-compose exec app chmod -R 755 storage
```