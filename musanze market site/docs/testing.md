# Testing Documentation

> **File:** docs/testing.md  
> **Assignment:** Advanced Web Design & Development #2  
> **Role 7 Deliverable**

---

## Test Environment

| Item | Value |
|------|-------|
| PHP Version | 8.1 |
| MySQL Version | 8.0 |
| Browser tested | Chrome 120, Firefox 121, Mobile Safari |
| Testing type | Manual functional testing |

---

## Test Cases

### TC-01: User Login — Valid Credentials
| Field | Value |
|-------|-------|
| **Test ID** | TC-01 |
| **Feature** | Authentication |
| **Input** | Email: admin@musanze.rw, Password: Admin@1234 |
| **Expected** | Redirect to dashboard, session started, user name shown in navbar |
| **Result** | ✅ PASS |
| **Notes** | Flash message did not appear (correct — no message needed on login) |

---

### TC-02: User Login — Wrong Password
| Field | Value |
|-------|-------|
| **Test ID** | TC-02 |
| **Feature** | Authentication |
| **Input** | Email: admin@musanze.rw, Password: wrongpassword |
| **Expected** | Stay on login page, show "Invalid email or password" error |
| **Result** | ✅ PASS |
| **Notes** | Error message is vague intentionally (security best practice — don't reveal which field is wrong) |

---

### TC-03: Create Order — Valid Data
| Field | Value |
|-------|-------|
| **Test ID** | TC-03 |
| **Feature** | Order CRUD |
| **Input** | Supplier: Uwimana, Product: Irish Potato, Qty: 500 kg, Price: 150, Pickup: Musanze Market, Date: tomorrow |
| **Expected** | Order saved, redirect to order list, success flash message, auto-generated ref (ORD-2025-XXX) |
| **Result** | ✅ PASS |
| **Notes** | Total auto-computed as 75,000 RWF (500 × 150) |

---

### TC-04: Create Order — Missing Supplier
| Field | Value |
|-------|-------|
| **Test ID** | TC-04 |
| **Feature** | Server-side Validation |
| **Input** | No supplier selected, all other fields valid |
| **Expected** | Form rejected, "Please select a supplier" error displayed |
| **Result** | ✅ PASS |
| **Notes** | Both client-side JS and server-side PHP caught this |

---

### TC-05: Live Calculator — Real-time Total
| Field | Value |
|-------|-------|
| **Test ID** | TC-05 |
| **Feature** | JavaScript Calculator |
| **Input** | Type qty=200, then unit_price=120 |
| **Expected** | Calculator preview shows "RWF 24,000" updated in real-time without page reload |
| **Result** | ✅ PASS |
| **Notes** | Breakdown shows "200 kg × RWF 120 = RWF 24,000" |

---

### TC-06: Print Receipt
| Field | Value |
|-------|-------|
| **Test ID** | TC-06 |
| **Feature** | Receipt Generation |
| **Input** | Click "🖨 Receipt" on any order |
| **Expected** | Receipt page opens showing order ref, supplier, product, qty, price, total, pickup details. Print button triggers browser print dialog. Navigation hidden in print. |
| **Result** | ✅ PASS |
| **Notes** | @media print CSS hides navigation buttons correctly |

---

### TC-07: Register New Supplier — Invalid Phone
| Field | Value |
|-------|-------|
| **Test ID** | TC-07 |
| **Feature** | Supplier Validation |
| **Input** | Name: "Jean", Phone: "abc123", Location: "Kinigi" |
| **Expected** | "Phone number format is invalid" error shown |
| **Result** | ✅ PASS |
| **Notes** | Regex validates phone format on both JS (client) and PHP (server) |

---

### TC-08: Dashboard Stats Accuracy
| Field | Value |
|-------|-------|
| **Test ID** | TC-08 |
| **Feature** | Dashboard |
| **Input** | 3 orders created today (totals: 75,000 + 36,000 + 145,000 = 256,000 RWF) |
| **Expected** | "Orders Today" shows 3, "Value Today" shows 256,000 |
| **Result** | ✅ PASS |
| **Notes** | MySQL `CURDATE()` used for accurate today filtering |

---

### TC-09: Edit Order — Status Update
| Field | Value |
|-------|-------|
| **Test ID** | TC-09 |
| **Feature** | Order CRUD |
| **Input** | Change order status from "pending" to "confirmed" |
| **Expected** | Status updated in DB, badge color changes from orange to blue |
| **Result** | ✅ PASS |
| **Notes** | Prepared statement used for update — no SQL injection risk |

---

### TC-10: Delete Supplier With Orders
| Field | Value |
|-------|-------|
| **Test ID** | TC-10 |
| **Feature** | Referential Integrity |
| **Input** | Attempt to delete a supplier who has linked orders |
| **Expected** | Error message shown: "Could not delete supplier. They may have existing orders." |
| **Result** | ✅ PASS |
| **Notes** | MySQL FOREIGN KEY constraint prevents deletion, PHP catches the error gracefully |

---

### TC-11: Unauthenticated Route Access
| Field | Value |
|-------|-------|
| **Test ID** | TC-11 |
| **Feature** | Auth Guard |
| **Input** | Visit `index.php?route=dashboard` without logging in |
| **Expected** | Redirect to login page |
| **Result** | ✅ PASS |
| **Notes** | `requireAuth()` helper in router handles all protected routes |

---

### TC-12: Order Table Search Filter
| Field | Value |
|-------|-------|
| **Test ID** | TC-12 |
| **Feature** | JavaScript Filter |
| **Input** | Type "potato" in search box on orders list |
| **Expected** | Only rows containing "potato" (case-insensitive) are shown |
| **Result** | ✅ PASS |
| **Notes** | Combined with status dropdown filter for compound filtering |

---

### TC-13: Responsive Layout — Mobile
| Field | Value |
|-------|-------|
| **Test ID** | TC-13 |
| **Feature** | CSS Responsiveness |
| **Input** | Open app on 375px wide mobile viewport |
| **Expected** | Hamburger nav shows, stats grid becomes single column, form rows stack vertically |
| **Result** | ✅ PASS |
| **Notes** | Tested on iPhone 12 (Safari) and Android Chrome |

---

## Summary

| Total Tests | Passed | Failed | Pending |
|-------------|--------|--------|---------|
| 13 | 13 | 0 | 0 |

All critical paths pass. SQL injection protection verified via prepared statements. XSS protection via `htmlspecialchars()` on all output.
