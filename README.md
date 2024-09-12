# Auto Logout Functionality Using SOCKET.IO

## Overview

This application is designed to manage Auto Logout Functionality using SOCKET.IO If user logs in to new device.

## Installation

### Prerequisites

- PHP 8.0+
- Composer
- Laravel ^9
- MySQL 
- SOCKET.IO

### Setup

1. **Clone the repository:**

   ```bash
   git clone https://github.com/rahul-junkie/campaign-management-system.git
   cd AUTHMANAGEMENT
   composer install
   npm install
   cp .env.example .env
   php artisan migrate




**To run the project and socket server this command:**
    ```bash
    php artisan server
    npm run dev
    node socket-server/server.js


## Requirements

1. **Auto Logout Functionality**:
   - User will get logout from other devices if gets login to new device.

2. **Register User List**:
   - After login user will able to see the registered users.
