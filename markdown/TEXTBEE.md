# TextBee Guide

Home Page: [https://textbee.dev/](https://textbee.dev/)

Dashboard Page: [https://app.textbee.dev/dashboard](https://app.textbee.dev/dashboard)

GitHub Repository: [https://github.com/vernu/textbee/](https://github.com/vernu/textbee/)

This guide explains how to set up and use TextBee for sending SMS messages with Laravel. TextBee is a game-changing SMS gateway for those of us who want to build cool things with it without paying too much because of its generosity to the open-source community.

---

## Requirements

- Android Device (v6.0 or higher)
- SIM card (recommended: **DITO**, see [https://dito.ph/prepaid/level-up/](https://dito.ph/prepaid/level-up/))
- With active network provider service subscription<br>
  (recommended: "**DITO Level-Up 99**" for **unlimited sending of text messages** for **30 days** for **99 Philippine pesos**)
- Textbee account (go to [https://textbee.dev/](https://textbee.dev/))
- Textbee Android app (go to [https://textbee.dev/download/](https://textbee.dev/download/))

---

## Guide Steps

### **Step 1: Getting Your Hardware Ready**

Before we touch a single line of code, we need to get the "hardware" side of things sorted. You cannot send messages into the empty air; you need a physical gateway to the cellular network.

#### **What You Need**

1. **An Android Phone:** This is the most important part. The phone needs to be running **Android 6.0 (Marshmallow)** or higher. Don’t try this with an iPhone; it simply won’t work. Apple keeps their SMS "gates" locked very tight, and they don't let apps send messages automatically like this.
2. **A Mobile Plan:** You need a SIM card with an active plan. Textbee itself doesn't charge you per message, but your phone carrier might. Make sure you have an "unlimited" or high-volume SMS plan so you don't get a surprise bill from your mobile provider.
3. **A Textbee Account:** Go to the [Textbee website](https://textbee.dev) and sign up. You can use your email or just sign in with Google.

---

### **Step 2: The Important "Battery" Secret**

Android is very aggressive about saving battery life. It is like a strict boss that likes to "kill" or "pause" apps that run in the background to save power. If Android puts the Textbee app to sleep, your messages won't go out, and you will wonder why your system is "broken."

**The Fix:**
You must tell Android to leave Textbee alone.

1. Go to your phone's **Settings**.
2. Find the **Battery** or **Battery Optimization** section.
3. Look for the Textbee app in the list.
4. Change its setting to **"Don't Optimize"** or **"Unrestricted"**.

This ensures the "bridge" stays open and ready, even when your screen is off or you haven't touched the phone for hours. This is the #1 reason people have trouble, so do this first!

---

### **Step 3: Installing the "Bridge" App**

Since this app acts as a gateway, you won't find it on the standard Google Play Store. Google has strict rules about apps that send SMS automatically, so we have to "side-load" it.

1. **Download the APK:** Open your phone's browser and go to the download link provided in your Textbee dashboard (usually `textbee.dev/download`).
2. **Enable Unknown Sources:** Your phone will show a scary warning saying the file might be "harmful" because it didn't come from the official store. Don't worry—this is normal for APK files. You need to go into your settings and allow your browser (like Chrome) to "Install Unknown Apps."
3. **Install the App:** Open the downloaded file and click install.

---

### **Step 4: Granting Permissions (The "Keys to the Kingdom")**

Once you open the app, it will ask for **SMS Permissions** and **Phone Permissions**.

**Why does it need these?**

- **SMS Permission:** Without this, the app cannot physically send the texts you trigger from your computer. It also cannot "see" incoming texts if you want to receive replies.
- **Phone Permission:** This helps the app identify which SIM card to use if you have a phone with two SIM slots.

If you say "No" to these, the app becomes a fancy paperweight. You must allow these for the gateway to function.

---

### **Step 5: Connecting Your Phone to the Web**

Now we need to tell the Textbee website: "Hey, this specific phone belongs to me." We do this using an **API Key**.

#### **Option A: The QR Code Way (The "Easy" Way)**

1. Log into your Textbee dashboard on your computer.
2. Click on **"Get Started"** or **"Generate API Key"**. A square QR code will pop up.
3. Open the Textbee app on your phone and tap the **"Scan QR Code"** button.
4. Point your phone's camera at your computer screen.
5. **Boom.** Your device is now "Active" and linked.

#### **Option B: The Manual Way (The "Old School" Way)**

If your camera is broken, you can do it by hand:

1. Copy the **API Key** from your dashboard.
2. Paste it into the "API Key" box in the Android app.
3. Leave the **"Device ID"** box empty if this is a brand new setup; the system will create one for you automatically.
4. Tap **"Register"**.

---

### **Step 6: Integration into Your Laravel Code**

Now, let's talk about the developer side. We are using Laravel for this project, and we have already set up the "plumbing" for you.

#### **The Configuration (.env)**

We store your "secret keys" in the `.env` file. This keeps them safe and makes it easy to change them without touching the code. In your project, it looks like this:

```env
TEXTBEE_BASE_URL="https://api.textbee.dev/api/v1"
TEXTBEE_DEVICE_ID=""
TEXTBEE_API_KEY=""
```

- **BASE_URL:** This is the address of the Textbee "brain" on the internet.
- **DEVICE_ID:** This is the unique "ID card" for your specific Android phone.
- **API_KEY:** This is your secret password that proves you have permission to send messages.

#### **The Service Class**

We created a special file called `TextBeeService.php` located in `app/Services/Miscellaneous/`. This file does all the heavy lifting. Instead of you writing complex code every time you want to send a text, you just call one simple function.

Here is a simplified look at how it works:

```php
public function sendSms(array $recipients, string $message)
{
    // 1. It builds the URL using your Device ID
    $url = "{$this->baseUrl}/gateway/devices/{$this->deviceId}/send-sms";

    // 2. It sends a request to Textbee with your API Key
    return Http::withHeaders([
        'x-api-key' => $this->apiKey
    ])->post($url, [
        'recipients' => $recipients,
        'message' => $message
    ]);
}
```

#### **How to use it in your code:**

If you want to send an SMS to a user, you just do this:

```php
$textBee = new TextBeeService();
$textBee->sendSms(['09123456789'], 'Hello! Your appointment is confirmed.');
```

**Important Note on Phone Numbers:** You must use the **E.164 format**. This is a fancy way of saying: use the plus sign, the country code, and the number.

- **Good:** `+639123456789` or `09123456789`
- **Bad:** `(+639) 123456789` or `(0912) 456-789`

---

### **Step 7: Handling Incoming Messages (Webhooks)**

What if you want to build a system where people can text you back? For example, "Reply YES to confirm your slot."

To do this, you need **Webhooks**. A webhook is like a "callback" phone number for your server. When your Android phone receives a text, it tells the Textbee server, and then the Textbee server "calls" your Laravel app to give it the message.

1. **In the App:** Make sure the **"Receive SMS"** toggle is turned **ON**.
2. **In the Dashboard:** Go to the Webhooks section and enter your server's URL (e.g., `https://your-site.com/api/webhooks/sms`).
3. **In Laravel:** Create a route that listens for a `POST` request from Textbee. You will get a JSON object containing the sender's number and their message.

---

### **Step 8: Bulk Messaging via CSV**

If you have 500 customers and you want to tell them about a sale, you don't want to write code for that. You can do it directly from the Textbee dashboard.

1. **Prepare a CSV:** Create a simple spreadsheet. One column should be `phone`, another could be `name`.
2. **Upload:** Go to the "Bulk SMS" section and upload your file.
3. **Templates:** You can write a message like: *"Hi {{ name }}, we have a 50% discount today!"* Textbee will automatically replace `{{ name }}` with the correct name for every person on your list. It is like magic mail-merge for texting!

---

### **Step 9: Understanding the Limits and Costs**

Textbee has different plans depending on how much you use it.

| Feature           | Free Plan     | Premium Plan   |
| ----------------- | ------------- | -------------- |
| **Devices**       | 1 Phone       | Up to 5 Phones |
| **Daily Limit**   | 50 Messages   | **Unlimited**  |
| **Monthly Limit** | 300 Messages  | 5,000 Messages |
| **Bulk Sending**  | Max 50 people | **No Limit**   |

**Why go Pro?** If you are running a real business, 50 messages a day is very small. Also, having 5 devices is great for "Load Balancing." If one phone runs out of battery, the others take over.

---

### **Step 10: Troubleshooting (When things go wrong)**

Sometimes things don't work perfectly. Here is a checklist:

1. **Check the "Gateway" Switch:** Open the app on your phone. Is the big switch at the top set to **"Enabled"**?
2. **Internet Connection:** Does the phone have Wi-Fi or a strong data signal? If the phone is "offline," it cannot receive the command to send a text.
3. **Credit/Balance:** Does your SIM card actually have load or an active SMS plan? Try sending a normal text to a friend to test.
4. **Character Limits:** One standard SMS is **160 characters**. If you send a very long message, it counts as 2 or 3 messages. This will eat up your daily limit faster!

---

## **Pieces of Advice**

- **The "Dedicated" Phone:** Don't use your personal phone for a business gateway. Go buy an Android phone. Plug it into a charger, put it in a corner of your office with good Wi-Fi, and **leave it there**.
- **Don't Spam:** Network providers (Smart, Globe, DITO, TNT, TM, and others) are smart. If you send 1,000 messages in 5 minutes from a personal SIM, they might think you are a spammer and block your SIM card. Spread your messages out.
- **Check the Status:** With your account, Textbee has a dashboard page. If messages are not going out, check there first. Maybe the code in the system is wrong, or your SIM card is out of credits, or your phone is offline, or anything else.
