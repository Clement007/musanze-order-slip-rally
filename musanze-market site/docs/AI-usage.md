# AI Usage Documentation

> **File:** docs/AI-usage.md  
> **Assignment:** Advanced Web Design & Development #2  
> **Requirement:** Document all AI interactions transparently

---

## Summary

This document records how AI tools were used during development, what was changed from AI suggestions, and what the team learned.

---

## AI Interactions Log

### 1. MVC Folder Structure
**What we asked:** "What is a good PHP MVC folder structure for a small web app without frameworks?"  
**What AI suggested:** Standard MVC layout with controllers, models, views  
**What we changed:** Added `partials/` inside views for reusable header/nav/footer. Added `docs/` and `database/` directories per assignment specs.  
**What we learned:** Separation of concerns matters — keeping DB logic in models and routing in a single index.php makes the codebase far easier to maintain.

---

### 2. MySQLi Prepared Statements
**What we asked:** "How do I use MySQLi prepared statements to prevent SQL injection in PHP?"  
**What AI suggested:** Using `$stmt->bind_param()` with type strings  
**What we changed:** We wrote every query ourselves from scratch, only using the AI explanation to understand the concept. We also added a singleton pattern for DB connection to avoid multiple connections.  
**What we learned:** The type string in `bind_param` (`'sis'` etc.) must exactly match the number and types of bound variables. We caught a bug where we had 10 `?` placeholders but only bound 9 variables.

---

### 3. Live Total Calculator (JavaScript)
**What we asked:** "How do I update a price total in real-time as the user types quantity and unit price?"  
**What AI suggested:** Using `addEventListener('input', ...)` on number inputs  
**What we changed:** Added formatting using `toLocaleString()` for Rwandan Franc presentation, added a breakdown string showing the calculation, and added a visual opacity change when values are 0.  
**What we learned:** `parseFloat()` returns `NaN` for empty strings, so we needed `|| 0` fallback to avoid displaying "RWF NaN".

---

### 4. CSS Responsive Design
**What we asked:** "What are good CSS breakpoints for a dashboard web app?"  
**What AI suggested:** 768px and 480px as breakpoints  
**What we changed:** Added CSS custom properties (variables) for the entire design system including spacing scale, color palette, and typography scale — the AI only suggested the breakpoints. We also implemented the specific Rwanda-themed color scheme ourselves.  
**What we learned:** Using CSS custom properties (`--sp-md`, `--clr-primary`, etc.) makes it much easier to maintain design consistency across components.

---

### 5. Password Hashing
**What we asked:** "How should I store passwords securely in PHP?"  
**What AI suggested:** `password_hash()` with `PASSWORD_BCRYPT` and cost factor  
**What we changed:** We set cost to 12 (AI suggested 10) for better security on modern servers, and added `password_verify()` for login.  
**What we learned:** Never store plain-text or MD5-hashed passwords. BCrypt is designed to be slow, which makes brute-force attacks computationally expensive.

---

## What We Did NOT Use AI For
- Writing the actual problem statement and user stories (done by Role 1 through team discussion)  
- Creating wireframes (Role 2 used Figma/paper)  
- Writing HTML semantic structure (Role 3 wrote all markup)  
- Designing the color scheme and visual identity  
- Writing test cases (Role 7 designed these based on actual usage)  
- Git commit messages (written by team members at each step)

---

## Reflection

AI was used as a reference/documentation tool, similar to reading MDN docs. Every suggestion was understood, discussed, and then implemented (or adapted) by team members. No AI-generated code was copy-pasted without being read, understood, and often rewritten.
