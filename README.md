# S-R Automata Project

## Development Workflow (Windows Guide)

This document provides a step-by-step development guide tailored for team members developing on **Windows** (using PowerShell, Windows Terminal, Command Prompt, or Git Bash).

> [!IMPORTANT]
> **Always use full `git town <command>` syntax!**
> Do not use shortcuts like `git sync` or `git hack`. On Windows, Git Town aliases may not be configured in your environment, and running `git sync` will result in an error (`git: 'sync' is not a git command'`). Always type `git town sync`, `git town hack`, `git town propose`, and `git town delete`.

---

## The Complete Team Development Cycle

Follow this lifecycle for **every single feature or bug fix**.

```
[development] git town sync
      │
      ▼
[development] git town hack feature/xyz  ──► Creates & switches to task branch
      │
      ▼
  Code & Test on Windows (php artisan serve & npm run dev)
      │
      ▼
  git add .  &&  git commit -m "feat: ..."
      │
      ▼
  git town propose  ──► Pushes branch & opens GitHub PR in browser
      │
      ▼
  github.com  ──► Merge PR into development & click "Delete branch"
      │
      ▼
  git checkout development  ──► Switch back to development
      │
      ▼
  git town sync  ──► Pulls merged code & prunes remote tracking
      │
      ▼
  git town delete feature/xyz  ──► Deletes local branch
      │
      ▼
  Clean slate: Only 'development' and 'main' remain! Repeat for next task.
```

---

### Step 1: Before Starting to Code (Prepare Your Environment)

1. **Switch to `development`**:
   Ensure you are on the primary branch before starting:
   ```powershell
   git checkout development
   ```

2. **Synchronize with the Remote Repository (`git town sync`)**:
   Always fetch and pull the latest changes made by your teammates:
   ```powershell
   git town sync
   ```

3. **Ensure the PostgreSQL Database Service is Running on Windows**:
   - Press <kbd>Win</kbd> + <kbd>R</kbd>, type `services.msc`, and press <kbd>Enter</kbd>.
   - Scroll down to find `postgresql-x64-<version>` (e.g. `postgresql-x64-16`).
   - If Status is not **Running**, right-click it and select **Start**.
   - *(Alternative via Administrator PowerShell / Command Prompt)*:
     ```powershell
     net start postgresql-x64-16
     ```

4. **Create a Dedicated Task Branch (`git town hack`)**:
   **Never code directly on `development` or `main`.** Create a new branch:
   ```powershell
   git town hack feature/your-feature-name
   ```
   *(For bug fixes, use `bugfix/issue-description`)*. Git Town will automatically branch off the freshly synced `development` branch.

5. **Start Development Servers**:
   Open two separate Windows Terminal tabs or PowerShell windows in the project root:
   - **Tab 1 - Laravel Backend**:
     ```powershell
     php artisan serve
     ```
   - **Tab 2 - Vite Frontend Assets**:
     ```powershell
     npm run dev
     ```
   - Open your browser to `http://127.0.0.1:8000` to view the app, and open the project folder in VS Code (`code .`).

---

### Step 2: Coding & Local Verification

6. **Write Your Code**:
   - Make your changes and implement your feature.

7. **Verify Changes Before Committing**:
   - Make sure frontend assets compile without errors:
     ```powershell
     npm run build
     ```
   - Run the test suite:
     ```powershell
     php artisan test
     ```

---

### Step 3: Staging, Committing & Proposing

8. **Review Changed Files**:
   ```powershell
   git status
   ```

9. **Stage and Commit**:
   - Stage all modified files:
     ```powershell
     git add .
     ```
   - Commit following the [Conventional Commits](#commit-message-conventions) standard:
     ```powershell
     git commit -m "feat(auth): describe your changes clearly"
     ```

10. **Propose Changes via Git Town (`git town propose`)**:
    ```powershell
    git town propose
    ```
    *What this command does:*
    - Automatically syncs your branch with parent updates.
    - Pushes your feature branch to GitHub (`origin`).
    - Opens your default web browser directly to the GitHub Pull Request creation page!

---

### Step 4: GitHub.com (Merge & Remote Deletion)

11. **Review and Create PR**:
    - Verify that the base branch is `development` and the compare branch is your feature branch.
    - Add a title and description, then click **Create pull request**.

12. **Merge the PR**:
    - Once reviewed and checks pass, click **Merge pull request** (or **Squash and merge**) and confirm.

13. **Delete Remote Branch on GitHub**:
    - Immediately after merging, click the **Delete branch** button on the GitHub PR page.
    - This ensures remote branches are pruned and do not clutter the repository.

---

### Step 5: Local Cleanup & Preparing for the Next Step

14. **Switch Back to `development`**:
    ```powershell
    git checkout development
    ```

15. **Sync Your Local `development` Branch**:
    Pull the code you just merged on GitHub down to your local machine:
    ```powershell
    git town sync
    ```

16. **Delete the Local Branch**:
    Delete your feature branch locally so it does not linger:
    ```powershell
    git town delete feature/your-feature-name
    ```
    *(If Git Town already removed it during sync or if using git directly: `git branch -d feature/your-feature-name`)*.

17. **Confirm Only Two Branches Remain**:
    Check your local branches:
    ```powershell
    git branch
    ```
    You should only see:
    ```
    * development
      main
    ```

18. **Ready for the Next Step / Task**:
    You are now clean and up-to-date. Repeat from **Step 1, Substep 2** (`git town sync` ➔ `git town hack <next-branch>`) for your next task!

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
*   Composer (PHP package manager)
*   Node.js & npm (Frontend assets manager)
*   Git Town (Installed on your system)
*   PostgreSQL (either run via Docker or installed natively)

### 1. First-Time Git Town Setup (Windows)
If you do not have Git Town installed on Windows, install it using **winget** or **scoop** in PowerShell:
```powershell
winget install GitTown.GitTown
# or
scoop install git-town
```
Once installed, restart your terminal and run this inside the project folder to configure it:
```powershell
git town init
```
*(When prompted, select `development` as the main branch, and leave the perennial / parent branches default).*

---

### 2. Database Setup

Set up a PostgreSQL database using one of the following methods:

#### Option A: Native Installation on Windows (Recommended for Windows)
1. Download and run the Windows installer from [PostgreSQL Official Website](https://www.postgresql.org/download/windows/).
2. During setup, remember your password (e.g. `secretpassword`).
3. Open **pgAdmin** or SQL Shell (`psql`) and run:
   ```sql
   CREATE DATABASE sr_automata;
   ```
4. Verify the PostgreSQL Windows Service is running in `services.msc`.

#### Option B: Using Docker
Start a PostgreSQL container with:
```powershell
docker run --name postgres-db -e POSTGRES_PASSWORD=secretpassword -e POSTGRES_DB=sr_automata -p 5432:5432 -d postgres:latest
```

---

### 3. Installation Steps (Windows Terminal / PowerShell)

Follow these steps in order to set up your local development environment:

```powershell
# 1. Clone the repository
git clone https://github.com/Ractopen-Academic/S-R-Automata.git
cd S-R-Automata

# 2. Install package dependencies
composer install
npm install

# 3. Create the configuration env file (PowerShell / Git Bash)
cp .env.example .env
# Or in Windows Command Prompt (CMD):
# copy .env.example .env
```

---

### 4. Database Connection Configuration

Open the newly created `.env` file in your text editor and configure the database settings:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sr_automata
DB_USERNAME=postgres
DB_PASSWORD=secretpassword
```
*(Ensure DB_USERNAME and DB_PASSWORD match the credentials of your PostgreSQL database setup).*

---

### 5. Generate Key, Run Migrations, & Build Assets

Now that your database is connected, generate the application key, run migrations, and compile the assets:

```bash
# 1. Generate Application Key
php artisan key:generate

# 2. Run database migrations to create tables
php artisan migrate

# 3. Compile frontend assets
npm run build
```
You are now ready to start coding!
