
# FLIP DISBURSEMENT API

This is an API for payment disbursement that retrieves-sends data from the [Slightly-big](https://gist.github.com/luqmansungkar/9512940cac53f53bb4a024a1e5f70ef7) API. This API was created using PHP and Codeigniter.


## INSTALLATION

There are 2 ways to deploy this project, you can choose one of them.

#### A. Localhost / Server
1. Clone this git `https://github.com/goodguydul/flip-disburse-api.git` to your htdocs / server.
2. Import .sql file which provided in the source code to your database.
3. If your server have cron, set this command to the cron job :
	`curl <your-base-url>/check/action`. 
	You can set time interval to trigger `cron.php` every 30s, 1 minute, etc. This is used to trigger method to check updated data from API endpoint (Slightly-big).

#### B. Herokuapp
1. Clone this git `https://github.com/goodguydul/flip-disburse-api.git` to your Github.
2. Connect your Heroku account with your Github account, and then set automatic deployment in your Heroku account. You can follow this tutorial here : [Tutorial Github + Heroku](https://devcenter.heroku.com/articles/github-integration)
3. For importing the database, you can follow this tutorial : [Here](https://medium.com/@michaeltendossemwanga/import-mysql-database-to-heroku-with-one-command-import-db-sql-a932d720c82b)
4. Don't forget to add ClearDB and Heroku Scheduler add-ons to your heroku project. Add credit card to your Heroku Billing so your account will be verified and you'll be able to use those addons.
5. Heroku scheduler is used as "cron-job" for disburse data update checker. And ClearDB as database.

## CONFIG
#### GENERAL CONFIG
The general config is in `application/config/config.php`

#### DATABASE CONFIG
The database config is in `application/config/database.php`
```
// FOR HEROKU APP
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($actual_link, 'localhost') == false || strpos($actual_link, 'heroku')) {
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$db_server   = $cleardb_url["host"];
	$db_username = $cleardb_url["user"];
	$db_password = $cleardb_url["pass"];
	$db_name     = substr($cleardb_url["path"],1);
} else {
	
	$db_server   = 'localhost';
	$db_username = 'root';
	$db_password = '';
	$db_name     = 'flip';
}
```
> *Change `$db_server,$db_username, $db_password, $db_name` value if you use localhost / server. If you use heroku, just skip it.*

#### REST CONFIG
The rest api config is in `application/config/rest.php`
```
$config['rest_realm'] 		= 'REST API';
$config['rest_auth'] 		= 'basic';
$config['rest_valid_logins'] 	= ['admin' => '1234'];
```

> change`rest_auth` and `rest_valid_logins` value if you want to change the credentials for login API.

## AUTHENTICATION

This API used basic authentication, so on every request, you must enter a username and password.

Credentials:
 `username: admin`
 `password: 1234`

> you can change the credentials refer to [here](#rest-config)

---

## API REQUEST

Base url for all request is: https://flip-disburse-api.herokuapp.com/api
 
 
#### Available Variables

| variable | data type |
|--|--|
| id | bigint |
| amount | int | 
| status | varchar | 
| timestamp | datetime | 
| bank_code | varchar | 
| account_number | bigint | 
| beneficiary_name | varchar | 
| remark | varchar | 
| receipt | text | 
| time_served | datetime | 
| fee | int |

---

### REQUEST

#### [CREATE] Add a new disburse data
 ```
  METHOD : POST 
  URL    : https://flip-disburse-api.herokuapp.com/api/add
  EXAMPLE:
 ```
 ![Add a new disburse data](https://i.ibb.co/6F9zFyc/Screenshot-2.png)
---
#### [READ] Get all data / get data by id transaction
  ```
  METHOD : GET
  URL    : https://flip-disburse-api.herokuapp.com/api
  URL (with id) : https://flip-disburse-api.herokuapp.com/api?id={id transaction}
  EXAMPLE:
  ```
  ![REQUEST ALL DATA](https://i.ibb.co/7vDJrn0/Screenshot-1.png)
---
#### [UPDATE] Update a Data Disburse
 
> *Note: this is `update` only for this API, on update checker we use different method*.

  ```
  METHOD : PUT
  URL    : https://flip-disburse-api.herokuapp.com/api/update
  EXAMPLE:
  ```
  ![Update Data Disburse](https://i.ibb.co/ZLq7Mv3/Screenshot-3.png)
---
#### [DELETE] Delete a Disburse Data 
 
  ```
  METHOD : DELETE
  URL    : https://flip-disburse-api.herokuapp.com/api/delete
  EXAMPLE:
  ```
  ![enter image description here](https://i.ibb.co/tYW5qBz/Screenshot-4.png)
---
 
### AUTO UPDATE CHECKER

For update checker, url is https://flip-disburse-api.herokuapp.com/check/action

This auto update checker is triggered every 30s. This setting can be changed on file `cron.php`:

	$appRoot 	= "https://flip-disburse-api.herokuapp.com";
	$cmd 		= "curl $appRoot/check/action";
	$sleep 		= 30; // IN SECOND. CHANGE THIS VALUE TO CHANGE THE TIME INTERVAL

	while (true) {
	    exec($cmd);
	    sleep($sleep);
	}

This cron.php is executed in ProcFile when the app is deployed / re-deployed.

---

## RESOURCES

There are several resources used in this API. Thanks to the dev.

1. [Codeigniter 3](https://codeigniter.com)
2. [Codeigniter REST Server](https://github.com/chriskacerguis/codeigniter-restserver)
3. [Guzzle](https://github.com/guzzle/guzzle)


