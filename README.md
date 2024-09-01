<h1 align="center">Inventory and Equipment Loan Management System</h1>
<p align="center">
      <img src='https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white'>   
      <img src='https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white'>   
      <img src='https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)'>   
      <img src='https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white'>
        
</p>

## Description

This system is designed to manage inventory and facilitate the loan of equipment within an educational institution. It features an informative section accessible to visitors, along with a detailed FAQs section to assist users. The system supports three distinct user roles:

Student: Can borrow one piece of equipment at a time.
Professor: Can borrow multiple pieces of equipment simultaneously.
Administrator: Manages the various aspects of equipment loans and can modify system settings.
The administrative section, accessible only by administrators, provides a comprehensive dashboard with useful insights. Administrators can create, edit, and delete loans, licenses, equipment, accessories, and components, all specifically related to computer hardware.

Additionally, the system generates detailed reports in PDF format for all loans, and automatically sends an email with loan information to users whenever a loan is made.

Communication within the system is secured through a RESTful API, with authentication managed via Bearer Tokens. These tokens are also crucial for restricting access to the administrative section, ensuring only authorized administrators can make changes.

## Stack

- Backend language: **PHP**
- Backend framework: **Laravel 10** 
- Frontend styles: **Bootstrap 4.6**
- PDF library: **mPDF/Laravel**
- Communication: **API Restful**

## Screenshots

<img src="https://i.imgur.com/Cwh1hzA.png"/>
<img src="https://i.imgur.com/EuL0Hsd.png"/>
<img src="https://i.imgur.com/2f4xnEQ.png"/>
<img src="https://i.imgur.com/WPROUqs.png"/>
<img src="https://i.imgur.com/OtskfEQ.png"/>
<div align="center">
    <img src="https://i.imgur.com/bMIexq9.png"/>
</div>






