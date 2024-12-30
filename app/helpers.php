<?php

if (!function_exists('task_status_text')) {
    function task_status_text($status) {
        return match ($status) {
            'pending' => 'Beklemede',
            'in_progress' => 'Devam Ediyor',
            'completed' => 'Tamamlandı',
            default => $status,
        };
    }
} 