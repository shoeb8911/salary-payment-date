# Salary Payment Date tool

## Overview
This is a command-line utility built using Laravel to generate salary payment dates for the remainder of the year.

## Libraries Used
- **Carbon**: For date manipulation.
- **League CSV**: To easily generate and manage CSV files.

## Docker Setup
This project is containerized using Docker for consistent and isolated development environments.

## Running the Utility
1. Ensure Docker is running.
2. Build and start the Docker containers:
    ```bash
    docker-compose up --build
   ```

# Alternative Without Docker

##Requirement
System requirements** (e.g., PHP 8.2.23, Laravel 10, Composer 2.7.9).
## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/shoeb8911/salary-payment-date.git
    cd salary-payment-date
    ```

2. **Install dependencies**:
    Ensure you have Composer(https://getcomposer.org/download/) installed, then run:
    ```bash
    composer install
    ```

3. **Copy the `.env` file**:
    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:
    ```bash
    php artisan key:generate
    ```

5. **Start the development server**:
    ```bash
    php artisan serve
    ```

## How to Check
Generate Payment Dates for the Current Year:
Use the command:
```bash generate:payment-dates 
```
This command will generate payment dates for the remainder of this year.

Get CSV File from Directory:
To retrieve a CSV file from the directory storage/app, you will need to navigate to that directory.


## Testing

To run tests, use:
```bash
php artisan test
