<?php

if (!function_exists('task_status_text')) {
    function task_status_text($status) {
        return match ($status) {
            'in_progress' => 'Devam Ediyor',
            'pending' => 'Bekliyor',
            'completed' => 'Tamamlandı',
            default => ucfirst($status),
        };
    }
} 