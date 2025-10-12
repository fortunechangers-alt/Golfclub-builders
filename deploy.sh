#!/bin/bash

# Golf Club Builders - Simple Deployment Script
# Run this in cPanel Terminal: bash deploy.sh

echo "🚀 Starting deployment..."

# Navigate to site directory
cd /home/golfclub/public_html

# Force update to latest code (preserving API key)
echo "📥 Updating to latest code..."
git fetch origin main
git reset --hard origin/main

# Check if API key needs to be re-added
echo "🔧 Checking configuration..."

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

