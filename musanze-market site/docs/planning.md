# Planning Document — Musanze Market Order Slip

> **Role 1: Product Planner & Documentation Lead**  
> Phase 1 Deliverable

---

## 1. Problem Statement

Potato aggregators and cooperative collection points operating in and around Musanze, Rwanda, face significant financial and operational losses due to disorganized order management. Currently, orders are recorded on paper or communicated via WhatsApp messages, leading to frequent calculation errors, missing receipts, and unresolved disputes at pickup time.

Key pain points:
- Manual multiplication of quantity × unit price frequently results in wrong totals
- No standard receipt format exists, making verification impossible
- Paper records are lost, damaged, or inaccessible when needed
- Multiple WhatsApp threads make it impossible to track all pending pickups
- No audit trail for who placed which order and when

**The Musanze Market Order Slip system** will digitize the entire process: from supplier registration through to order creation, total auto-computation, receipt generation, and a management dashboard — eliminating the root causes of these losses.

---

## 2. Stakeholders

| Stakeholder | Role | Interest |
|-------------|------|----------|
| **Aggregator/Admin** | Primary user | Creates and manages orders, views dashboard, generates receipts |
| **Supplier/Farmer** | Indirect user | Receives receipt, benefits from clear pickup terms |
| **Cooperative Manager** | Supervisor | Needs overview of total orders and values |
| **Truck/Driver** | Indirect user | Needs clear pickup location and date |
| **INES-Ruhengeri** | Academic | Assignment evaluation and digital skills demonstration |

---

## 3. User Stories

### US-01 — Login
**As an** aggregator,  
**I want to** log in with my email and password,  
**So that** only authorized people can access order data.

**Acceptance Criteria:**
- Valid credentials redirect to dashboard
- Invalid credentials show a generic error message (no field hints for security)
- Session persists until user logs out

---

### US-02 — Create an Order
**As an** aggregator,  
**I want to** create a new order by selecting a supplier, entering qty, unit price, and pickup details,  
**So that** the total is auto-calculated and stored safely.

**Acceptance Criteria:**
- All required fields must be filled (supplier, product, qty, price, location, date)
- Total is computed automatically (qty × price) — no manual entry
- A unique order reference is generated (ORD-YYYY-NNN)
- Data is stored in MySQL using prepared statements

---

### US-03 — View Order Details
**As an** aggregator,  
**I want to** view the complete details of any order,  
**So that** I can verify the information and resolve any disputes.

**Acceptance Criteria:**
- All order fields are displayed: ref, supplier info, product, qty, unit, price, total, pickup location, date, status, notes
- Created-by and timestamp are visible

---

### US-04 — Generate a Receipt
**As an** aggregator,  
**I want to** generate a printable receipt for any order,  
**So that** suppliers have physical proof of the agreed terms.

**Acceptance Criteria:**
- Receipt shows all order details in a clear, professional format
- Receipt is printable (print button triggers browser print)
- Navigation/UI buttons are hidden during printing

---

### US-05 — View Dashboard
**As an** aggregator,  
**I want to** see today's orders count, today's total value, pending orders, and recent orders at a glance,  
**So that** I can manage my daily operations efficiently.

**Acceptance Criteria:**
- Dashboard loads stats in real-time from the database
- Recent 10 orders are shown in a table with links to view/receipt
- Stats include: orders today, value today, total orders, total value, pending count, supplier count

---

### US-06 — Register a Supplier
**As an** admin,  
**I want to** register a new supplier with their name, phone, and sector,  
**So that** their information is readily available when creating orders.

**Acceptance Criteria:**
- Phone number is validated (format check)
- Duplicate prevention through form validation
- Supplier appears in the supplier dropdown on the order form immediately after registration

---

## 4. Scope

### In Scope
- User login/logout (session-based)
- Supplier CRUD (create, read, update, delete)
- Order CRUD with auto-total computation
- Printable receipt page
- Dashboard with live stats
- Server-side validation (all forms)
- Client-side validation (JavaScript)
- MySQL storage using prepared statements
- Responsive design (mobile + desktop)
- Status management (pending → confirmed → collected → cancelled)

### Out of Scope
- User registration (admin creates users manually via seed.sql)
- Multi-tenant support (one business only)
- Payment processing or mobile money integration
- SMS/WhatsApp notification integration
- PDF export (only browser print)
- Role-based access control beyond admin/aggregator distinction

---

## 5. Non-Functional Requirements

| NFR | Requirement |
|-----|-------------|
| **Security** | All DB queries use MySQLi prepared statements; all output is HTML-escaped; passwords are BCrypt-hashed |
| **Performance** | Pages load in under 2 seconds on a shared hosting server |
| **Usability** | A farmer's assistant with basic smartphone literacy can create an order in under 2 minutes |
| **Responsiveness** | Full functionality on screens from 375px (mobile) to 1920px (desktop) |
| **Reliability** | No data loss — DB transactions used for critical writes where applicable |
| **Maintainability** | MVC structure strictly enforced — no HTML in controllers, no SQL in views |
| **Accessibility** | All form fields have proper labels; focus states are visible; color contrast meets WCAG AA |

---

## 6. Page Map / Navigation Flow

```
[Login Page]
     │
     ▼ (authenticated)
[Dashboard]
  ├──► [Orders List] ──► [Create Order]
  │          │               │
  │          ▼               ▼
  │     [View Order] ◄── [Order Saved]
  │          │
  │          ├──► [Edit Order]
  │          └──► [Print Receipt]
  │
  └──► [Suppliers List] ──► [Register Supplier]
               │
               └──► [Edit Supplier]

[Logout] → [Login Page]
```
