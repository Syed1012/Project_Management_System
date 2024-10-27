# PMS - Project Management System 🎓

FPMS is a web-based project management system built to automate manual tasks involved in managing final year projects. It simplifies the process of assigning projects to students, forming panel members for project reviews, tracking student attendance at reviews, allocating review marks, and managing user details.

## Features

- **Role-based Access Control**: Separate roles for admin (HOD and senior staff), professor, and student to manage access to sensitive information.
- **Project Management**: CRUD operations for creating, updating, and managing project details, availability, and visibility.
- **Panel Formation**: Form panels of faculty members for project reviews.
- **Attendance Tracking**: Track student attendance at project reviews.
- **Review Marks Allocation**: Allocate marks to projects based on reviews.
- **User Management**: Manage user details such as student and faculty profiles.
- **Group Formation**: Form groups for students working on the same project.
- **Profile Editing**: Real-time editing of profiles to update details and change passwords.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL (phpMyAdmin)
![Screenshot 2024-05-03 210541]

## Screenshots

HomePage 
![Screenshot 2024-05-03 210609](https://github.com/Syed1012/FPMS/assets/84576013/ac9a32f0-60d1-439b-b28f-505c8ed7544e)

Group Formation 
![Screenshot 2024-05-03 210609](https://github.com/Syed1012/FPMS/assets/84576013/6e536513-7fa6-4e9b-8065-8c3938d11ed1)

Project CRUD Opertions
![Screenshot 2024-05-03 210609](https://github.com/Syed1012/FPMS/assets/84576013/08564937-35ad-4517-a795-e02f6e4359b7)
![Screenshot 2024-05-03 210609](https://github.com/Syed1012/FPMS/assets/84576013/7229a9d4-e349-4a2b-b321-aad0bd1348ae)

Professor Home page
![Screenshot 2024-05-03 210609](https://github.com/Syed1012/FPMS/assets/84576013/737c5710-1ef8-4239-81e8-eed6cd630e29)

## Installation

1. Clone the repository: `git clone https://github.com/your-username/fpms.git`
2. Import the database schema from `database/schema.sql` into phpMyAdmin.
3. Configure the database connection in `config.php`.
4. Start the PHP development server: `php -S localhost:8000`

## Usage

1. Navigate to the website in your browser.
2. Login with your credentials (admin/student/faculty).
3. Use the different modules to manage projects, panels, attendance, and marks.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
