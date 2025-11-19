# Digital Marketing WebApp (Laravel 10)

A complete digital marketing web application built with **Laravel 10** (frontend + backend).  
It includes a full blogging platform, CRM integration, WhatsApp API, appointment system, subscription management, email automation, and more.  
# Author: Saikat Golder
---

## 🚀 Tech Stack
- **Framework**: Laravel 10 (Blade templates for frontend + backend)
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **APIs**: WhatsApp API, CRM API
- **Mailing**: Laravel Mail, Queue, SMTP

---

## ✨ Features

### 📝 Core Blog Features
- User authentication (Register, Login, Logout)
- Role-based access control (Admin, Moderators, Subscriber)
- Create, edit, soft delete, and restore blog posts, comments..
- Rich text editor for blog content
- Upload & manage images/videos
- Comment system with moderation
- Category, Subcategory & Tag management
- Search & filter posts
- Pagination for posts

### 📊 Marketing & CRM Features
- Integrated CRM module for managing leads & clients
- WhatsApp API integration for instant communication
- Appointment booking & scheduling (calendar view)
- Subscription plans
- Newsletter & email marketing integration
- Brochure/PDF download system
- Contact form with automated email replies

### 📧 Email Notification System
- Welcome email on subscription
- Unsubscribe confirmation email
- Appointment booking emails (Success, Pending, Canceled)
- Admin notification for new subscriptions & appointments
- Newsletter broadcast to all subscribers
- Mail queue system for bulk email sending

### 🔗 API & Integration
- REST API endpoints
- Third-party API integration (CRM, WhatsApp, Mail)
- Secure authentication

### 📈 Advanced Features
- SEO-friendly URL structure
- Social media sharing for blog posts
- Analytics dashboard (views, subscribers, engagement stats)
- Push notifications for new posts or offers
- Admin dashboard for content & user management

### 💡 Extra
- Fully responsive
- Role-specific dashboards (Admin, Moderator)

---

## 🛠️ Installation Guide

### Prerequisites
- PHP >= 8.1  
- Composer  
- MySQL  
- Node.js & npm  

### Steps
```bash
# 1. Clone the repository
git clone https://github.com/saikat-byte/laravel-digital-marketing-webapp.git

cd REPO-NAME

# 2. Install dependencies
composer install
npm install

# 3. Copy .env file and set credentials
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Run migrations & seeders
php artisan migrate --seed

# 6. Run the application
php artisan serve

# 7. (Optional) Compile assets
npm run dev

# Developer Saikat Golder