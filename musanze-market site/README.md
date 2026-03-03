# 🥔 Musanze Market Order Slip

> **Advanced Web Design & Development — Assignment #2**  
> INES-Ruhengeri · Faculty of Sciences and Information Technology  

---

## 📌 Project Overview

A full-stack order management system built for potato aggregators and cooperative collection points in Musanze, Rwanda. Eliminates wrong totals, missing receipts, and scattered paper/WhatsApp records.

**Tech Stack:** HTML · CSS · Vanilla JS · PHP · MySQLi · MVC Architecture · Git/GitHub

---

## 🚀 Features

| Feature | Status |
|---------|--------|
| Supplier/farmer registration | ✅ |
| Order creation with live total calculator | ✅ |
| Auto-computed totals (qty × unit price) | ✅ |
| Printable receipt page | ✅ |
| MySQL storage with prepared statements | ✅ |
| Dashboard: today's orders, total value, recent orders | ✅ |
| Login system (aggregator/admin) | ✅ |
| Full CRUD for orders and suppliers | ✅ |
| Server-side + client-side validation | ✅ |
| Responsive design (mobile/tablet/desktop) | ✅ |
| Status filter + search on order lists | ✅ |

---

## 📁 MVC Folder Structure

```
musanze-market/
├── app/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── OrderController.php
│   │   └── SupplierController.php
│   ├── models/
│   │   ├── User.php
│   │   ├── Order.php
│   │   └── Supplier.php
│   └── views/
│       ├── auth/login.php
│       ├── dashboard/index.php
│       ├── orders/{create,edit,list,view,receipt}.php
│       ├── suppliers/{create,edit,list}.php
│       └── partials/{header,nav,footer}.php
├── assets/
│   ├── css/style.css
│   └── js/main.js
├── config/
│   └── database.php
├── database/
│   ├── schema.sql
│   └── seed.sql
├── docs/
│   ├── AI-usage.md
│   └── testing.md
├── public/
│   └── index.php          ← Front controller
├── .htaccess
└── README.md
```

---

## ⚙️ Setup Instructions

### Prerequisites
- PHP 8.1+
- MySQL 5.7+ / MariaDB 10.4+
- Apache with `mod_rewrite` enabled (or Nginx)
- A local server like XAMPP, WAMP, or MAMP

### Step 1 — Clone the repository
```bash
git clone https://github.com/YOUR_GROUP/musanze-market.git
cd musanze-market
```

### Step 2 — Create the database
Open phpMyAdmin or MySQL CLI and run:
```sql
source database/schema.sql
source database/seed.sql
```

### Step 3 — Configure database connection
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'musanze_market');
```

### Step 4 — Point your web server
If using XAMPP, place the project in `htdocs/musanze-market/`  
Then visit: `http://localhost/musanze-market/public/`

### Step 5 — Login
```
Email:    admin@musanze.rw
Password: password
```

---

## 🌐 Hosting Provider

**InfinityFree** (free PHP + MySQL hosting)  
Live URL: `https://musanzemarket.infinityfreeapp.com/`

### Deployment Steps (InfinityFree)
1. Create a free account at infinityfree.net
2. Create a new hosting account → note your MySQL host/user/pass
3. Upload all files via FTP (use FileZilla) to `/htdocs/`
4. Import `database/schema.sql` and `seed.sql` via phpMyAdmin (provided by InfinityFree)
5. Update `config/database.php` with your InfinityFree MySQL credentials
6. Visit your subdomain URL

---

## 👥 Group Members & Roles

| Member | Role |
|--------|------|
| Member 1 | Role 1 — Product Planner & Documentation Lead |
| Member 2 | Role 2 — UI/UX Designer |
| Member 3 | Role 3 — HTML Structure Engineer |
| Member 4 | Role 4 — CSS & Responsiveness Engineer |
| Member 5 | Role 5 — JavaScript Interaction Engineer |
| Member 6 | Role 6 — Backend PHP MVC Engineer |
| Member 7 | Role 7 — Database, Git & Deployment Engineer |

---

## 📧 Submission

**Email to:** mclement@ines.ac.rw  
**Subject:** `Ass#2_Advanced Web_Group#1_II_FEB_B`  
**CC:** All group members  

**Body must include:**
- Hosted link
- GitHub repository link
- Group member names + roles

---

*Built with ❤️ for Musanze, Rwanda — INES-Ruhengeri 2025*
