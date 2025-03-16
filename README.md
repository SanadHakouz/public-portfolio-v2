here you can see the readme file with better structure :
https://docs.google.com/document/d/1NGNhplM-PCSGJfbR6YL_YE8r2Vdse6dua8kaCY2VGEk/edit?usp=drive_link

Step 1: Clone the Repository
Copy
#Clone the repository 
Git clone https://github.com/SanadHakouz/public-portfolio-v2.git

#Navigate to project directory 
Cd public-portfolio-v2
Step 2: Configure the Environment
# Copy the example environment file
cp .env.example .env

Make sure the following settings are in your .env file:
APP_URL=http://localhost:8090
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=test
DB_PASSWORD=test
Email Configuration Options
The project uses email for two-factor authentication. Choose one of these configurations based on your preference:
For Yahoo Mail:
Copy
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your_yahoo_email@yahoo.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_yahoo_email@yahoo.com"
MAIL_FROM_NAME="${APP_NAME}"

For Gmail:
Copy
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_gmail@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
For Mailtrap (Development Testing):
Copy
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="${APP_NAME}"
Note: For Yahoo and Gmail, you'll need to generate an app password rather than using your regular password.
Step 3: Build and Start Docker Containers
# Build and start the Docker containers
docker-compose up -d --build

This will create and start all the necessary containers:
PHP/Laravel application
Nginx web server
MySQL database
Adminer database management tool
Step 4: Install Dependencies and Set Up the Application
# Install PHP dependencies
docker-compose exec app composer install

# Set up Laravel key
docker-compose exec app php artisan key:generate

# Run database migrations and seeders
docker-compose exec app php artisan migrate:fresh --seed

# Set proper permissions for storage directory
docker-compose exec app chown -R www-data:www-data /var/www/storage
docker-compose exec app chmod -R 775 /var/www/storage

# Create symbolic link for storage
docker-compose exec app php artisan storage:link
Step 5: Compile Frontend Assets
# Install Node.js dependencies
docker-compose exec app npm install

# Build frontend assets
docker-compose exec app npm run build
Step 6: Clear Caches (Optional)
# Clear all Laravel caches
docker-compose exec app php artisan optimize:clear
Step 7: Access the Application
Main website: http://localhost:8090
Database administration (Adminer): http://localhost:8091
Server: db
Username: test
Password: test
Database: test
Step 8: Troubleshooting
If you encounter any issues:
Check container logs:

docker-compose logs -f




For specific container logs:


docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f db
Access the container shell:
 docker-compose exec app bash

Restart containers:

docker-compose down
docker-compose up -d
Development Workflow
For ongoing development:
Run Vite in development mode for real-time updates:

docker-compose exec app npm run dev


Make code changes in your local editor
Run Laravel commands when needed:

docker-compose exec app php artisan ...


To stop the containers when you're done:

docker-compose down
