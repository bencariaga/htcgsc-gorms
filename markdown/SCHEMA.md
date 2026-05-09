# Database Schema

This document provides a detailed overview of the HTCGSC-GORMS database tables and relationships.

## 1. `persons` table

Core table storing personal information for all system participants.

| Column          | Data Type                          | Nullable | Notes                                                                         |
| :-------------- | :--------------------------------- | :------- | :---------------------------------------------------------------------------- |
| `person_id`     | int(10) UNSIGNED                   | no       | PK, auto-increment                                                            |
| `type`          | enum('Admin','Employee','Student') | no       | person type                                                                   |
| `last_name`     | varchar(20)                        | no       | person's last name                                                            |
| `first_name`    | varchar(20)                        | no       | person's first name                                                           |
| `middle_name`   | varchar(20)                        | yes      | person's middle name                                                          |
| `email_address` | varchar(60)                        | no       | email accounts must end with "**@gmail.com**" or "**@online.htcgsc.edu.ph**"  |
| `phone_number`  | varchar(11)                        | yes      | for SMS notifications; format: "**09XXXXXXXXX**" (example: "**09123456789**") |

## 2. `students` table

Extends the `persons` table specifically for students.

| Column       | Data Type        | Nullable | Notes              |
| :----------- | :--------------- | :------- | :----------------- |
| `student_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `person_id`  | int(10) UNSIGNED | no       | FK to `persons`    |

## 3. `users` table

Manages authentication credentials and account status.

| Column           | Data Type                 | Nullable | Notes                          |
| :--------------- | :------------------------ | :------- | :----------------------------- |
| `user_id`        | int(10) UNSIGNED          | no       | PK, auto-increment             |
| `person_id`      | int(10) UNSIGNED          | no       | FK to `persons`                |
| `account_status` | enum('Inactive','Active') | no       | account is inactive by default |
| `password`       | varchar(255)              | no       | hashed via bcrypt              |

## 4. `referrers` table

Identifies individuals (teachers/staff) who refer students.

| Column        | Data Type        | Nullable | Notes              |
| :------------ | :--------------- | :------- | :----------------- |
| `referrer_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `student_id`  | int(10) UNSIGNED | no       | FK to `students`   |

## 5. `referrals` table

Records the actual referral instance.

| Column        | Data Type        | Nullable | Notes              |
| :------------ | :--------------- | :------- | :----------------- |
| `referral_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `student_id`  | int(10) UNSIGNED | no       | FK to `students`   |

## 6. `appointments` table

Manages the scheduling of guidance sessions.

| Column               | Data Type                                                                                                                             | Nullable | Notes                 |
| :------------------- | :------------------------------------------------------------------------------------------------------------------------------------ | :------- | :-------------------- |
| `appointment_id`     | int(10) UNSIGNED                                                                                                                      | no       | PK, auto-increment    |
| `referrer_id`        | int(10) UNSIGNED                                                                                                                      | no       | FK to `referrers`     |
| `referral_id`        | int(10) UNSIGNED                                                                                                                      | no       | FK to `referrals`     |
| `appointment_date`   | date                                                                                                                                  | no       | date of appointment   |
| `appointment_time`   | enum('8:30 AM - 9:30 AM', '9:30 AM - 10:30 AM', '10:30 AM - 11:30 AM', '1:30 PM - 2:30 PM', '2:30 PM - 3:30 PM', '3:30 PM - 4:30 PM') | no       | time of appointment   |
| `appointment_status` | enum('Scheduled','Done','Cancelled','Missed')                                                                                         | no       | status of appointment |

## 7. `reports` table

Logs generated system reports.

| Column               | Data Type                                   | Nullable | Notes                            |
| :------------------- | :------------------------------------------ | :------- | :------------------------------- |
| `report_id`          | int(10) UNSIGNED                            | no       | PK, auto-increment               |
| `title`              | varchar(20)                                 | no       | title of the report              |
| `data_category`      | enum('Users','Students','Form Submissions') | no       | data category of the report      |
| `file_output_format` | enum('PDF','Excel')                         | no       | file output format of the report |

## 8. `all_activities` view

Combines data from referrals and appointments for a unified activity log.

| Column               | Data Type                       | Nullable | Notes                                |
| -------------------- | ------------------------------- | -------- | ------------------------------------ |
| `referral_id`        | int(10) UNSIGNED                | no       | PK in referrals, FK in appointments  |
| `student_id`         | decimal(10,0)                   | yes      | ID of the student involved           |
| `referrer_id`        | decimal(10,0)                   | yes      | ID of the person making the referral |
| `created_at`         | timestamp                       | yes      | Record creation timestamp            |
| `updated_at`         | timestamp                       | yes      | Record last update timestamp         |
| `appointment_id`     | decimal(10,0)                   | yes      | Unique ID for the appointment        |
| `referral_type`      | enum('Yourself','Someone Else') | yes      | Type of referral made                |
| `reason`             | varchar(255)                    | yes      | Reason for the activity              |
| `appointment_date`   | date                            | yes      | Scheduled date for the appointment   |
| `appointment_time`   | enum(...)                       | yes      | Time slot for the appointment        |
| `appointment_status` | enum(...)                       | yes      | Current status of the appointment    |
| `laravel_model`      | varchar(22)                     | no       | Polymorphic model class name         |
