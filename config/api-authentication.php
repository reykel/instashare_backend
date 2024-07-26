<?php

return [
    'revoke_only_current_token' => env('REVOKE_ONLY_CURRENT_TOKEN', false),

    'revoke_all_tokens' => env('REVOKE_ALL_TOKENS', false),

    'delete_current_token' => env('DELETE_CURRENT_TOKEN', true),

    'delete_all_tokens' => env('DELETE_ALL_TOKENS', true),

    'new_password_form_url' =>  env('FRONTEND_APP_URL', 'http://localhost:8080') .'/new-password',

    'set_password_form_url' =>  env('FRONTEND_APP_URL', 'http://localhost:8080') .'/set-password',

    'token_id' => 'App',
    
    'frontend_app_url' => env('FRONTEND_APP_URL', 'http://localhost:8080'),

    'tokens_expiring_on_seconds' => env('TOKENS_EXPIRING_ON_SECONDS', 3600),

    'refresh_tokens_expiring_on_days' => env('REFRESH_TOKENS_EXPIRING_ON_DAYS', 3),
    
    'personal_access_tokens_expiring_on_months' => env('PERSONAL_ACCESS_TOKENS_EXPIRING_ON_MONTHS', 12),

    'email_account_verified_url' => env('FRONTEND_APP_URL', 'http://localhost:8000') . '/verified',

    /*

    'email_account_just_verified_url' => env('FRONTEND_APP_URL', 'http://localhost:8000') . '/verified',

    'email_account_was_already_verified_url' =>  env('FRONTEND_APP_URL', 'http://localhost:8000') . '/already-verified',

    */

];
