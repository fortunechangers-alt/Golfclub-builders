#!/bin/bash

# EMERGENCY DEPLOYMENT FIX
# Copy this entire file content and paste it into your cPanel Terminal

echo "🚨 EMERGENCY DEPLOYMENT - Fixing DeployHQ issues..."
echo ""

# Navigate to site directory
cd /home/golfclub/public_html

# Get the latest code
echo "📥 Fetching latest code from GitHub..."
git fetch origin main

# Force update to the latest commit with mobile fixes
echo "🔄 Updating to commit with mobile optimizations..."
git reset --hard 0c3b237

# Install dependencies (this fixes the vendor issue)
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Set proper permissions
echo "🔒 Setting permissions..."
chmod -R 755 app
chmod -R 775 writable

echo ""
echo "✅ DEPLOYMENT COMPLETE!"
echo "🌐 Your website is now updated with:"
echo "   - Mobile optimizations"
echo "   - Sticky cart"
echo "   - Responsive layouts"
echo "   - Logo adjustments"
echo ""
echo "Check: https://golfclub-builders.com"
echo ""

