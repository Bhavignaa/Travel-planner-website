# Travel-planner-website

This project is a complete travel booking and payment system that allows users to browse travel packages, book trips, and make secure payments. The website features destinations such as Dubai, Paris, Maldives, Japan, and India. The system also handles user data and payment details securely.

## Features

- **Responsive Design**: Built using HTML, CSS (Bootstrap), and JavaScript.
- **Travel Packages**: Users can explore various destinations and select their preferred travel package.
- **Booking Form**: Users can enter their personal details and travel information.
- **Payment Gateway**: Multiple payment methods including credit cards, UPI, and net banking.
- **Database Integration**: Payment details and traveller information are stored in a MySQL database.
- **User Authentication**: Login functionality is provided for users to manage their bookings and payment history.

## Technologies Used

- **Frontend:**
  - HTML5
  - CSS3 (Bootstrap for responsive design)
  - JavaScript (for interactivity and dynamic content)
- **Backend:**
  - PHP (for handling forms, data validation, and database interactions)
  - MySQL (for storing user data and payment records)
- **Database:**
  - MySQL

## File Structure

- **index1.html**: The landing page of the website, featuring travel packages and destination options.
- **login.html**: A page for users to log in to their accounts.
- **login.php**: PHP script that handles login form submissions.
- **about.html**: Provides information about the travel service and its offerings.
- **memories.html**: A page showcasing traveler memories or testimonials.
- **memories.php**: PHP script to handle data for the memories page.
- **payments.html**: The page where users enter payment information.
- **book.html**: A booking form for users to enter their details and book a package.
- **save_payments.php**: PHP script for saving payment details to the database.
- **save_traveller.php**: PHP script for saving traveller details to the database.
- **contact.html**: A contact page for users to get in touch with the service.
- **contact.php**: PHP script for processing contact form submissions.
- **dubai.html**: A dedicated page for the Dubai travel package.
- **paris.html**: A dedicated page for the Paris travel package.
- **maldives.html**: A dedicated page for the Maldives travel package.
- **japan.html**: A dedicated page for the Japan travel package.
- **india.html**: A dedicated page for the India travel package.

## Setup Instructions

### Prerequisites

- PHP >= 7.4
- MySQL database server
- Web server (Apache or Nginx)
- Bootstrap 5.3.0 (linked via CDN)

### Installation Steps

1. **Clone or Download the Repository**:
   Clone or download the project files to your local machine.

2. **Set Up Database**:
   Create a MySQL database and import the following SQL schema to set up the necessary tables:

   ```sql
   CREATE DATABASE travelDB;

   USE travelDB;

   CREATE TABLE travellers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       first_name VARCHAR(255),
       last_name VARCHAR(255),
       dob DATE,
       gender VARCHAR(10),
       passport VARCHAR(20),
       from_location VARCHAR(255),
       from_date DATE,
       to_location VARCHAR(255),
       to_date DATE,
       email VARCHAR(255),
       mobile_code VARCHAR(10),
       mobile VARCHAR(15),
       city VARCHAR(255),
       gst_state VARCHAR(50),
       address TEXT,
       special_request TEXT
   );

   CREATE TABLE payments (
       id INT AUTO_INCREMENT PRIMARY KEY,
       payment_method VARCHAR(50),
       amount DECIMAL(10, 2),
       currency VARCHAR(10),
       card_number VARCHAR(20),
       card_holder_name VARCHAR(255),
       expiry_date VARCHAR(5),
       cvv VARCHAR(3),
       upi_id VARCHAR(255),
       bank_name VARCHAR(255)
   );
