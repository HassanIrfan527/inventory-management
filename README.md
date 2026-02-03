# Folio

Modern invoicing and client management for freelancers and small teams.

Folio is an all-in-one business operating system that helps you manage clients, track projects, generate professional invoices, and gain insights into your business—all from a clean, intuitive interface.

## Features

### Invoicing
- Generate professional PDF invoices with your company branding
- Track payment status (Unpaid, Partially Paid, Paid, Refunded, Overdue)
- Support for both customer and supplier invoices
- Auto-generated invoice numbers (INV-XXXXX format)
- Customizable terms and conditions
- Due date tracking with overdue alerts

### Client Management (CRM)
- Comprehensive contact database for customers, suppliers, and leads
- Activity tracking and timeline for each contact
- Engagement scoring to identify your best clients
- Custom fields for flexible data capture
- Tagging system for easy organization
- Track preferred contact methods and last interaction dates

### Order Management
- Create and track orders with detailed line items
- Payment method and status tracking
- Shipping and delivery tracking with timestamps
- Price snapshots preserve historical pricing data
- Link orders directly to contacts and auto-generate invoices
- Support for discounts, taxes, and delivery charges

### Dashboard & Analytics
- Real-time business metrics at a glance
- Revenue tracking and trends
- Order and inventory statistics
- Pending payments overview
- AI-powered insights (coming soon)

### Product/Service Catalog
- Track products, services, or project packages
- Organize with categories and tags
- Multi-image support for products
- Optional stock management (leave empty for services)
- Multiple view modes: Grid, List, Kanban, Compact
- SKU and custom product ID support

### Security
- Two-factor authentication (2FA)
- Email verification
- Secure password management
- Session management

### API
- RESTful JSON API (v1)
- Full CRUD operations for products, contacts, orders, and invoices
- Token-based authentication
- Pagination and filtering support

## Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | Laravel 12, PHP 8.2+ |
| **Frontend** | Livewire 4, Flux UI, Tailwind CSS 4 |
| **Database** | MySQL 8.0+ / PostgreSQL 14+ / SQLite |
| **PDF Generation** | Laravel DomPDF |
| **Authentication** | Laravel Fortify |
| **Build Tool** | Vite 7 |
| **Testing** | Pest 4 |

## Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL 8.0+ or PostgreSQL 14+ (SQLite for development)

## Installation

### Quick Setup

```bash
# Clone the repository
git clone https://github.com/yourusername/folio.git
cd folio

# Run the setup script (installs dependencies, generates key, runs migrations)
composer setup
```

### Manual Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Install Node dependencies
npm install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure your database in .env, then run migrations
php artisan migrate

# 6. (Optional) Seed sample data
php artisan db:seed

# 7. Build frontend assets
npm run build

# 8. Start the development server
php artisan serve
```

### Development Mode

For development with hot reloading and queue processing:

```bash
composer dev
```

This runs the web server, queue worker, log viewer, and Vite dev server concurrently.

## Configuration

### Environment Variables

Key variables to configure in your `.env` file:

```env
# Application
APP_NAME="Folio"
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=folio
DB_USERNAME=root
DB_PASSWORD=

# Mail (for invoices and notifications)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Usage

### Getting Started

1. **Register an account** and verify your email
2. **Set up your company info** (Settings → Company Info) for invoice branding
3. **Add your contacts** - clients, suppliers, or leads
4. **Create products/services** in your catalog
5. **Create orders** linked to your contacts
6. **Generate invoices** from orders with one click

### Workflow

```
Contact → Order → Invoice → Payment Tracking
```

Each step is connected, so you can trace any invoice back to the original contact and order.

## API Overview

Base URL: `/api/v1`

All endpoints require authentication.

| Resource | Endpoints |
|----------|-----------|
| **Products** | `GET/POST /items`, `GET/PUT/DELETE /items/{id}` |
| **Contacts** | `GET/POST /contacts`, `GET/PUT/DELETE /contacts/{id}` |
| **Orders** | `GET/POST /orders`, `GET/PUT/DELETE /orders/{id}` |
| **Invoices** | `GET /invoices`, `GET/PUT/DELETE /invoices/{id}` |

### Example: Create an Order

```bash
curl -X POST /api/v1/orders \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "contact_id": 1,
    "items": [
      {"product_id": 1, "quantity": 2, "sale_price": 100}
    ],
    "generate_invoice": true
  }'
```

## Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/OrderTest.php
```

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style

This project uses Laravel Pint for code formatting:

```bash
vendor/bin/pint
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

- Documentation: [/documentation](/documentation)
- Help Center: [/help](/help)
- Report Issues: [GitHub Issues](https://github.com/yourusername/folio/issues)

---

Built with Laravel and Livewire
