# Sports Manager API

## Description

This project is an **API** built with **Laravel 10** to manage sports-related information such as **Players**, **Teams**, and **Games**, using data from the public [BallDontLie API](https://www.balldontlie.io/). The project implements authentication using **Laravel Sanctum** and follows best development practices, such as the **repository pattern**.

## Technologies Used

- **Laravel 10**
- **MySQL 8.0**
- **Docker**
- **Vue.js** for the frontend (optional)
- **Laravel Sanctum** for authentication
- **BallDontLie API** for sports data

## Features

- Synchronization of **Players**, **Teams**, and **Games** from the BallDontLie API.
- Storage of **teams** data (home_team and visitor_team) in **JSON** format.
- Data synchronization via **Artisan command**.
- Rate limit control to respect the 30 requests per minute limit imposed by the API.
- Authentication with Laravel Sanctum.

## Installation

### Prerequisites

- **Docker** and **Docker Compose** installed on your machine.
- **BallDontLie API** key (optional for limiting requests).

### Step-by-Step

1. **Clone the Repository:**

   ```bash
   git clone git@github.com:leosanlima/sports-manager-api-laravel.git
   cd sports-manager-api-laravel
