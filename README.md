Project is based on Laravel 7.3 empty project.

Installation:
- `git clone`
- `composer update`
- resolve any domain to project's /public folder
- in project root dir do:
  - `chmod -R 777 storage`
  - `cp .env.example .env`
  - `php artisan key:generate`
- to interact with API run tests: `php artisan test` or use HTTP-client, e.g. [Postman](https://www.postman.com/)

Other:
- [API docs](https://smartpointtest.stoplight.io/docs/smartpoint-test/b3A6MzM1OTk0MTE-add-item) 
- registry is stored in session (external storage is not used)
