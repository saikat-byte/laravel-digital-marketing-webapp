# Clone the repository
git clone https://github.com/saikat-byte/cloudspace_project.git

# Go to project folder
cd your-repo-name

# Install dependencies
composer install
npm install && npm run dev

# Copy .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve


