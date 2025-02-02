# Event Management System

A PHP-based Event Management System that allows users to create, manage, and attend events. Built using **pure PHP (no frameworks)**, MySQL, and Bootstrap, following the **MVC architecture**.

## 🔗 Live Demo  
[Event Management System](http://52.221.126.63:8050/)

## 📂 Features

✅ User Registration & Login  
✅ Event Creation & Management  
✅ Attendee Booking System  
✅ Sorting & Pagination for Events  
✅ Search Functionality  
✅ CSV Export for Admin Reports  
✅ Secure Authentication & Validation  

## ⚙️ Technologies Used

- **Backend:** PHP (No Framework)  
- **Frontend:** HTML, CSS, Bootstrap  
- **Database:** MySQL  
- **Server:** Apache (Google Cloud Platform)  

## 🚀 Installation

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/shuvabiswas12/event_management.git
cd event_management
```

### 2️⃣ Configure the Database
1. Create a **MySQL database** named `event_management`.  
2. Import the database schema from `database/event_management.sql`.  
3. Update database credentials in `app/config/config.php`:
```php
define('DB_HOST', 'your-database-host');
define('DB_USER', 'your-username');
define('DB_PASS', 'your-password');
define('DB_NAME', 'event_management');
```

### 3️⃣ Run the Application
- If using **Apache**, place the project inside `/var/www/html/` (Linux) or `htdocs` (Windows).  
- Start the server:
  ```bash
  sudo systemctl restart apache2
  ```

- Visit the application in your browser:
  ```
  http://localhost/event_management
  ```

## 🛠️ Project Structure

```
event_management/
│-- app/
│   │-- config/           # Configuration files  
│   │-- controllers/      # Handles requests and logic  
│   │-- models/           # Database interactions  
│   │-- views/            # HTML templates  
│-- database/            # Database schema and migrations  
│-- public/              # Assets (CSS, JS, images)  
│-- route.php            # Main entry point (router)  
│-- README.md            # Project documentation  
```

## ✨ Future Enhancements

🔹 Implement Role-Based Access Control (RBAC)  
🔹 API Integration for External Event Sharing  
🔹 Improved UI/UX with AJAX and JavaScript  

## 🤝 Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss.  

## 📩 Contact
If you have any questions, feel free to reach out at:  
📧 **shuvabiswas12@gmail.com**
