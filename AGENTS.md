# Repository Git Workflow & Branching Rules

These rules apply to all tasks and code changes in this repository.

---

## 🌿 1. Pre-Coding: Branch Creation & Sync

Before writing, generating, or modifying any code in this repository:

1. **Check Repository & Sync**:
   - Ensure the repository is clean and synced on the main branch (`development`):
     ```bash
     git status
     git town sync
     ```
2. **Create a Dedicated Branch**:
   - Always create a new branch using `git town hack` before making any code changes:
     ```bash
     git town hack <branch-name>
     ```
   - *Fallback (if Git Town is unavailable)*:
     ```bash
     git checkout -b <branch-name>
     ```
3. **Never Code Directly on Trunk**:
   - Direct commits/modifications to `development` or `main` are strictly prohibited.

---

## 💻 2. Coding & Verification

1. **Implement on Branch**:
   - Perform all modifications exclusively on the task/feature branch.
2. **Verify**:
   - Run tests and builds (`php artisan test`, `npm run build`) before proposing completion.

---

## 🚀 3. Push & Propose: Explicit User Confirmation Required

1. **Ask Before Pushing**:
   - When code is ready, staged, and committed, **do not** push automatically.
   - Summarize the changes and ask the user for confirmation (wait for user's **"go"** / approval).
2. **Execute Propose / Push**:
   - Upon explicit user approval:
     ```bash
     git town propose
     ```
   - *Fallback (if Git Town is unavailable)*:
     ```bash
     git push -u origin <branch-name>
     ```

---

## 🧹 4. Branch Cleanup: Explicit User Confirmation Required

1. **Post-Merge Cleanup**:
   - Once a feature/PR has been merged or finished, propose syncing and cleaning up the branch.
2. **Always Ask First**:
   - **Never delete or prune a branch automatically.** Always ask the user for explicit confirmation before running `git town sync` cleanup or deleting branches.
