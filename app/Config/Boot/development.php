<?php

/**
 * This file is loaded during the boot process when the environment
 * is set to development.
 */

// Polyfill for Locale class (intl extension not available in XAMPP)
if (!class_exists('Locale')) {
    class Locale
    {
        public const DEFAULT_LOCALE = 'en';

        public static function getDefault(): string
        {
            return self::DEFAULT_LOCALE;
        }

        public static function setDefault(string $locale): bool
        {
            return true;
        }

        public static function acceptFromHttp(?string $header): ?string
        {
            return self::DEFAULT_LOCALE;
        }

        public static function canonicalize(string $locale): string
        {
            return str_replace('_', '-', $locale);
        }

        public static function composeLocale(array $subtags): string
        {
            return self::DEFAULT_LOCALE;
        }

        public static function filterMatches(string $langtag, string $locale, bool $canonicalize = false): ?bool
        {
            return true;
        }

        public static function getAllVariants(string $locale): array
        {
            return [];
        }

        public static function getDisplayLanguage(string $locale, ?string $displayLocale = null): string
        {
            return 'English';
        }

        public static function getDisplayName(string $locale, ?string $displayLocale = null): string
        {
            return 'English';
        }

        public static function getDisplayRegion(string $locale, ?string $displayLocale = null): string
        {
            return 'United States';
        }

        public static function getDisplayScript(string $locale, ?string $displayLocale = null): string
        {
            return 'Latin';
        }

        public static function getDisplayVariant(string $locale, ?string $displayLocale = null): string
        {
            return '';
        }

        public static function getKeywords(string $locale): array
        {
            return [];
        }

        public static function getPrimaryLanguage(string $locale): string
        {
            return 'en';
        }

        public static function getRegion(string $locale): string
        {
            return 'US';
        }

        public static function getScript(string $locale): string
        {
            return '';
        }

        public static function lookup(array $languageTag, string $locale, bool $canonicalize = false, ?string $defaultLocale = null): ?string
        {
            return $defaultLocale ?? self::DEFAULT_LOCALE;
        }

        public static function parseLocale(string $locale): array
        {
            return [
                'language' => 'en',
                'region' => 'US',
            ];
        }
    }
}
