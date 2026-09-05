# S-R Automata Project

---

## 🌿 Git Town Team Workflow (Windows Guide)

This guide provides the standard team development workflow for developers on **Windows** (using PowerShell, Windows Terminal, Command Prompt, or Git Bash).

> [!IMPORTANT]
> **Always use full `git town <command>` syntax!**
> Do not use shortcuts like `git sync` or `git hack`. On Windows, Git Town aliases may not be configured in your shell, causing errors like `git: 'sync' is not a git command`. Always type out the full command: `git town sync`, `git town hack`, `git town propose`, and `git town delete`.

### Step-by-Step Development Workflow

Follow this single numbered sequence in order for **every single feature or bug fix**:

#### 1. Ensure you are on `development`
Make sure your terminal is on the primary development branch:
```powershell
git checkout development
```

#### 2. Pull latest team changes (`git town sync`)
Always pull the latest changes from GitHub before creating a branch:
```powershell
git town sync
```

#### 3. Ensure PostgreSQL is running
*(Note: If installed natively on Windows, PostgreSQL runs automatically in the background on system startup, so you usually don't need to do anything!)*
If you ever need to start it manually:
- **Windows Service (Default)**: Press <kbd>Win</kbd> + <kbd>R</kbd>, type `services.msc`, find `postgresql-x64-<version>`, and click **Start** (or run `net start postgresql-x64-16` in an Administrator PowerShell).
- **Laragon (XAMPP Alternative with GUI)**: If you use Laragon, simply click **Start All** with PostgreSQL enabled.
- **Docker Desktop GUI**: If running in Docker, simply click the **Play/Start** button on your container.

#### 4. Create your task branch (`git town hack`)
**Never code directly on `development` or `main`.** Create a dedicated branch:
```powershell
git town hack feature/your-feature-name
```
*(For bug fixes, use `bugfix/issue-description`). Git Town automatically creates and switches to your new branch based off `development`.*

#### 5. Start the Laravel development server
```powershell
php artisan serve
```
Open `http://127.0.0.1:8000` in your web browser. *(No `npx` or build commands needed — we write standard, normal CSS!)*

#### 6. Write your code and normal CSS
- Edit files in your editor (e.g. VS Code: `code .`).
- Write normal CSS directly in `<style>` blocks or stylesheets.
- Refresh `http://127.0.0.1:8000` in your browser to view your changes immediately.

#### 7. Stage and commit your changes
Check what changed, stage all modified files, and commit following [Conventional Commits](#commit-message-conventions):
```powershell
git status
git add .
git commit -m "feat(scope): describe your changes clearly"
```

#### 8. Propose your changes to GitHub (`git town propose`)
```powershell
git town propose
```
*What this does:* Git Town automatically synchronizes your branch, pushes it to GitHub (`origin`), and opens your web browser directly to create the Pull Request!

#### 9. On GitHub.com: Review, Merge & Delete the Remote Branch
- Verify the base branch is `development` and click **Create pull request**.
- Once reviewed, click **Merge pull request** (or **Squash and merge**) and confirm.
- **Immediately click the "Delete branch" button** on GitHub so the remote repo stays clean.

#### 10. Clean up locally & prepare for the next task
Back in your Windows terminal:
```powershell
# 1. Switch back to development
git checkout development

# 2. Pull the freshly merged code from GitHub
git town sync

# 3. Delete the local task branch
git town delete feature/your-feature-name
```

#### 11. Verify clean slate
Check your local branches:
```powershell
git branch
```
You should only see:
```
* development
  main
```
You are completely clean and ready! Repeat from **Step 2** (`git town sync` ➔ `git town hack <next-branch>`) for your next task.

---

## Commit Message Conventions

This project follows the Conventional Commits standard:
* `feat`: A new feature (e.g., `feat(auth): add login with OTP`).
* `fix`: A bug fix (e.g., `fix(database): resolve connection timeout error`).
* `docs`: Documentation changes (e.g., `docs(readme): update workflow guide`).
* `style`: Formatting, missing semicolons (e.g., `style: format blade templates`).
* `refactor`: Code change that neither fixes a bug nor adds a feature (e.g., `refactor(auth): simplify role checks`).
* `test`: Adding or correcting tests (e.g., `test(auth): add OTP verification tests`).
* `chore`: Maintenance, updating dependencies (e.g., `chore: update packages`).

---

## Project Setup Guide (Windows)

### Prerequisites
* **PHP 8.3+**
* **Composer** (PHP dependency manager)
* **Node.js & npm** (Frontend runtime)
* **PostgreSQL** (Native Windows service or Docker)
* **Git Town** (Workflow CLI tool)

---

### 1. First-Time Git Town Setup on Windows

Install Git Town using **winget** or **scoop** in PowerShell:
```powershell
winget install GitTown.GitTown
# or
scoop install git-town
```

Restart your terminal, then initialize Git Town in the repository root:
```powershell
git town init
```
*(When prompted, select `development` as the main branch, and leave the perennial / parent branches default).*

---

### 2. Database Setup

Set up a PostgreSQL database using one of the following methods:

#### Option A: Native Installation on Windows (Recommended)
1. Download and run the Windows installer from [PostgreSQL Official Website](https://www.postgresql.org/download/windows/).
2. During setup, set your password (e.g., `secretpassword`).
3. Open **pgAdmin** or SQL Shell (`psql`) and run:
   ```sql
   CREATE DATABASE sr_automata;
   ```
4. Verify the PostgreSQL service is running in `services.msc`.

#### Option B: Using Docker
```powershell
docker run --name postgres-db -e POSTGRES_PASSWORD=secretpassword -e POSTGRES_DB=sr_automata -p 5432:5432 -d postgres:latest
```

---

### 3. Installation Steps (PowerShell / Windows Terminal)

```powershell
# 1. Clone the repository
git clone https://github.com/Ractopen-Academic/S-R-Automata.git
cd S-R-Automata

# 2. Install PHP and Node dependencies
composer install
npm install

# 3. Create the environment file
cp .env.example .env
# (Or in CMD: copy .env.example .env)
```

---

### 4. Database Connection Configuration

Open `.env` in your text editor (e.g. `code .env`) and configure the database credentials:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sr_automata
DB_USERNAME=postgres
DB_PASSWORD=secretpassword
```

---

### 5. Generate Key, Run Migrations & Seed Admin User

```powershell
# 1. Generate Application Key
php artisan key:generate

# 2. Run database migrations AND seed the Admin user in one single command:
php artisan migrate --seed
```
*(When prompted by the seeder in your terminal, type your Admin Name, Email, and Password, or press Enter to accept default test values).*

---

### 6. Start Developing

Start the Laravel server:
```powershell
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser. You are ready to start coding!
