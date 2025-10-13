# Automatic Deployment Setup

**Problem:** You have to manually deploy through cPanel every time  
**Solution:** Set up automatic deployment so `git push` updates your live website

---

## **Option 1: GitHub Webhook (Recommended - Easiest)**

### Step 1: Upload Webhook Script
1. **Upload `webhook-deploy.php` to your live server**
   - Place it in: `/home/golfclub/public_html/webhook-deploy.php`
   - Make it executable: `chmod +x webhook-deploy.php`

### Step 2: Set Up GitHub Webhook
1. **Go to your GitHub repo:** `https://github.com/fortunechangers-alt/Golfclub-builders`
2. **Click Settings → Webhooks → Add webhook**
3. **Configure:**
   - **Payload URL:** `https://golfclub-builders.com/webhook-deploy.php`
   - **Content type:** `application/json`
   - **Secret:** Create a random secret (save it!)
   - **Events:** Just the `push` event
   - **Active:** ✅ Checked

### Step 3: Update Webhook Script
1. **Edit the webhook script** on your live server
2. **Replace:** `YOUR_WEBHOOK_SECRET_HERE` with your actual secret
3. **Save the file**

### Step 4: Test
1. **Make a small change** to your local files
2. **Commit and push:**
   ```bash
   git add .
   git commit -m "Test auto-deployment"
   git push origin main
   ```
3. **Check your website** - should update automatically!

---

## **Option 2: GitHub Actions (More Complex)**

### Step 1: Add Secrets to GitHub
1. **Go to your GitHub repo → Settings → Secrets and variables → Actions**
2. **Add these secrets:**
   - `HOST`: Your server IP or domain
   - `USERNAME`: Your cPanel username
   - `PASSWORD`: Your cPanel password (or SSH key)

### Step 2: Enable the Workflow
The `deploy-simple.yml` workflow is already created and will run automatically.

---

## **Option 3: Simple Git Pull Script (Manual Trigger)**

Create a simple script on your live server:

```bash
#!/bin/bash
# File: /home/golfclub/public_html/auto-deploy.sh
cd /home/golfclub/public_html
git pull origin main
chmod -R 755 app
chmod -R 775 writable
echo "✅ Auto-deployment complete!"
```

Then you can run: `bash auto-deploy.sh` from cPanel Terminal.

---

## **Recommended: Option 1 (Webhook)**

**Why webhooks are best:**
- ✅ **Fully automatic** - no manual steps
- ✅ **Secure** - uses GitHub signatures
- ✅ **Fast** - deploys immediately on push
- ✅ **Simple** - just one PHP file
- ✅ **Reliable** - works with any hosting provider

---

## **Testing Your Setup**

### Test 1: Manual Webhook Test
```bash
curl -X POST https://golfclub-builders.com/webhook-deploy.php \
  -H "Content-Type: application/json" \
  -d '{"ref":"refs/heads/main"}'
```

### Test 2: Full Deployment Test
1. **Make a small change** (add a comment to a file)
2. **Commit and push:**
   ```bash
   git add .
   git commit -m "Test auto-deployment"
   git push origin main
   ```
3. **Check your website** - should update within 30 seconds

---

## **Troubleshooting**

### Webhook Not Working?
1. **Check webhook URL** is correct
2. **Verify secret** matches in both places
3. **Check server logs** for errors
4. **Test with curl** command above

### GitHub Actions Not Working?
1. **Check secrets** are set correctly
2. **Verify server credentials**
3. **Check Actions tab** in GitHub for error logs

### Still Having Issues?
1. **Check file permissions** on live server
2. **Verify git is installed** on live server
3. **Test manual deployment** first

---

## **What Happens After Setup**

**Before (Manual):**
1. Make changes locally
2. `git push origin main`
3. Log into cPanel
4. Run deployment script
5. Website updates

**After (Automatic):**
1. Make changes locally
2. `git push origin main`
3. Website updates automatically! 🎉

---

## **Security Notes**

- **Webhook secret** prevents unauthorized deployments
- **GitHub signatures** verify the request is from GitHub
- **Only main branch** triggers deployment
- **Logs all deployments** for audit trail

---

## **Next Steps**

1. **Choose Option 1 (Webhook)** - it's the easiest
2. **Upload the webhook script** to your live server
3. **Set up the GitHub webhook**
4. **Test with a small change**
5. **Enjoy automatic deployments!**

---

✅ **Once set up, you'll never need to manually deploy again!**
