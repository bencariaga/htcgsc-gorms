# Project Documentation Guide

Welcome to the **HTCGSC-GORMS** documentation. This directory contains modularized guides to help you set up, develop, manage, and deploy the Guidance Office Records Management System.

## 1. Documentation Index

### Local Environment Setup and Development

- **[SETUP.md](SETUP.md)**: The primary guide for local installation and environment setup.
- **[XAMPP.md](XAMPP.md)**: Specific instructions for hosting via XAMPP on Windows.
- **[DIRECTORIES.md](DIRECTORIES.md)**: Detailed breakdown of the project architecture and folder structure.
- **[DATABASE_SCHEMA.md](DATABASE_SCHEMA.md)**: Database table definitions and relationship map.
- **[NGROK.md](NGROK.md)**: How to use Ngrok for local tunneling and testing external integrations.

### Third-Party Tools and System Integration

- **[GOOGLE_APPS_SCRIPT.md](GOOGLE_APPS_SCRIPT.md)**: Connecting Google Forms to the system.
- **[TEXTBEE.md](TEXTBEE.md)**: Setting up the SMS gateway for notifications.
- **[CRON_JOB.md](CRON_JOB.md)**: Configuring automated tasks (reminders, maintenance).

### Testing and Quality Check

- **[TESTING.md](TESTING.md)**: Instructions for running automated logic and browser tests.
- **[LARAVEL_BEST_PRACTICES.md](LARAVEL_BEST_PRACTICES.md)**: Coding standards and patterns used in the project.

### Containerization and Deployment

- **[DOCKER.md](DOCKER.md)**: Comprehensive guide for containerizing the application with PHP 8.4-FPM, Nginx, and PostgreSQL using Docker Compose.
- **[RENDER.md](RENDER.md)**: Production deployment instructions for Render.com using the Docker blueprint and IaC approach.

## 2. Setup Roadmap

To get the system fully operational, we recommend the following sequence:

1. **Local Environment Setup and Development**: Follow `SETUP.md` and `XAMPP.md` to get the app running on your machine.
2. **Local Testing**: Use `NGROK.md` to verify that external services can communicate with your local server.
3. **Third-Party Tools and System Integration**: Set up `GOOGLE_APPS_SCRIPT.md` and `TEXTBEE.md` to enable data collection and SMS.
4. **Automation**: Configure `CRON_JOB.md` to enable appointment reminders.
5. **Testing and Quality Check**: Run tests using `TESTING.md` to ensure everything is working as expected.
6. **Containerization and Deployment**: Use `DOCKER.md` and `RENDER.md` to move your application to production.

## 3. SOLID Principles

Following the SOLID principles, the backend directories of the system must be kept divided into shorter and thinner but more manageable and organized unique PHP code files to ensure the following:

1. **Single Responsibility:** Each class or method does exactly **one** thing. No more "god controllers" that handle validation, math, database saving, and emails all in one function.
2. **Open-Closed:** Your code is **closed** for modification but **open** for extension. You should be able to add new features (like a new type of invoice) by adding new code, not by changing the old, working code.
3. **Liskov Substitution:** Different classes that do the same thing should be **interchangeable**. If you swap one "payment provider" class for another, the rest of your app shouldn't even notice the difference.
4. **Interface Segregation:** Don't force a class to implement methods it doesn't need. It's better to have several **small, specific interfaces** than one giant one that does everything.
5. **Dependency Inversion:** Your high-level logic should depend on **abstractions** (interfaces), not concrete classes. This makes it easy to swap out real services for "fake" ones during testing.
