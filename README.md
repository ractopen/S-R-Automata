# S-R Automata Project

---

## 🌿 Git Town Team Workflow (Windows Guide)

This guide provides the standard team development workflow for developers on **Windows** (using PowerShell, Windows Terminal, Command Prompt, or Git Bash).

> [!IMPORTANT]
> **Always use full `git town <command>` syntax!**
> Do not use shortcuts like `git sync` or `git hack`. On Windows, Git Town aliases may not be configured in your shell, causing errors like `git: 'sync' is not a git command`. Always type out the full command: `git town sync`, `git town hack`, `git town propose`, and `git town delete`.

---

### The Complete Team Lifecycle

Follow this cycle for **every feature or bug fix**:

```
[development] git town sync
      │
      ▼
[development] git town hack feature/xyz  ──► Creates & switches to task branch
      │
      ▼
  Code & Test with local servers (php artisan serve & npm run dev)
      │
      ▼
  git add .  &&  git commit -m "feat: ..."
      │
      ▼
  git town propose  ──► Pushes branch & opens GitHub PR in your browser
      │
      ▼
  github.com  ──► Review, merge PR into development & click "Delete branch"
      │
      ▼
  git checkout development  ──► Switch back to development
      │
      ▼
  git town sync  ──► Pulls merged code & cleans up remote tracking
      │
      ▼
  git town delete feature/xyz  ──► Deletes local branch
      │
      ▼
  Clean slate: Only 'development' and 'main' remain! Repeat for next task.
```

---

### Step 1: Before Starting to Code (Prepare Your Branch & Environment)

1. **Switch to `development`**:
   Make sure you are on the primary development branch:
   ```powershell
   git checkout development
   ```

2. **Synchronize with the Team (`git town sync`)**:
   Always fetch and pull the latest changes from GitHub before creating a branch:
   ```powershell
   git town sync
   ```

3. **Ensure PostgreSQL Database Service is Running on Windows**:
   - Press <kbd>Win</kbd> + <kbd>R</kbd>, type `services.msc`, and press <kbd>Enter</kbd>.
   - Find `postgresql-x64-<version>` (e.g. `postgresql-x64-16`).
   - If Status is not **Running**, right-click it and click **Start**.
   - *(Alternative via Administrator PowerShell)*:
     ```powershell
     net start postgresql-x64-16
     ```

4. **Create a Dedicated Task Branch (`git town hack`)**:
   **Never code directly on `development` or `main`.** Create your branch:
   ```powershell
   git town hack feature/your-feature-name
   ```
   *(For bug fixes, use `bugfix/issue-description`)*. Git Town automatically creates and checks out the branch based off latest `development`.

5. **Start Local Development Servers**:
   You can run all services in a single terminal:
   ```powershell
   composer run dev
   ```
   *Or open two separate terminal tabs/windows:*
   - **Tab 1 (Laravel Backend)**:
     ```powershell
     php artisan serve
     ```
   - **Tab 2 (Vite Frontend Hot-Reload)**:
     ```powershell
     npm run dev
     ```
   - Open `http://127.0.0.1:8000` in your web browser.

---

### Step 2: Coding & Local Testing

6. **Write Your Code**:
   - Make your changes in your code editor (e.g. VS Code: `code .`).
   - Vite (`npm run dev`) automatically updates your styles and scripts in real-time.

7. **Verify Tests**:
   - Run the automated test suite to ensure no regressions:
     ```powershell
     php artisan test
     ```

---

### Step 3: Staging, Committing & Proposing

8. **Check Modified Files**:
   ```powershell
   git status
   ```

9. **Stage and Commit**:
   - Stage all changes:
     ```powershell
     git add .
     ```
   - Commit following [Conventional Commits](#commit-message-conventions):
     ```powershell
     git commit -m "feat(auth): describe your changes clearly"
     ```

10. **Propose Changes (`git town propose`)**:
    ```powershell
    git town propose
    ```
    *What this command does:*
    - Synchronizes your branch with any recent changes.
    - Pushes your feature branch to GitHub (`origin`).
    - Opens your default web browser directly to the GitHub Pull Request page.

---

### Step 4: GitHub.com (Review, Merge & Remote Cleanup)

11. **Create the Pull Request**:
    - Ensure base branch is set to `development` and compare branch is your feature branch.
    - Review the diff, add a title and description, and click **Create pull request**.

12. **Merge the PR**:
    - Once reviewed and CI tests pass, click **Merge pull request** (or **Squash and merge**) and confirm.

13. **Delete the Remote Branch on GitHub**:
    - Immediately after merging, click the **Delete branch** button on GitHub.
    - This keeps the remote repository clean with only `development` and `main`.

---

### Step 5: Local Cleanup & Next Task

14. **Switch Back to `development`**:
    ```powershell
    git checkout development
    ```

15. **Sync Your Local `development` Branch (`git town sync`)**:
    Pull the code you just merged on GitHub down to your local machine:
    ```powershell
    git town sync
    ```

16. **Delete the Local Task Branch**:
    Delete your local feature branch:
    ```powershell
    git town delete feature/your-feature-name
    ```
    *(If Git Town already removed it during sync or if using git directly: `git branch -d feature/your-feature-name`)*.

17. **Confirm Clean State**:
    Check your local branches:
    ```powershell
    git branch
    ```
    You should only see:
    ```
    * development
      main
    ```

18. **Ready for Next Task**:
    You are now clean and up-to-date. Repeat from **Step 1, Substep 2** (`git town sync` ➔ `git town hack <next-branch>`) for your next task!

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

### 5. Generate Key, Run Migrations & Seed Database

```powershell
# 1. Generate Application Key
php artisan key:generate

# 2. Run database migrations to create tables
php artisan migrate

# 3. Seed initial Administrator account (optional)
php artisan db:seed
```

---

### 6. Start Developing

```powershell
composer run dev
```
*(Or run `php artisan serve` and `npm run dev` in separate terminals).*

Open `http://127.0.0.1:8000` in your browser. You are ready to start coding!
