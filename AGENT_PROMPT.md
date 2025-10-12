# Golf Club Builders - Agent Prompt for Max Mode

## Project Overview
This is a CodeIgniter 4 golf club building website with blog functionality. The site has a deployment system that requires special handling to prevent configuration file overwrites.

## Critical Deployment Information

### ⚠️ DEPLOYMENT WARNING
**NEVER use `git reset --hard` or `git pull` directly on the live server!**

The live server has configuration files that must be preserved:
- `app/Config/SendGrid.php` (line 13: SendGrid API key)
- `app/Config/App.php` (base URL settings)
- `.htaccess` (PHP version and server config)
- PHP version is set to 8.4

### Safe Deployment Process

1. **Local Development:**
   ```bash
   # Make changes locally
   git add .
   git commit -m "Description of changes"
   git push origin main
   ```

2. **Live Server Deployment:**
   ```bash
   cd /home/golfclub/public_html
   bash deploy-improved.sh
   ```

### If deploy-improved.sh doesn't exist, use this manual process:
```bash
cd /home/golfclub/public_html

# Backup critical files
cp app/Config/SendGrid.php app/Config/SendGrid.php.backup
cp app/Config/App.php app/Config/App.php.backup
cp .htaccess .htaccess.backup

# Safe update
git stash
git fetch origin main
git merge origin/main --no-edit

# Restore critical files
cp app/Config/SendGrid.php.backup app/Config/SendGrid.php
cp app/Config/App.php.backup app/Config/App.php
cp .htaccess.backup .htaccess

# Set permissions
chmod -R 755 app
chmod -R 775 writable

# Cleanup
rm *.backup
```

## Project Structure

### Key Files:
- `app/Controllers/Blog.php` - Blog post management
- `app/Views/blog/` - Blog post templates
- `public/images/` - Blog post images
- `deploy-improved.sh` - Safe deployment script
- `.gitignore` - Prevents config file commits

### Blog System:
- Blog posts are defined in `Blog.php` controller
- Each post needs: slug, title, excerpt, date, read_time, featured, thumbnail
- Featured post appears at top of blog page
- Thumbnails are stored in `public/images/`

## Common Tasks

### Adding New Blog Post:
1. Add entry to `getBlogPosts()` array in `Blog.php`
2. Create view file in `app/Views/blog/[slug].php`
3. Add routing in `view()` method in `Blog.php`
4. Add thumbnail image to `public/images/`
5. Commit and deploy using safe process

### Changing Featured Post:
1. Set `featured => false` on current featured post
2. Set `featured => true` on new featured post
3. Commit and deploy

### Adding Thumbnails:
1. Add image to `public/images/`
2. Add `thumbnail => 'filename.jpg'` to blog post array
3. Commit and deploy

## Troubleshooting

### If deployment breaks config files:
1. Check if backup files exist: `ls *.backup`
2. Restore from backup: `cp *.backup app/Config/`
3. Fix SendGrid API key in line 13 of SendGrid.php
4. Verify PHP version is 8.4
5. Check .htaccess exists and is correct

### If blog posts don't appear:
1. Check `Blog.php` controller for syntax errors
2. Verify blog post entries in `getBlogPosts()` array
3. Check routing in `view()` method
4. Verify view files exist in `app/Views/blog/`

### If images don't load:
1. Check image files exist in `public/images/`
2. Verify image filenames match exactly (case-sensitive)
3. Check file permissions: `chmod 644 public/images/*`

## File Permissions
```bash
chmod -R 755 app
chmod -R 775 writable
chmod 644 app/Config/*.php
chmod 644 public/images/*
```

## Important Notes
- Always use the improved deployment script
- Never commit sensitive config files
- Test locally before deploying
- Preserve configuration files during deployment
- The site URL is: https://golfclub-builders.com

## Emergency Recovery
If the site breaks after deployment:
1. SSH into server
2. Check if backup files exist: `ls *.backup`
3. Restore configs: `cp *.backup app/Config/`
4. Fix API key in SendGrid.php line 13
5. Set PHP to 8.4 in hosting control panel
6. Check .htaccess file exists
