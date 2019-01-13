# LINGODA INTERVIEW TEST

Submitted By: VIHAS VERMA

## Requirement: Contact Form Implementation

Create an API point using Symfony for a contact form. The contact form should accept the
following fields:
* E-mail (required, valid)
* Message (required, max length 1000)
* The data should be validated and persisted in a database

Setup environment: VM with PHP 7.x, Symfony standard edition (>=3.4)


## Intallation Steps

* Clone the repository https://github.com/Vying/Test.git
```
git clone
```

* Composer install in the project directory
```
composer install 
```

* Enter your database configuration 
```
database_host (127.0.0.1): 
database_port (null):
database_name (symfony): lingoda1
database_user (root):
database_password (null):
```

* Start Server 
```
php bin/console server:run
```

## Contact Form API 

### Request API: 
```
URL: http://localhost:8000/contact 
```
### HTTP Allowed method: POST

### Post Parameter: 
email, message

## Code Explanation






