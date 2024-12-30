Billing App
===========

**Billing App** is a Laravel-based system designed to manage invoices, payments, clients, and product categories efficiently. It offers a user-friendly interface for managing billing operations, calculating taxes and commissions, and allows flexible payment options, invoice attachments, and more.

Features
--------

*   **Category Management**: Create categories and add products associated with each category.
    
*   **Invoice Generation**: Create and manage invoices for clients with automatic tax and commission calculations.
    
*   **Attach Files**: Add attachments to invoices.
    
*   **Pay Later**: Enable the option to pay invoices later.
    
*   **Edit Invoices**: Edit invoices through the admin or system operator.
    
*   **Invoice Reports**: Search and generate reports for paid, partially paid, unpaid, or archived invoices.
    
*   **Permission Management**: Create and manage permissions for system access and add other administrators.
    
*   **Dashboard**: A detailed dashboard showing important statistics and reports about the invoices and payments.
    

System Requirements
-------------------

*   PHP 8.x
    
*   Composer
    
*   Laravel 10.x
    
*   MySQL (or compatible database)
    

Installation
------------
### Steps
1.  **Clone the repository**:
```bash
git clone https://github.com/Thomas-Emad/Billing-App.git
```
2.  **Navigate to the project directory**:
```bash
cd Billing-App
```
3.  **Install dependencies using Composer**:
```bash
composer install
```
4.  **Copy the `.env.example` file to `.env`**:
```bash
cp .env.example .env
```
5.  **Generate the application key:**:
```bash
php artisan key:generate
```
6. **Set up your database and update the .env file with your database credentials**.
7.  **Run the migrations to create the database tables with Seeder**:
```bash
php artisan migrate --seeder
```
8.  **Start the local development server**:
```bash
php artisan serve
```
Your app should now be running at `http://127.0.0.1:8000`.

Usage
-----
*   **Add Categories**: You can add new categories through the admin panel.
*   **Add Products**: Add products associated with each category and define their details.
*   **Create Invoices**: Generate invoices for clients with automatic tax and commission calculations.
*   **Edit Invoices**: Edit invoices either through the admin panel or by the system operator.
*   **Invoice Reports**: Search and filter for invoices by their status (paid, partially paid, unpaid, or archived).
*   **Manage Permissions**: Create permissions for other administrators and control their access.
*   **View Reports**: Access various financial reports and statistics related to invoices.
    
![dashboard](https://github.com/user-attachments/assets/01026153-4201-4d2b-9b6f-06a4682fa758)
![add-section](https://github.com/user-attachments/assets/37b0186f-4ee8-4067-824b-72d6a1f9cf60)
![sections](https://github.com/user-attachments/assets/7b219679-cac3-4dde-be4f-aed4682dfd94)
![products](https://github.com/user-attachments/assets/72554d69-f3dc-428e-8a6a-3bc935b452d6)
![add-product](https://github.com/user-attachments/assets/79d3c9ec-7c66-4195-9152-e03a903d7046)
![add-invoice](https://github.com/user-attachments/assets/3f010a9e-1ab5-49a4-a4c7-28c2b281098d)
![invoices](https://github.com/user-attachments/assets/aa5f15fc-6556-4b65-b5b6-35fd46c92db2)
![reports](https://github.com/user-attachments/assets/b0acd768-77c4-4889-bfb9-5aeb0dc19f40)
![permissions](https://github.com/user-attachments/assets/1f5496e2-ba9d-4ecd-bb8c-287447b25d38)

Contributing
------------
1.  Fork the repository.
2.  Create a new branch for your changes.
3.  Commit your changes with clear and descriptive messages.
4.  Push to your forked repository.
5.  Submit a pull request.

License
-------
This project is licensed under the **MIT License** - see the LICENSE file for details.
