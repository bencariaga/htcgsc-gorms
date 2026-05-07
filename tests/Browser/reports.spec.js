import { expect, test } from '@playwright/test';

test.describe('Report CRUD', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/');
        await page.getByPlaceholder('Enter your email address or phone number.').fill('bencariaga13@gmail.com');
        await page.getByPlaceholder('Enter your password.').fill('12345678');
        await page.click('button:has-text("Sign In")');
    });

    test('should generate a report', async ({ page }) => {
        await page.goto('/reports');
        await page.getByPlaceholder('Report Title').fill('Playwright Test Report');
        await page.click('button:has-text("Select Category")');
        await page.click('button:has-text("Users")');
        await page.click('span:has-text("PDF Document")');
        await page.click('button:has-text("Generate")');
        await expect(page.locator('body')).toContainText('generated successfully');
    });

    test('should delete a report', async ({ page }) => {
        await page.goto('/reports');
        const deleteButton = page.locator('div[title="Delete report"]').first();
        await deleteButton.click();
        page.on('dialog', (dialog) => dialog.accept());
        await expect(page.locator('body')).toContainText('deleted successfully');
    });
});
