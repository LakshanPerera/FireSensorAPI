# Sensor Reading API
This is an API that reads the fire sensor information from the FireSensors and
allows the front-end applications(Web/Desktop) to read those values.

Current version of the API is hosted at https://fire-alarm-api-ds.herokuapp.com/
### Get Started

1. Prerequisites:
    * PHP 7.0+
    * Composer
    * XAMPP or any equivalent (for local development)
 
 2. Steps for getting started:
    * Clone the repository
    ```
    git clone https://github.com/LakshanPerera/FireSensorAPI.git
    ```
    
    * CD into the project folder
    ```
    cd FireSensorAPI
    ```
    
    * Run composer install (make sure that the XAMPP server is running)
    ```
    composer install
    ```
    
    * Create a `.env` file
    ```
    cp .env.example .env
    ```
    
    * Generate a unique key
    ```
    php artisan key:generate
    ```
    
    * Update the DB info in the .env, and then run the migrations (make sure DB server is running)
    ```
    php artisan migrate
    ``` 
    
    * Passport initialization (You will get the keys after you run this)
    ```
    php artisan passport:install
    ```
    
    * Run the API
    ```
    php artisan serve
    ```
    
    * Now the local server will be running, you can start testing the API using a program like Postman or Insomnia by making web requests to the following end points
    
 3. API End points
    > All responses and the data bodies are in `application/json` format
 
    * Sign in as the admin, you will receive the `access_token` after logging in
    ```
    POST: /oauth/token
    BODY: {
        "grant_type":"password",
        "client_id" : "2",
        "client_secret":"{passport_grant_client_key}",
        "username" : "admin@admin.com",
        "password" : "password"
    }
    ```
    
    * Get the sensor data
    ```
    GET: /api/sensorinfo
    ```
    
    * Get the sensor data of a specific sensor
    ```
    GET: /api/sensorinfo/{id}
    ```
    
    * Check if a sensor is a registered one(Sensor Application)
    ```
    GET: /api/isregistered/{id}
    ```
    
    * Add/Register a new Sensor(Admin only)
    ```
    POST: /api/sensorinfo
    HEADERS: {
        Authorization: "Bearer {admin_token}"
    }
    ``` 
    
    * Update the Sensor Readings(by SensorApplication)
    ```
    PUT: /api/sensorinfo/{id}
    ```
    
    * Update the Sensor Room/Floor Numbers(Admin only)
    ```
    PUT: api/update/{id}
    HEADERS: {
        Authorization: "Bearer {admin_token}"
    }
    ```
    
    * Delete a Sensor (Admin only)
    ```
    DELETE: api/update/{id}
    HEADERS: {
        Authorization: "Bearer {admin_token}"
    }
    ```
