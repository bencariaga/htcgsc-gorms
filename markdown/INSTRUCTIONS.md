# Project Documentation Guide

This directory contains modularized documentation for the HTCGSC-GORMS project.

## Documentation Index

- **[SETUP.md](SETUP.md)**: The primary guide for local installation and environment setup.
- **[DIRECTORIES.md](DIRECTORIES.md)**: Detailed breakdown of the project architecture and folder structure.
- **[TESTING.md](TESTING.md)**: Instructions for running automated logic and browser tests.
- **[SCHEMA.md](SCHEMA.md)**: Database table definitions and relationship map.
- **[XAMPP.md](XAMPP.md)**: Specific instructions for hosting via XAMPP.
- **[DEPLOYMENT.md](DEPLOYMENT.md)**: Guide for production deployment (Render).

## SOLID Principles in Documentation

Following the SOLID principles applied in the code, this documentation is modularized to ensure:

1. **Single Responsibility**: Each file covers a specific aspect of the system.
2. **Open/Closed**: New documentation can be added without modifying existing core guides extensively.
3. **Interface Segregation**: Developers only need to read the specific guides relevant to their current task (e.g., just `TESTING.md` if they are writing tests).
