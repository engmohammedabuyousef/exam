<a href="https://github.com/engmohammedabuyousef/exam"> <h1 align="center">Exam</h1></a>

## About

Exam project.

<a name="installation"></a>
## Installation

> **Warning**
> Make sure to follow the requirements first.

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/engmohammedabuyousef/exam
    ```

1. Go into the project root directory
    ```sh
    cd exam
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `exam` (you can change database name)

1. Go to `.env` file 
    - set database credentials 
        ```sh 
        DB_DATABASE=exam
        DB_USERNAME=root
        DB_PASSWORD=[YOUR PASSWORD]
        ```
    > Make sure to follow your database username and password

1. Install PHP dependencies 
    ```sh
    composer update
    ```
1. Generate key 
    ```sh
    php artisan key:generate
    ```

1. Run migrations & seeders
    ```
    php artisan migrate:fresh --seed
    ```

1. Run server 
   
    ```sh
    php artisan serve
    ```  

1. Visit [localhost:8000](http://localhost:8000) in your favorite browser.

    > Make sure to follow your Laravel local Development Environment.
