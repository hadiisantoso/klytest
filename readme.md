### KLY TEST CRUD
#### Requirements:
- Laravel 5.5.*
- PHP 7.1.*
- PHPUnit 6.5.*

#### Step to deploy 
- Pull or clone this repo
- `$ composer install`
- Make **.env** file, this is can be done by copying from **.env.example**
- `$ php artisan key:generate`
- `$ php artisan serve` 
- Open <http://localhost:8000> , or whatever port you are using.

#### Step to Unit Testing
- run `.\vendor\bin\phpunit` on root project
- For deleteAction **test\Feature\DataTest.php** PHPunit by default skipped, comment codew bellow for remove skip Testing.
```
$this->markTestSkipped(
      "can't call api because of a bug in there causing our lunch to disappear"
);
```
