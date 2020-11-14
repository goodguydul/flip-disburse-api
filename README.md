
# FLIP DISBURSEMENT API

This is an API for payment disbursement that retrieves-sends data from the Slightly-big API. This API was created using PHP and Codeigniter.


## INSTALLATION

There are several ways to deploy this project, you can choose one of them.

#### A. Localhost / Server
1. Clone this git `https://github.com/goodguydul/flip-disburse-api.git` to your htdocs / server.
2. Import .sql file which provided in the source code to your database.
3. If your server have cron, set this command to the cron job :
	`curl <your-base-url>/check/action`. 
	This is used to check updated data from API endpoint (Slightly-big).

#### B. Herokuapp
1. Clone this git `https://github.com/goodguydul/flip-disburse-api.git` to your Github.
2. Connect your Heroku account with your Github account, and then set automatic deployment in your Heroku account. You can follow this tutorial here : [Tutorial Github + Heroku](https://devcenter.heroku.com/articles/github-integration)
3. For importing the database, you can follow this tutorial : [Here](https://medium.com/@michaeltendossemwanga/import-mysql-database-to-heroku-with-one-command-import-db-sql-a932d720c82b)
4. Don't forget to add ClearDB add-ons to your heroku project.

## AUTHENTICATION

This API uses basic authentication, so on every request, you must enter a username and password.

Credentials:
 `username: admin`
 `password: 1234`
 
 ## API REQUEST
 
 Base url for all request is: https://flip-disburse-api.herokuapp.com/api
 
 ---
 ### REQUEST
 
 #### [CREATE] Add a new disburse data
 ```
  METHOD : GET 
  URL    : https://flip-disburse-api.herokuapp.com/api
  EXAMPLE:
 ```
 ![Add a new disburse data](https://i.ibb.co/6F9zFyc/Screenshot-2.png)
 ---
 #### [READ] Get all data / get data by id transaction
  ```
  METHOD : GET
  URL    : https://flip-disburse-api.herokuapp.com/api
  EXAMPLE:
  ```
  ![REQUEST ALL DATA](https://i.ibb.co/7vDJrn0/Screenshot-1.png)
  ---
  
