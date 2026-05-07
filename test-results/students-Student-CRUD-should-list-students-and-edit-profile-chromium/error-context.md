# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: students.spec.js >> Student CRUD >> should list students and edit profile
- Location: tests\Browser\students.spec.js:11:5

# Error details

```
Error: expect(locator).toContainText(expected) failed

Locator: locator('h1')
Expected substring: "Students"
Received string:    "Guidance Office Records Management System"
Timeout: 5000ms

Call log:
  - Expect "toContainText" with timeout 5000ms
  - waiting for locator('h1')
    9 × locator resolved to <h1 class="text-[22px] font-bold gradient-text">Guidance Office Records Management System</h1>
      - unexpected value "Guidance Office Records Management System"

```

# Page snapshot

```yaml
- generic [active] [ref=e1]:
  - generic [ref=e4]:
    - generic [ref=e6]:
      - img "HTCGSC-GORMS Logo" [ref=e7]
      - heading "Guidance Office Records Management System" [level=1] [ref=e8]
    - generic [ref=e9]:
      - generic [ref=e10]:
        - generic [ref=e12]:
          - generic [ref=e13]: Email Address or Phone Number *
          - textbox "Enter your email address or phone number." [ref=e16]
        - generic [ref=e18]:
          - generic [ref=e19]: Password *
          - generic [ref=e20]:
            - textbox "Enter your password." [ref=e22]
            - button [ref=e23] [cursor=pointer]
      - link "Forgot password?" [ref=e26] [cursor=pointer]:
        - /url: http://localhost:8000/forgot-password
      - button "Sign In" [ref=e27] [cursor=pointer]:
        - generic [ref=e28]: Sign In
      - paragraph [ref=e31]:
        - text: Don't have an account?
        - link "Request the admin to create yours." [ref=e32] [cursor=pointer]:
          - /url: http://localhost:8000/create-account
  - generic [ref=e35]:
    - generic [ref=e37]:
      - generic [ref=e38] [cursor=pointer]:
        - generic: Request
      - generic [ref=e39] [cursor=pointer]:
        - generic: Timeline
      - generic [ref=e40] [cursor=pointer]:
        - generic: Views
        - generic [ref=e41]: "16"
      - generic [ref=e42] [cursor=pointer]:
        - generic: Route
      - generic [ref=e43] [cursor=pointer]:
        - generic: Queries
        - generic [ref=e44]: "0"
      - generic [ref=e45] [cursor=pointer]:
        - generic: Livewire
        - generic [ref=e46]: "1"
      - generic [ref=e47] [cursor=pointer]:
        - generic: Auth
      - generic [ref=e48] [cursor=pointer]:
        - generic: Session
    - generic [ref=e49]:
      - generic [ref=e56] [cursor=pointer]:
        - generic [ref=e57]: "2"
        - generic [ref=e58]: GET /
      - generic [ref=e59] [cursor=pointer]:
        - generic: 119ms
      - generic [ref=e61] [cursor=pointer]:
        - generic: 4MB
```

# Test source

```ts
  1  | import { expect, test } from '@playwright/test';
  2  | 
  3  | test.describe('Student CRUD', () => {
  4  |     test.beforeEach(async ({ page }) => {
  5  |         await page.goto('/');
  6  |         await page.getByPlaceholder('Enter your email address or phone number.').fill('bencariaga13@gmail.com');
  7  |         await page.getByPlaceholder('Enter your password.').fill('12345678');
  8  |         await page.click('button:has-text("Sign In")');
  9  |     });
  10 | 
  11 |     test('should list students and edit profile', async ({ page }) => {
  12 |         await page.goto('/students');
> 13 |         await expect(page.locator('h1')).toContainText('Students');
     |                                          ^ Error: expect(locator).toContainText(expected) failed
  14 |         await page.click('button:has-text("Edit")');
  15 |         await page.waitForURL(/user-profile/);
  16 |         await page.getByPlaceholder('First Name').fill('PlaywrightUpdated');
  17 |         await page.click('button:has-text("Save Changes")');
  18 |         await expect(page.locator('body')).toContainText('updated successfully');
  19 |     });
  20 | });
  21 | 
```