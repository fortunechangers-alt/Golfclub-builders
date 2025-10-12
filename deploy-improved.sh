#!/bin/bash

# Golf Club Builders - IMPROVED Deployment Script
# This script preserves important configuration files during deployment

echo "🚀 Starting IMPROVED deployment..."

# Navigate to site directory
cd /home/golfclub/public_html

# Backup critical files before deployment
echo "💾 Backing up critical configuration files..."
cp app/Config/SendGrid.php app/Config/SendGrid.php.backup
cp app/Config/App.php app/Config/App.php.backup
cp .htaccess .htaccess.backup 2>/dev/null || true

# Stash any local changes to avoid conflicts
echo "📦 Stashing local changes..."
git stash push -m "Pre-deployment backup $(date)"

# Fetch and merge changes (safer than reset --hard)
echo "📥 Updating to latest code..."
git fetch origin main
git merge origin/main --no-edit

# Restore critical configuration files
echo "🔧 Restoring configuration files..."
if [ -f app/Config/SendGrid.php.backup ]; then
    cp app/Config/SendGrid.php.backup app/Config/SendGrid.php
    echo "✅ SendGrid config restored"
fi

if [ -f app/Config/App.php.backup ]; then
    cp app/Config/App.php.backup app/Config/App.php
    echo "✅ App config restored"
fi

if [ -f .htaccess.backup ]; then
    cp .htaccess.backup .htaccess
    echo "✅ .htaccess restored"
fi

# Set proper permissions
echo "🔒 Setting permissions..."
chmod -R 755 app
chmod -R 775 writable
chmod 644 app/Config/*.php

# Clean up backup files
echo "🧹 Cleaning up..."
rm -f app/Config/SendGrid.php.backup
rm -f app/Config/App.php.backup
rm -f .htaccess.backup

echo ""
echo "✅ IMPROVED deployment complete!"
echo "🌐 Your website is updated: https://golfclub-builders.com"
echo "🔧 Configuration files preserved automatically"
echo ""
