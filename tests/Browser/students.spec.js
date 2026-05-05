import { expect, test } from '@playwright/test';

test.describe('Student CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/login');
        await page.getByPlaceholder('Email Address').fill('admin@example.com');
        await page.getByPlaceholder('Password').fill('12345678');
        await page.click('button:has-text("Login")');
    });

    test('should list students and edit profile', async ({ page }) => {
        await page.goto('/students');
        await expect(page.locator('h1')).toContainText('Students');
        await page.click('button:has-text("Edit")');
        await page.waitForURL(/user-profile/);
        await page.getByPlaceholder('First Name').fill('PlaywrightUpdated');
        await page.click('button:has-text("Save Changes")');
        await expect(page.locator('body')).toContainText('updated successfully');
    });
});
