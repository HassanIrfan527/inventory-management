
# Shop & Services — Version 1 (MVP)

## Overview

- **Purpose**: Deliver a minimal, usable Inventory Management System covering inventory, orders, invoices, and contact management so users can track stock and handle sales.
- **Scope**: Only core flows and conservative UX (no advanced analytics, no multi-warehouse, no role-permission UI beyond Admin/Staff).

## Goals

- **Basic inventory tracking**: create/update products, adjust stock, view low-stock list.
- **Order lifecycle**: create orders, reserve/decrement stock, mark fulfilled.
- **Invoicing**: generate invoices from orders, download as PDF, mark paid/unpaid.
- **Contacts**: CRUD contacts (customers & suppliers), link to orders/invoices.
- **Authentication**: simple auth with Admin and Staff roles.

## MVP Feature List (Priority order)

- **Authentication**: login, logout, password reset; roles: `admin`, `staff`.
- **Dashboard**: summary counts (products, low stock, open orders, unpaid invoices).
- **Products**: CRUD product with SKU, name, description, cost price, sale price, unit, supplier reference, barcode (optional).
- **Inventory / Stock**: view current stock per product, manual stock adjustments with reason, stock history log, low-stock threshold and alert list.
- **Contacts**: CRUD contact with type (customer/supplier), name, email, phone, address, notes, optional custom fields.
- **Orders**: create order for a contact, add items (product, qty, unit price), calculate totals, apply taxes/discounts, save as Draft / Confirmed / Fulfilled / Cancelled.
- **Invoices**: create invoice from order, editable invoice fields, generate PDF, mark as Paid/Unpaid/Partially Paid.
- **Basic reporting**: export product list and orders to CSV.
- **API Endpoints**: basic JSON API for products, orders, invoices, contacts (read/write for internal use).
- **Validation & Tests**: form validation and a small suite of feature tests covering main flows.

## Minimal Data Models (essential fields)

- **User**: `id`, `name`, `email`, `password`, `role`(`admin|staff`), `two_factor`(optional).
- **Product**: `id`, `sku`, `name`, `description`, `cost_price`, `sale_price`, `unit`, `low_stock_threshold`, `supplier_id`, `barcode`, `created_at`, `updated_at`.
- **InventoryEntry** (stock history): `id`, `product_id`, `change`(int), `type`(`adjustment|order|import`), `reference_id` (nullable), `reason`, `user_id`, `created_at`.
- **Contact**: `id`, `type`(`customer|supplier`), `name`, `email`, `phone`, `address`, `notes`, `created_at`.
- **Order**: `id`, `contact_id`, `status`(`draft|confirmed|fulfilled|cancelled`), `total`, `tax`, `discount`, `created_by`, `created_at`.
- **OrderItem**: `id`, `order_id`, `product_id`, `quantity`, `unit_price`, `line_total`.
- **Invoice**: `id`, `order_id`, `invoice_number`, `issued_at`, `due_at`, `status`(`unpaid|paid|partial`), `total`, `pdf_path`.

## Minimal Routes / Endpoints (examples)

- Web: GET `/dashboard`, `/products`, `/products/create`, `/products/{id}`, `/inventory`, `/orders`, `/orders/create`, `/invoices`, `/contacts`
- API (JSON): `GET /api/products`, `POST /api/products`, `GET /api/orders`, `POST /api/orders`, `POST /api/invoices`

## UI Pages & Components (Livewire suggestions)

- **Dashboard**: small widgets for counts and low-stock table.
- **Products**: list, create/edit modal or page, product detail with stock history.
- **Inventory Adjustments**: form to add/subtract stock with reason.
- **Orders**: order creation wizard (contact lookup, add items, review totals), order list with filters.
- **Invoices**: show invoice, download PDF, payment status toggle.
- **Contacts**: list, create/edit contact.

## Acceptance Criteria (per feature)

- **Product CRUD**: can add/edit/delete a product; deleting requires no linked order or soft-delete.
- **Stock changes**: stock adjustments create `InventoryEntry` records and update product stock atomically.
- **Order to stock**: confirming an order reduces available stock (or reserves it) and creates inventory entries.
- **Invoice generation**: invoice created from order with correct totals; PDF file is generated and downloadable.
- **Contacts**: contact linked to orders/invoices and searchable.
- **Auth**: only authenticated users can access app; `staff` cannot access user management.

## Implementation Notes & Tips

- Use existing Laravel stack (Livewire for interactivity). Keep UI simple and responsive.
- Prefer soft deletes for records that may be referenced (products, contacts).
- Keep business rules minimal for MVP: single currency, single tax rate per order (support custom later).
- For PDFs, use a stable package like `barryvdh/laravel-dompdf` (already common in Laravel projects).
- Use database transactions for multi-step flows (order creation + stock updates + invoice generation).
- Add request validation classes and form-level client-side validation where convenient.

## Testing & QA

- Add feature tests for: product CRUD, stock adjustment, order creation & confirm, invoice generation & PDF download, contact CRUD, and auth restrictions.
- Add a small seed dataset for manual QA (10 products, 5 contacts, 5 orders).

## Non-Functional Requirements

- **Security**: sanitize inputs, protect routes with middleware, secure file storage for PDFs.
- **Performance**: paginate lists, index key columns (`sku`, `name`, `contact_id`, `created_at`).
- **Backups**: document DB backup steps before launch.

## Deployment & Environment

- **Env vars**: `APP_URL`, `DB_*`, `MAIL_*`, `APP_ENV`, `APP_DEBUG=false`.
- **Queue**: optional—use for PDF generation in background if needed.
- **Storage**: put generated PDFs in `storage/app/public/invoices` and link with `php artisan storage:link`.

## Minimum Deliverable (Definition of Done)

- Auth works and two roles exist.
- Products and Contacts CRUD implemented.
- Manual stock adjustments and stock history available.
- Orders can be created and confirmed, stock updates correctly.
- Invoice generation from order with PDF download.
- Basic dashboard and CSV exports.
- Automated tests covering core flows.
- Brief README section describing setup and deployment.

## Next Steps (post-MVP)

- Add payments integration, multi-warehouse, role-based permissions UI, recurring invoices, audit log, product bundles/variants, and better analytics.

---
File created for: Shop & Services — MVP guidance

