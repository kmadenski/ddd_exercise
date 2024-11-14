# PHP CLI Application with Docker

## Introduction

This project is a **PHP 8.1 CLI application** designed to process input files and perform commission calculations. Docker is used to ensure a consistent environment.

## Prerequisites

- **[Git](https://git-scm.com/downloads)**: For cloning the repository.
- **[Docker](https://www.docker.com/get-started)**: To run the application.
- **[Docker Compose](https://docs.docker.com/compose/install/)**: For managing Docker services.

# PHP CLI Application with Docker

## Build and Run the Docker Container
### Ensure entrypoint.sh is executable:
```bash
chmod +x entrypoint.sh
```
### Build and run:
```bash
docker-compose up -d --build
```
## Run Tests
### Execute PHPUnit tests using the following command:
```bash
docker-compose exec app vendor/bin/phpunit tests/unit/Domain/Service/ExchangeServiceTest.php
```