# Order checkout simulation

Allows you to view a product, checkout and verify different payment outcomes

## Tech Stack

- Laravel
- MySQL
- Vue js
- tailwind
---

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/jinuvarghese-cmd/checkout-simulation.git
   cd checkout-simulation
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   

4. **Update `.env` with your DB details**
   ```env
   DB_DATABASE=ecommerce
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

   > **Note:** To enable email features (like order confirmation or password reset), configure your `.env` with [Mailtrap](https://mailtrap.io/) or any SMTP service:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"
 ```

5. **Clear Cache**
   ```bash
   php artisan optimize
   ```

6. **Run migrations and seeder**
   ```bash
   php artisan migrate --seed
   ```

9. **Serve the application and run npm**
   ```bash
   php artisan serve
   npm i
   npm run dev
   ```


---
