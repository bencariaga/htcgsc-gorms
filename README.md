# HTCGSC-GORMS

<p align="center">
  <img src="public/images/HTCGSC-GORMS-logo.png" width="180" alt="GORMS Logo">
  <br>
  <b>Holy Trinity College of General Santos City</b><br>
  Guidance Office Records Management System
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Livewire-4e1fe0?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📝 Introduction

**HTCGSC-GORMS** is a specialized record management system developed for the **Guidance and Testing Center (GTC)** of Holy Trinity College of General Santos City. 

The system was designed to transform the Guidance Office's traditional, paper-based workflows into a streamlined digital environment. By automating record-keeping for counseling, referrals, and student appointments, GORMS enhances data integrity, ensures rapid retrieval, and provides a secure platform for sensitive student information.

> [!NOTE]
> This project was developed as a documentary requirement for the **On-the-Job Training (OJT)** portfolio by **Benhur L. Cariaga** (BSIT-4), under the supervision of **Prof. Abejah S. Paculdo, MIT**.

---

## ✨ Key Features

### 📂 Record Management
- **Student Profiling:** Centralized database for student information and academic history.
- **Counseling Logs:** Secure recording of guidance sessions and behavioral observations.
- **Archive System:** Efficient data lifecycle management to keep the active database clean.

### 📅 Appointment & Referrals
- **Smart Scheduling:** Automated appointment booking with conflict detection.
- **Referral Tracking:** Seamless integration for teachers and staff to refer students for guidance.
- **Real-time Status:** Track the progress of referrals from submission to completion.

### 🔐 Security & Communication
- **Role-Based Access Control (RBAC):** Granular permissions for Administrators, Staff, and Students.
- **OTP Authentication:** Enhanced security via One-Time Passwords for sensitive actions.
- **Multi-channel Notifications:** Automated SMS and Email alerts for appointments and updates.

---

## 🛠️ Tech Stack

### Backend
- **Framework:** [Laravel 12.x](https://laravel.com) (PHP 8.4+)
- **Logic Patterns:** Service-Action-Repository architecture.
- **Testing:** [Pest PHP](https://pestphp.com/) for unit and browser testing.

### Frontend
- **Reactivity:** [Livewire 3](https://livewire.laravel.com/) for a "single-page app" feel with PHP.
- **Styling:** [Tailwind CSS 4](https://tailwindcss.com/) for modern, responsive design.
- **Interactions:** [Alpine.js](https://alpinejs.dev/) for lightweight client-side logic.

### Infrastructure
- **Database:** MySQL (MariaDB) for development, PostgreSQL-ready for production.
- **Local Dev:** XAMPP / Laragon.
- **Integrations:** Semaphore SMS API, Google Forms (via Apps Script), and SMTP for emails.

---

## 🚀 Getting Started

### Prerequisites
- **PHP 8.4** or higher
- **Composer** (PHP Package Manager)
- **Node.js 20+** & **npm**
- **MySQL/MariaDB**

### Quick Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/bencariaga/htcgsc-gorms.git
   cd htcgsc-gorms
   ```

2. **Run the Setup Script:**
   The project includes a custom setup command that handles environment configuration, migrations, and seeding:
   ```bash
   composer setup
   ```

3. **Install & Compile Frontend Assets:**
   ```bash
   npm install
   npm run dev
   ```

4. **Access the System:**
   Open your browser and navigate to `http://localhost:8000` (or your local Apache URL).

---

## 🏗️ System Architecture

### Database Overview
The system utilizes a complex schema designed for scalability and data integrity.

<details>
<summary><b>Click to expand Database Table List (28+ Tables)</b></summary>

| Category | Tables |
| :--- | :--- |
| **Core Identity** | `persons`, `students`, `users`, `roles`, `members`, `accounts` |
| **Operations** | `appointments`, `referrals`, `referrers`, `reports`, `logs` |
| **Communication** | `messages`, `message_templates`, `contacts` |
| **Files & Data** | `files`, `data`, `cache`, `cache_locks` |
| **OJT Specifics** | `applicants`, `patients`, `households`, `occupations`, `affiliate_partners`, `sponsors`, `signers`, `services`, `tariff_lists`, `budget_updates`, `expense_ranges`, `applications`, `guarantee_letters` |

*Refer to `htcgsc_gorms.sql` for the full schema definitions.*
</details>

### Directory Map
The project follows an organized structure to separate business logic from the framework core.

<details>
<summary><b>Click to expand Directory Map</b></summary>

```text
app/
├─ Actions/      # Pure business logic (e.g., CreateUser, GenerateGL)
├─ Http/
│  ├─ Controllers/
│  └─ Livewire/  # Dynamic UI components
├─ Models/       # Database Entities
├─ Services/     # Third-party integrations (SMS, Email)
resources/
├─ views/        # Blade Templates
└─ css/          # Tailwind Styles
```
</details>

---

## 👨‍💻 Developer Guide

### Recommended VS Code Extensions
To maintain the coding standards of this project, we recommend the following:
- **Laravel Suite:** `onecentlin.laravel-extension-pack`, `shufo.vscode-blade-formatter`
- **PHP Support:** `DEVSENSE.phptools-vscode`, `bmewburn.vscode-intelephense-client`
- **Frontend:** `Zignd.html-css-class-completion`, `formulahendry.auto-rename-tag`

### Testing
We use [Pest](https://pestphp.com/) for automated testing.
```bash
php artisan test
```

---

## 📜 Links & Resources
- **Project Documentation:** [09-14-25-Revision-AMPING-MAMANS.docx](https://github.com/bencariaga/htcgsc-gorms)
- **Modified XAMPP System:** [Google Drive Link](https://drive.google.com/file/d/1xoiNblNZs6JtTmtXEvC-1xrM09of9RSi/view?usp=sharing)
- **GitHub Repo:** [bencariaga/htcgsc-gorms](https://github.com/bencariaga/htcgsc-gorms)

---

## ⚖️ License & Acknowledgements
- Distributed under the **MIT License**.
- Special thanks to the **HTCGSC Guidance and Testing Center** staff for their domain expertise and cooperation.
- Mentorship by **Prof. Abejah S. Paculdo, MIT**.

---
<p align="center">
  Developed with ❤️ by <b>Benhur L. Cariaga</b>
</p>
