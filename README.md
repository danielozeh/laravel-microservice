## Simple Laravel Microservice

This application contains two microservices that communicates via a message bus (RabbitMQ). 

The services are:
### users
### notifications


## Set Up
Below are the simple steps in running the application


- Navigate to where you want the application to reside (e.g cd /Desktop/Projects/Laravel)
- Clone this repository: `git clone https://github.com/danielozeh/laravel-microservice.git`
- Navigate into the project: `cd laravel-microservice`


There are two folders in this project (users and notifications)

### For users
Make sure you have docker installed on your machine
copy the .env.example into .env

- Navigate into the users folder: `cd users`
- Build the project using docker: `docker-compose build`
- Run the project using: `docker-compose up -d`

The above will expose the user service on port 8000
visit `http://127.0.0.1:8000` to access the service

After testing, the data is logged to a file in storage/public/users.json


### For notifications
copy the .env.example file into .env

- Navigate into the users folder: `cd notifications`
- Build the project using docker: `docker-compose build`
- Run the project using: `docker-compose up -d`

The above will expose the notifications service on port 8001
after testing, users service, the data here is logged to a file using Laravel Log::info();


## Tests
To run tests, use `php artisan test`

## Credentials
For this project, RabbitMQ was used, you need to sign in to the instance
- [Click here to go to RabbitMQ](https://woodpecker.rmq.cloudamqp.com/#/queues/dgjudcss/default)
Login Credentials
```
username: dgjudcss
password: GBC5eqrORPmAVvp0XIDTr4JdEkAlzi4W
```
