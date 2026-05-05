import { expect, test } from '@playwright/test';

test.describe('Appointment CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/');
        await page.getByPlaceholder('Enter your email address or phone number.').fill('bencariaga13@gmail.com');
        await page.getByPlaceholder('Enter your password.').fill('12345678');
        await page.click('button:has-text("Sign In")');
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
