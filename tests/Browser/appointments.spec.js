import { expect, test } from '@playwright/test';

test.describe('Appointment CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/login');
        await page.fill('input[name="email"]', 'admin@example.com');
        await page.fill('input[name="password"]', '12345678');
        await page.click('button[type="submit"]');
    });

    test('should list and complete appointments', async ({ page }) => {
        await page.goto('/appointments');
        await expect(page.locator('h1')).toContainText('Appointments');
        await page.click('button:has-text("Mark as Done")');
        await page.click('button:has-text("Confirm")');
        await expect(page.locator('body')).toContainText('mark as done successfully');
    });

    test('should cancel appointments', async ({ page }) => {
        await page.goto('/appointments');
        await page.click('button:has-text("Cancel")');
        await page.click('button:has-text("Confirm")');
        await expect(page.locator('body')).toContainText('cancel successfully');
    });
});
