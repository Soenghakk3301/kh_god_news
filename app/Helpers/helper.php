<?php

use App\Models\Language;
use Illuminate\Support\Str;

/** format news tage */
function formatTags(array $tags): String
{
    return implode(',', $tags);
}

/** get selected language from session */
function getLanguage(): string
{
    if(session()->has('language')) {
        return  session('language');
    } else {
        try {
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);

            return $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');

            return $language->lang;
            throw $th;
        }
    }
}

/** get language code in session */
function setLanguage(string $code): void
{
    session(['language' => $code]);
}

/** truncate text */
function truncate(string $text, int $limit =100): String
{
    return Str::limit($text, $limit, '...');
}