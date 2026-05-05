import { expect, test } from '@playwright/test';

test.describe('User CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/login');
        await page.getByPlaceholder('Email Address').fill('admin@example.com');
        await page.getByPlaceholder('Password').fill('12345678');
        await page.click('button:has-text("Login")');
    });

    test('should list, deactivate and delete users', async ({ page }) => {
        await page.goto('/users');
        await expect(page.locator('h1')).toContainText('Users');
        await page.click('button:has-text("Deactivate")');
        await page.click('button:has-text("Confirm")');
        await expect(page.locator('body')).toContainText('deactivated successfully');
        await page.click('button:has-text("Delete")');
        await page.click('button:has-text("Confirm")');
        await expect(page.locator('body')).toContainText('deleted successfully');
    });
});
