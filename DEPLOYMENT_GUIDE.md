# Golf Club Builders - Deployment Guide

## The Problem
The original deployment script was overwriting critical configuration files, requiring manual intervention after each deployment.

## The Solution
Use the improved deployment script that preserves configuration files automatically.

## Quick Deployment Commands

### For Live Server (cPanel Terminal/SSH):
```bash
cd /home/golfclub/public_html
bash deploy-improved.sh
```

### For Local Development:
```bash
# Make sure you're in the project directory
cd /path/to/golf_builders_2

# Add and commit changes
git add .
git commit -m "Your commit message"
git push origin main

# Then run deployment on live server
```

## What the Improved Script Does

1. **Backs up critical files** before deployment
2. **Uses git merge** instead of reset --hard (safer)
3. **Restores configuration files** automatically
4. **Sets proper permissions**
5. **Cleans up backup files**

## Configuration Files That Are Preserved

- `app/Config/SendGrid.php` - Email API key
- `app/Config/App.php` - Base URL and app settings  
- `.htaccess` - Server configuration
- PHP version settings

## Troubleshooting

### If deployment still fails:
1. Check file permissions: `chmod -R 755 app`
2. Verify PHP version: `php -v`
3. Check SendGrid config: `cat app/Config/SendGrid.php`
4. Verify .htaccess exists: `ls -la .htaccess`

### Manual fixes if needed:
```bash
# Fix SendGrid API key
nano app/Config/SendGrid.php
# Edit line 13 with your API key

# Fix PHP version (if needed)
# Contact hosting provider to set PHP 8.4

# Fix permissions
chmod -R 755 app
chmod -R 775 writable
```

## Prevention

The `.gitignore` file now prevents sensitive config files from being committed, so they won't be overwritten during deployment.
