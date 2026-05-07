import { expect, test } from '@playwright/test';

test.describe('User CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/');
        await page.getByPlaceholder('Enter your email address or phone number.').fill('bencariaga13@gmail.com');
        await page.getByPlaceholder('Enter your password.').fill('12345678');
        await page.click('button:has-text("Sign In")');
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
