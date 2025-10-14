# 🚀 AUTOMATED DEPLOYMENT - COMPLETE SETUP

## ✅ DEPLOYMENT IS NOW AUTOMATED!

### How It Works Now:

**To deploy changes to the live site, simply run this command:**

```bash
curl -s "https://golfclub-builders.com/simple-deploy.php?key=deploy123"
```

**That's it!** The site updates automatically without any manual cPanel work.

---

## 🔧 The PHP 8.4 Problem - SOLVED!

### The Issue:
Running `git` commands in cPanel Terminal was somehow changing the PHP version away from 8.4, breaking the live site.

### The Solution:
Added PHP version enforcement to `/public/.htaccess`:

```apache
# Force PHP 8.4
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php84 .php .php8 .phtml
</IfModule>
```

**This prevents ANY command from changing the PHP version.** The .htaccess file now forces PHP 8.4 permanently.

---

## 📋 Complete Deployment Workflow

### For the AI Agent:

1. **Make changes locally**
2. **Commit changes:** `git commit -m "Your message"`
3. **Push to GitHub:** `git push origin main`
4. **Deploy to live:** `curl -s "https://golfclub-builders.com/simple-deploy.php?key=deploy123"`

**Example:**
```bash
cd /Users/willisfamily/Movies/CacheClip/audio/Applications/XAMPP/xamppfiles/htdocs/Projects/golf_builders_2
git add .
git commit -m "Fix mobile footer styling"
git push origin main
curl -s "https://golfclub-builders.com/simple-deploy.php?key=deploy123"
```

### What the Deployment Script Does:

The `simple-deploy.php` file automatically:
1. Fetches latest code from GitHub
2. Resets to the latest commit
3. Sets proper file permissions
4. Logs the deployment
5. Shows PHP version to confirm it's still 8.4

---

## 🆘 If Deployment Fails

### If the deployment URL returns 404:

The `simple-deploy.php` file isn't on the server yet. Run this ONE TIME in cPanel Terminal:

```bash
cd /home/golfclub/public_html && git fetch --all && git reset --hard origin/main && chmod -R 755 app && chmod -R 775 writable
```

After this, the automated deployment will work forever.

### If PHP Version Changed Back to Old Version:

This should NOT happen anymore with the .htaccess fix, but if it does:

1. Check if .htaccess exists: `ls -la /home/golfclub/public_html/public/.htaccess`
2. Verify it contains the PHP 8.4 handler (see above)
3. If needed, re-deploy to restore the .htaccess file

### If Git Says "Uncommitted Changes":

Run this to force a clean deployment:
```bash
curl -s "https://golfclub-builders.com/simple-deploy.php?key=deploy123"
```

The script uses `git reset --hard` which overwrites ANY local changes on the server.

---

## 🎯 Key Files

### `/simple-deploy.php`
The automated deployment script at the root of the live site.

**Location on live:** `/home/golfclub/public_html/simple-deploy.php`  
**URL:** `https://golfclub-builders.com/simple-deploy.php?key=deploy123`  
**Security:** Protected by a secret key (`deploy123`)

### `/public/.htaccess`
Contains the PHP 8.4 enforcement rule that prevents version changes.

**Location on live:** `/home/golfclub/public_html/public/.htaccess`

---

## 📝 Deployment History Log

The deployment script automatically logs each deployment to:
`/home/golfclub/public_html/deploy.log`

To view recent deployments:
```bash
tail -20 /home/golfclub/public_html/deploy.log
```

---

## ⚠️ IMPORTANT NOTES

### CSS/JS Cache Busting:
When updating CSS or JavaScript, increment the version number in `/app/Views/layout/header.php`:

```php
<link rel="stylesheet" href="<?= base_url('css/style.min.css?v=2.2') ?>">
```

Change `v=2.2` to `v=2.3`, etc. to force browsers to load the new file.

### Never Run Manual Git Commands in cPanel:
You don't need to! The automated deployment handles everything. If you DO need to run git commands for debugging, the .htaccess now protects the PHP version.

### The User Should Never Need cPanel Again:
For deployments, everything is automated. The user only needs to say "push this to live" and the AI agent runs the curl command.

---

## 🎉 Success Criteria

✅ **Deployment is working if:**
- Running the curl command returns "Deployment Successful"
- Changes appear on https://golfclub-builders.com immediately
- PHP version stays at 8.4 (check with `php -v` in cPanel)
- No manual cPanel work required

✅ **PHP version is fixed if:**
- The .htaccess file contains the PHP 8.4 handler
- Running ANY terminal command doesn't change PHP version
- Site continues working after deployments

---

## 📞 Support

If the user says:
- "Push to live" → Run the curl deployment command
- "Deploy this" → Run the curl deployment command
- "It's broken on live" → Check if deployment worked, verify PHP version
- "PHP changed again" → This shouldn't happen with .htaccess fix, but investigate

---

**Last Updated:** October 14, 2025  
**Deployment Commit:** ce20b686b9c77a9ea940d9c1b307a1b1e4a2be48  
**Status:** ✅ Fully automated, PHP 8.4 locked in place


