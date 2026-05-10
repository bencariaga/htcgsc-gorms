# Project Documentation Guide

Welcome to the **HTCGSC-GORMS** documentation. This directory contains modularized guides to help you set up, develop, and deploy the Guidance Office Records Management System.

## 1. Documentation Index

### Core Setup & Development

- **[SETUP.md](SETUP.md)**: The primary guide for local installation and environment setup.
- **[XAMPP.md](XAMPP.md)**: Specific instructions for hosting via XAMPP on Windows.
- **[NGROK.md](NGROK.md)**: How to use Ngrok for local tunneling and testing external integrations.
- **[DIRECTORIES.md](DIRECTORIES.md)**: Detailed breakdown of the project architecture and folder structure.
- **[DATABASE_SCHEMA.md](DATABASE_SCHEMA.md)**: Database table definitions and relationship map.

### Advanced Features & Integration

- **[GOOGLE_APPS_SCRIPT.md](GOOGLE_APPS_SCRIPT.md)**: Connecting Google Forms to the system.
- **[TEXTBEE.md](TEXTBEE.md)**: Setting up the SMS gateway for notifications.
- **[CRON_JOB.md](CRON_JOB.md)**: Configuring automated tasks (reminders, maintenance).

### Testing & Quality Assurance

- **[TESTING.md](TESTING.md)**: Instructions for running automated logic and browser tests.
- **[LARAVEL_BEST_PRACTICES.md](LARAVEL_BEST_PRACTICES.md)**: Coding standards and patterns used in the project.

### Deployment & Containerization

- **[DOCKER.md](DOCKER.md)**: Comprehensive guide for containerizing the application with PHP 8.4-FPM, Nginx, and PostgreSQL using Docker Compose.
- **[RENDER.md](RENDER.md)**: Production deployment instructions for Render.com using the Docker blueprint and IaC approach.

## 2. Setup Roadmap

To get the system fully operational, we recommend the following sequence:

1. **Local Environment**: Follow `SETUP.md` and `XAMPP.md` to get the app running on your machine.
2. **External Integrations**: Set up `GOOGLE_APPS_SCRIPT.md` and `TEXTBEE.md` to enable data collection and SMS.
3. **Local Testing**: Use `NGROK.md` to verify that external services can communicate with your local server.
4. **Automation**: Configure `CRON_JOB.md` to enable appointment reminders.
5. **Quality Check**: Run tests using `TESTING.md` to ensure everything is working as expected.
6. **Deployment**: Use `DOCKER.md` and `RENDER.md` to move your application to production.

## 3. SOLID Principles in Documentation

Following the SOLID principles applied in the code, this documentation is modularized to ensure:

1. **Single Responsibility**: Each file covers a specific aspect of the system.
2. **Open/Closed**: New documentation can be added without modifying existing core guides.
3. **Interface Segregation**: Developers only need to read the specific guides relevant to their current task.
