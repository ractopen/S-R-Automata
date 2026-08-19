# S-R Automata Project

## Development Workflow

This document outlines the standard coding workflow, commit message conventions, and setup instructions for developers working on this project.

---

## Coding Workflow

### Before Starting to Code

1. **Pull Latest Changes**: Ensure the local main branch is fully updated:
   ```bash
   git checkout main
   git sync
   ```
2. **Start the Database**: Ensure the PostgreSQL service is active (either via Docker or system service).
3. **Create a Feature Branch**: Create a dedicated branch for the task:
   ```bash
   git hack feature/branch-name
   ```
4. **Install Dependencies**: Verify that dependencies are up to date:
   ```bash
   composer install
   npm install
   ```
5. **Start Development Servers**: Start the local Laravel server and Vite server:
   ```bash
   php artisan serve
   npm run dev
   ```

### Ending a Coding Session

1. **Verify Changes**: Test the implementation locally to ensure there are no errors.
2. **Stage and Commit**: Stage modified files and write a commit message following the conventions:
   ```bash
   git add .
   git commit -m "feat(scope): description of changes"
   ```
3. **Sync with Remote**: Update the branch and push changes to the remote repository:
   ```bash
   git sync
   ```
4. **Create a Proposal**: Submit a pull request/proposal to merge changes:
   ```bash
   git propose
   ```
5. **Clean Up**: Once the pull request is merged, return to main, pull changes, and delete the feature branch:
   ```bash
   git checkout main
   git sync
   git ship feature/branch-name
   ```
6. **Stop Database Service**: Stop the database service if no longer needed.

---

## Commit Message Conventions

This project follows the Conventional Commits standard:
*   `feat`: A new feature (e.g., `feat(auth): add login with Google`).
*   `fix`: A bug fix (e.g., `fix(database): resolve connection timeout error`).
*   `docs`: Documentation changes (e.g., `docs(readme): add installation guide`).
*   `style`: Formatting, missing semi-colons (no code changes; e.g., `style: run prettier`).
*   `refactor`: Code change that neither fixes a bug nor adds a feature (e.g., `refactor(utils): simplify date parser`).
*   `test`: Adding or correcting tests (e.g., `test(auth): add unit tests for token validation`).
*   `chore`: Updating build tasks, package manager configs, etc. (e.g., `chore: bump dependencies`).

---

## Project Setup Guide

### Prerequisites
*   PHP 8.2+
*   Composer
*   Node.js & npm
*   PostgreSQL (either run via Docker or installed natively)

### 1. Database Setup

Set up a PostgreSQL database using one of the following methods:

#### Option A: Using Docker
Start a PostgreSQL container with:
```bash
docker run --name postgres-db -e POSTGRES_PASSWORD=secretpassword -e POSTGRES_DB=sr_automata -p 5432:5432 -d postgres:latest
```

#### Option B: Native Installation
Install PostgreSQL natively on your system and create a database named `sr_automata` using your database tool of choice.

---

### 2. Installation Steps

```bash
# 1. Clone the repository
git clone https://github.com/Ractopen-Academic/S-R-Automata.git
cd S-R-Automata

# 2. Install package dependencies
composer install
npm install

# 3. Create env file and generate app key
cp .env.example .env
php artisan key:generate
```

---

### 3. Database Connection Configuration

Configure the database settings in your local `.env` file:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sr_automata
DB_USERNAME=postgres
DB_PASSWORD=secretpassword
```
*(Ensure DB_USERNAME and DB_PASSWORD match the credentials of your PostgreSQL database).*

---

### 4. Run Migrations & Build Assets

```bash
# Run database migrations
php artisan migrate

# Build frontend assets
npm run build
```