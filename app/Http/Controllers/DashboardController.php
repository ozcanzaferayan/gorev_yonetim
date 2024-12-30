<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $completedTasks = Task::where('status', 'completed')->count();

        $totalUsers = User::count();
        $userWithMostTasks = User::withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->first();

        $recentTasks = Task::with('user')
            ->latest()
            ->take(5)
            ->get();

        $upcomingTasks = Task::with('user')
            ->whereNotNull('due_date')
            ->where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $userTaskDistribution = User::withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'totalUsers',
            'userWithMostTasks',
            'recentTasks',
            'upcomingTasks',
            'userTaskDistribution'
        ));
    }
} 