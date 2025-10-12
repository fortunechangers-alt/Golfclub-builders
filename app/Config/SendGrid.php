<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class SendGrid extends BaseConfig
{
    /**
     * SendGrid API Key
     * Get this from: https://app.sendgrid.com/settings/api_keys
     */
    public string $apiKey = 'PASTE_YOUR_SENDGRID_API_KEY_HERE';
    
    /**
     * Default From Email
     */
    public string $fromEmail = 'daniel@golfclub-builders.com';
    
    /**
     * Default From Name
     */
    public string $fromName = 'Golf Club Builders';
}

