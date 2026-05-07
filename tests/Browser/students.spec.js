import { expect, test } from '@playwright/test';

test.describe('Student CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/');
        await page.getByPlaceholder('Enter your email address or phone number.').fill('bencariaga13@gmail.com');
        await page.getByPlaceholder('Enter your password.').fill('12345678');
        await page.click('button:has-text("Sign In")');
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
