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
4. Delete `api-logistics` from `requeriments.txt` so there are no conflicts.
5. `pip install -r requirements.txt`
6. `uvicorn project.app.main:app --reload --port 3307`. If this port doesn't work, try 3308.

### Set up the API
1. To download the API folder we must go to a previous commit. We go to Jan 23th, 2025 and download it from “Merge pull request #2 from zoraidafalcon/testing”.
2. Once downloaded we copy the `api` folder to our itinerarIA repository. Inside this `api` folder we must delete the itinerarIApp folder we find inside.
3. We open the api folder using VScode and in the file `calculoruta.py` we must change the database connection parameters that we can find on line 14 to those in which the itinerariaDB is located. We must also change the API_KEY on line 7 for this one `15fea69a-640d-471e-b2b3-a25508b3f43d`.
4. It's necessary to also change the connection parameters on `llenadodecamiones.py` on line 9.
5. Navigate to the project folder and then app. In there we will open the `config.py` file and change the API_KEY that can be found in line 4 for the same in step 3: `15fea69a-640d-471e-b2b3-a25508b3f43d`. We must also change the parameters DB_HOST, DB_USER, DB_PASSWORD and DB_DATABASE to the same ones we did on step 3.
6. Finaly on the same folder, we open `main.py` and on line 13 we change the data yet again to the same ones we did in previous steps.

