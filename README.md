# Laravel Watchtower 

Lightweight monitoring for Laravel applications and VPS servers.

No dashboards. No SaaS.
Just alerts when things go wrong.

---

## ✨ Features

* 🚨 Alerts when new Laravel log errors appear
* ⚙️ Monitors Supervisor queue workers
* 💾 Disk usage alerts (optional / coming soon)
* 💓 Server heartbeat (optional / coming soon)

---

## 📦 Installation

Install the package via Composer:

```bash
composer require kelvin/watchtower
```

Run the installer:

```bash
php artisan watchtower:install
```

This command publishes the configuration file and shows the next required steps.

---

## ⚙️ Configuration

### 1️⃣ Set Alert Email

Add the following to your `.env` file:

```env
WATCHTOWER_ALERT_EMAIL=you@example.com
```

This is the email address that will receive Watchtower alerts.

---

### 2️⃣ (Optional) Publish Config File

If you want to customize Watchtower settings, publish the config file:

```bash
php artisan vendor:publish --tag=watchtower-config
```

This will create:

```text
config/watchtower.php
```

---

## ⏱ Scheduler Setup (REQUIRED)

Watchtower relies on Laravel's scheduler. Without this step, alerts **will not be sent**.

### Add to `App\\Console\\Kernel.php`

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('watchtower:logs')->everyMinute();
    $schedule->command('watchtower:queues')->everyMinute();
}
```

---

### Enable Cron on Your Server

Ensure this cron job exists on your server:

```bash
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

> ⚠️ Without this cron job, Watchtower will not run.

---

## 🧪 Testing

To test log monitoring:

1. Trigger a Laravel error
2. Run:

```bash
php artisan watchtower:logs
```

An alert should be sent to the configured email.

---

## 🚀 Why Watchtower?

* No enterprise complexity
* No external monitoring agents
* Works on cheap VPS servers
* Perfect for solo devs and small teams
* Laravel-native

---

## 🛣 Roadmap

* Disk usage monitoring
* Server offline detection
* Slack / Telegram notifications
* Central dashboard (optional)

---

## 📄 License

MIT
