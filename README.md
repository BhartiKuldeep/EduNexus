# EduNexus

> **A unified college ERP platform that connects students, faculty, departments, attendance, exams, fees, and academic operations in one streamlined system.**

EduNexus is a **College ERP starter project** built with **plain PHP**, an **MVC-style architecture**, and **SQLite** for quick setup. It is designed for academic administration workflows and can serve as a strong base for a final-year project, portfolio project, or campus management system prototype.

---

## Table of Contents

- [Overview](#overview)
- [Core Features](#core-features)
- [Modules Included](#modules-included)
- [Role-Based Access](#role-based-access)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Demo Accounts](#demo-accounts)
- [Database Design](#database-design)
- [Security Notes](#security-notes)
- [Current Scope](#current-scope)
- [Future Improvements](#future-improvements)

---

## Overview

Managing a college involves multiple moving parts: departments, faculty, student records, course allocation, attendance, exams, results, and fee tracking. EduNexus brings these workflows together into a single dashboard-driven system.

This repository contains a working starter implementation with:

- secure login flow
- role-based access control
- dashboard analytics
- department and faculty management
- student and course management
- course enrollments
- attendance tracking
- fee management
- exam scheduling
- result publishing

It is intentionally lightweight, readable, and easy to extend.

---

## Core Features

### Centralized Academic Management
Handle departments, faculty, students, and courses from one connected admin interface.

### Role-Based Access Control
Separate access for **Admin**, **Faculty**, and **Accountant** users.

### Attendance Tracking
Record and review attendance entries for students by course and date.

### Fee Monitoring
Track pending and paid fees with due dates, remarks, and payment updates.

### Exam & Result Workflow
Create exams, assign maximum marks, publish results, and auto-generate grades.

### Dashboard Insights
Get a quick snapshot of departments, faculty, students, courses, pending fees, collected fees, recent attendance, and latest results.

---

## Modules Included

### 1. Authentication
- login/logout flow
- session-based authentication
- protected routes
- guest/auth middleware

### 2. Dashboard
- total departments
- total faculty
- total students
- total courses
- pending fee count
- collected fee amount
- recent attendance log
- recent results overview

### 3. Departments
- create department
- list department records
- delete department

### 4. Faculty
- add faculty members
- assign department
- manage contact details
- delete faculty records

### 5. Students
- add student profiles
- assign roll number, semester, and department
- manage status and contact info
- delete student records

### 6. Courses
- create course records
- assign department, semester, credits, and faculty
- delete course entries

### 7. Enrollments
- map students to courses
- view enrollment records
- remove enrollments

### 8. Attendance
- mark student attendance
- attach attendance to course and date
- store status such as present, absent, or late

### 9. Fees
- create fee records
- track due date and payment status
- mark fees as paid
- add remarks for transactions

### 10. Exams
- create course-specific exams
- store exam date and max marks

### 11. Results
- publish student marks
- auto-calculate grade based on marks

---

## Role-Based Access

| Role | Access |
|------|--------|
| **Admin** | Full access to all modules |
| **Faculty** | Attendance, Exams, Results |
| **Accountant** | Fees management |

---

## Tech Stack

| Layer | Technology |
|------|------------|
| Backend | PHP 8.4+ |
| Architecture | Custom MVC-style structure |
| Database | SQLite |
| Routing | Custom router |
| Authentication | Session-based |
| Security | CSRF token verification |
| Frontend | Server-rendered PHP views + CSS |

---

## Project Structure

```text
project/
├── app/
│   ├── Controllers/
│   ├── Core/
│   ├── Models/
│   ├── Views/
│   └── helpers.php
├── config/
│   └── app.php
├── database/
│   ├── database.sqlite
│   ├── schema.sql
│   └── seed.php
├── public/
│   ├── assets/
│   ├── .htaccess
│   └── index.php
├── routes/
│   └── web.php
├── storage/
├── bootstrap.php
└── README.md
```

### Folder Summary

- **app/Controllers** — request handlers for each module
- **app/Core** — router, auth, database, view renderer, CSRF handling
- **app/Models** — data access layer for entities
- **app/Views** — page templates and UI views
- **database/schema.sql** — database structure
- **database/seed.php** — demo data seeding script
- **routes/web.php** — route definitions and middleware mapping

---

## Getting Started

### Prerequisites

Make sure your environment has:

- **PHP 8.4 or above**
- **PDO SQLite extension enabled**

### 1. Clone the repository

```bash
git clone https://github.com/BhartiKuldeep/EduNexus.git
cd EduNexus
```

### 2. Seed the database

```bash
php database/seed.php
```

### 3. Run the application

```bash
php -S localhost:8000 -t public
```

### 4. Open in browser

```text
http://localhost:8000
```

---

## Demo Accounts

Use these accounts after seeding the database:

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@edunexus.local` | `password` |
| Faculty | `faculty@edunexus.local` | `password` |
| Accountant | `accounts@edunexus.local` | `password` |

---

## Database Design

The project currently includes the following core tables:

- `users`
- `departments`
- `faculties`
- `students`
- `courses`
- `enrollments`
- `attendance`
- `fees`
- `exams`
- `results`

### Entity Coverage

- **Users** manage authentication and roles
- **Departments** organize academic divisions
- **Faculties** belong to departments
- **Students** belong to departments and semesters
- **Courses** are assigned to departments and faculty
- **Enrollments** connect students and courses
- **Attendance** stores student presence records
- **Fees** manage tuition/payment tracking
- **Exams** define assessment events
- **Results** store marks and grades per student

---

## Security Notes

EduNexus includes foundational security mechanisms for a starter ERP project:

- session-based authentication
- route protection with auth and guest middleware
- role-based authorization
- CSRF token verification on form submissions
- password hashing using PHP password helpers

This is a strong starter structure, but before production deployment you should add:

- input validation hardening
- prepared query review for all write paths
- stronger error handling and logging
- environment-based config management
- password reset and email verification
- audit logs and activity tracking

---

## Current Scope

This repository is a **solid starter ERP**, not a full enterprise campus suite yet.


---

## Future Improvements

Here are strong next upgrades for EduNexus:

- semester-wise timetable management
- subject-wise attendance percentage reports
- marksheet generation in PDF
- student profile pages
- faculty workload dashboard
- fee receipt generation
- notice board and event module
- search, filtering, and pagination
- REST API support
- responsive UI redesign with charts and cards
