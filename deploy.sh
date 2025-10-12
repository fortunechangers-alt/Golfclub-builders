#!/bin/bash

# Golf Club Builders - Simple Deployment Script
# Run this in cPanel Terminal: bash deploy.sh

echo "🚀 Starting deployment..."

# Navigate to site directory
cd /home/golfclub/public_html

# Stash any local changes
echo "📦 Saving local changes..."
git stash

# Pull latest code from GitHub
echo "📥 Pulling latest code from GitHub..."
git pull origin main

# Re-apply local changes (like API key)
echo "🔧 Restoring local configuration..."
git stash pop 2>/dev/null || echo "No local changes to restore"

# Make sure API key is set
if grep -q "PASTE_YOUR_SENDGRID_API_KEY_HERE" app/Config/SendGrid.php; then
    echo "⚠️  WARNING: SendGrid API key needs to be added!"
    echo "Edit: /home/golfclub/public_html/app/Config/SendGrid.php"
    echo "Line 13: Add your SendGrid API key"
else
    echo "✅ SendGrid API key is configured"
fi

# Set proper permissions
echo "🔒 Setting permissions..."
chmod -R 755 app
chmod -R 775 writable

echo ""
echo "✅ Deployment complete!"
echo "🌐 Your website is updated: https://golfclub-builders.com"
echo ""

