# Connecting Google Forms to HTCGSC-GORMS with Google Apps Script

This guide explains how to set up a Google Apps Script to automatically forward submissions from a Google Form to the HTCGSC-GORMS API.

---

## 1. Overview

When a user submits the Google Form, a trigger in Google Apps Script fires. This script captures all form responses, packages them into a JSON object, and sends a `POST` request to our application's endpoint (`/api/google-forms`).

---

## 2. Access the Script Editor

**NOTE:** For record-keeping, here are the specific IDs / URLs associated with the current Google Form named<br>"**HTC Guidance Referral / Appointment Form**":

| Component             | URL                                                                                                                       |
| --------------------- | ------------------------------------------------------------------------------------------------------------------------- |
| **Public View URL**   | [View Form](https://docs.google.com/forms/d/e/1FAIpQLSccJBgcUsqMAmi-zGTtsNbcjfImUQoJnxnxegZdGB9fkKKIUw/viewform)          |
| **Editor Form ID**    | [Edit Form](https://docs.google.com/forms/d/1j7fXEsIwyTfpF9GpBO1ePQfYVdS1jfkNSgMhh9vPRII/edit)                            |
| **Script Project ID** | [Edit Script](https://script.google.com/u/0/home/projects/1iIG_eW8z55L-3w7jSFehWAXbZCUHrDMdG0fBhCFosc3zrEuOzeQ57f_D/edit) |

> [!IMPORTANT]
> Ensure these IDs are also updated in your `.env` file for the application to properly reference the form:
>
> ```env
> GOOGLE_FORM_ID="1FAIpQLSccJBgcUsqMAmi-zGTtsNbcjfImUQoJnxnxegZdGB9fkKKIUw"
> GOOGLE_FORM_ID_EDIT="1j7fXEsIwyTfpF9GpBO1ePQfYVdS1jfkNSgMhh9vPRII"
> ```

1. Open your **Google Form** (the one you want to collect data from).
2. Click the **More** icon (three vertical dots) in the top right corner.
3. Select **Script editor**.
4. This will open the Google Apps Script environment.

---

## 3. Add the Integration Script

Copy and paste the following code into the script editor (usually named `Code.gs` or `htcgsc-gorms.gs`). This code matches the actual implementation in our project.

```javascript
function onFormSubmit(e) {
    // 1. Set the Target URL (Choose between Ngrok for local or Render for production)
    // const url = "https://your-ngrok-id.ngrok-free.dev/api/google-forms"; // Local Testing
    const url = 'https://htcgsc-gorms.onrender.com/api/google-forms'; // Production

    const itemResponses = e.response.getItemResponses();
    const formData = {};

    // 2. Map the Form Questions to their Answers
    for (let i = 0; i < itemResponses.length; i++) {
        const itemResponse = itemResponses[i];
        formData[itemResponse.getItem().getTitle()] = itemResponse.getResponse();
    }

    // 3. Configure the HTTP POST Request
    const options = {
        method: 'post',
        contentType: 'application/json',
        payload: JSON.stringify(formData),
        muteHttpExceptions: true,
    };

    // 4. Send the Data to HTCGSC-GORMS
    UrlFetchApp.fetch(url, options);
}
```

> [!TIP]
> Make sure the question titles in your Google Form match exactly with what your backend expects if you are doing specific mapping, though our current implementation handles dynamic titles.

---

## 4. Set Up the "On Form Submit" Trigger

The script won't run automatically until you tell Google to fire it when a submission occurs.

1. In the Script Editor, click the **Triggers** icon (the clock ⏰ on the left sidebar).
2. Click the **+ Add Trigger** button in the bottom right.
3. Configure as follows:
   - **Choose which function to run:** `onFormSubmit`
   - **Choose which deployment should run:** `Head`
   - **Select event source:** `From form`
   - **Select event type:** `On form submit`
4. Click **Save**.

---

## 5. Authorization

When you save the trigger, Google will ask for permissions.

1. Click **Review Permissions**.
2. Choose your Google Account.
3. You might see a "Google hasn't verified this app" screen. Click **Advanced** and then **Go to [Project Name] (unsafe)**.
4. Click **Allow**.

---

## 6. Testing the Integration

1. Open the **Public View URL**.
2. Fill out the form with test data and submit.
3. Check your HTCGSC-GORMS database or dashboard to see if the referral was recorded.
4. If it fails, check the **Executions** tab in the Google Apps Script editor to see any error logs from `UrlFetchApp`.
