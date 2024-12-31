<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        Task::create([
            'title' => 'Acil Görev',
            'description' => 'Bu görev hemen tamamlanmalı.',
            'status' => 'pending',
            'user_id' => $user->id,
            'due_date' => now()->addDays(3),
        ]);

        Task::create([
            'title' => 'Devam Eden Görev',
            'description' => 'Bu görev üzerinde çalışılıyor.',
            'status' => 'in_progress',
            'user_id' => $user->id,
            'due_date' => now()->addWeek(),
        ]);

        Task::create([
            'title' => 'Tamamlanan Görev',
            'description' => 'Bu görev tamamlandı.',
            'status' => 'completed',
            'user_id' => $user->id,
            'due_date' => now()->subDays(2),
        ]);
    }
}
