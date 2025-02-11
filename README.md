# Steps to install the project locally

### Webpack
1. `composer require symfony/webpack-encore-bundle`

### Tailwind
1. `npm install -D tailwindcss postcss autoprefixer postcss-loader`
2. `npx tailwindcss init -p`
3. `npm run watch`

### Modify the .env file
1. Add this line with your credentials (MySQL username and password, and database) `DATABASE_URL="mysql://username:password@127.0.0.1:3306/databaseName?serverVersion=8.0.32&charset=utf8mb4"` and comment the one that is working right now.
2. Import the SQL dump (`final_itinerariaDB.sql`) on your database.

### Symfony
1. `symfony -v`
2. `cd itinerarIApp`
3. `symfony server:start`

### Set up the virtual environment with Python
1. `cd api`
2. `python3 -m venv final_project`
3. `source final_project/bin/activate`
4. `pip install -r requirements.txt`
5. `uvicorn project.app.main:app --reload --port 3307`. If this port doesn't work, try 3308.

