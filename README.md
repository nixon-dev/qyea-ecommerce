# 🛍️ QYEA Mart - Smart Inventory Management System

A custom made E-Commerce dedicated to QYEA at Quirino State University.

> 🚀 This was a college capstone project, web development using raw PHP/HTML/CSS/JS and MySQL.

---

## 📌 Features

- 💡 Product and Supply Stock Management System
- 📊 Interactive data tables using DataTables
- 📈 Visual reports using Chart.js
- 📬 Email Verification using PHPMailer
- 🔐 Multiple role-base authentication
- 🛠 Admin and Staff dashboard for managing consumers, orders, products stock, supplies stock and etc.
- 🧑🏼‍🦰 Consumer dashboard to conveniently view their orders, and bought goods.

---

## 🧰 Tech Stack

- **Backend:** PHP (no framework)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Libraries & APIs:**
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer) – for sending billing statements via email
  - [DataTables](https://datatables.net/) – for enhanced table functionality
  - [Chart.js](https://www.chartjs.org/) – for graphical data representation


## 🔧 Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/nixon-dev/qyea-ecommerce.git
2. Setup MySQL database
3. After importing MySQL DB, change credentials in inc/db_conn.php
   ```php
   $host = 'localhost';
   $username = 'your_db_username';
   $password = 'your_db_password';
   $database = 'your_db_name';
