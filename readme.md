FP Event Organizer Campus

Project Event Organizer Campus ini memiliki fitur:

* Login Google (OAuth)
* Integrasi Google Calendar
* CRUD Event (Database + Google Calendar)
* Reminder Email otomatis (Cron Job)
* Status event (upcoming / completed)
* Notification system

---

1. Requirement

* PHP >= 8.0
* MySQL / MariaDB
* Composer
* Web server (Apache / Nginx)
* Akun Google + Google Cloud Console

---

2. Cara Menjalankan di Lokal

Clone / Extract Project
git clone https://github.com/rhmatt-code/event_organizer_campus.git
Lakukan command ini didalam folder localhost jika laragon: laragon/www/
Setelah itu lakukan install composer di root project:
composer install

---

3. Konfigurasi Database
Buat database dengan nama campus_jaya lalu lakukan import file sql yang ada didalam github dengan nama campus_jaya.sql.

---

5. Konfigurasi .env

Didalam env ini tersedia tentang kode penting didalam project ini
  * GOOGLE_CLIENT_ID=(copy google client id yang ada didalam file credentials.json)
  * GOOGLE_CLIENT_SECRET=(copy google client secret yang ada didalam file credentials.json)
  * GOOGLE_REDIRECT_URI=(isi redirect url, link page callbacknya)
  * GOOGLE_APP_NAME=(nama aplikasi)

  * SMTP_HOST=(isi smtp host)
  * SMTP_USER=(isi gmail user untuk mengirim notification)
  * SMTP_PASS=(password gmailnya)

  * DB_HOST=localhost
  * DB_NAME=(nama database)
  * DB_USER=(nama user)
  * DB_PASS=(password database)

---

5. Konfigurasi Google OAuth

    1. Buat Project
    2. Enable:
       * Google Calendar API
       * Google People API
    3. OAuth Consent Screen → Publish
    4. Buat OAuth Client ID (Web)
    
    Authorized Redirect URI:
    http://localhost/fp-event_organizer_campus/index.php?page=google_callback

---

7. Struktur Token Google

* Access token & refresh token disimpan di **database**
* Kolom:

  * `users.remember_token` (JSON token)

---

7. Login Google Flow

    1. User klik **Login with Google**
    2. Redirect ke Google OAuth
    3. Callback:
    
       * Cek email di database
       * Jika ada → login
       * Jika tidak ada → insert user baru
    4. Simpan token Google
    5. Redirect ke dashboard

---

8. CRUD Event

    Create Event
    
    * Simpan ke database
    * Buat event di Google Calendar
    * Simpan `google_calendar_event_id`
    
    Update Event
    
    * Update database
    * Update event Google Calendar
    
    Delete Event
    
    * Hapus di Google Calendar
    * Hapus di database

---

9. Status Event

Status otomatis:

* `upcoming` → event_date > NOW()
* `completed` → event_date < NOW()

---

10. Cron Job

Cronjob untuk melakukannya sistem otomatis mengirim email dan update status eventnya.

  * Update Status Event
  
  ```bash
  * * * * * php /home/username/public_html/cron/update_event.php
  ```

  * Kirim Reminder Email

  ```bash
  * * * * * php /home/username/public_html/cron/send_reminder.php
  ```

---

11. Email Reminder

* Menggunakan PHPMailer
* Reminder dikirim H-1 atau sesuai konfigurasi
* Status email:

  * pending
  * sent
  * failed

---

12. Akun Uji

Login menggunakan akun Google masing-masing.
User otomatis terdaftar saat login pertama.


---
