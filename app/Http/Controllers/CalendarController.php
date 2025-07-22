<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the day view for a given project,
     * handling the day via a query parameter.
     */
    public function dayView(Project $project, Request $request)
    {
        $project->load('tasks');

        $dateParam = $request->query('date', now()->toDateString());

        $date = Carbon::parse($dateParam);

        $dayTasks = $project->tasks->filter(function ($task) use ($date) {
            $taskDate = new \DateTime($task->deadline_at);

            return $taskDate->format('Y-m-d') === $date->format('Y-m-d');
        });

        return view('project.view.calendar.day-view', [
            'project' => $project,
            'date' => $date,
            'dayTasks' => $dayTasks,
        ]);
    }

    /**
     * Display the three days view for a given project,
     * handling the date via a query parameter.
     */
    public function threeDaysView(Project $project, Request $request)
    {
        $project->load('tasks');
        $dateParam = $request->query('date', now()->toDateString());
        $date = Carbon::parse($dateParam);
        $startDate = $date->copy()->startOfDay();
        $endDate = $date->copy()->addDays(2)->endOfDay();
        $threeDaysTasks = $project->tasks->filter(function ($task) use ($startDate, $endDate) {
            if (! $task->deadline_at) {
                return false;
            }

            $deadline = Carbon::parse($task->deadline_at)->startOfDay();

            return $deadline->between($startDate, $endDate);
        });

        return view('project.view.calendar.threedays-view', [
            'project' => $project,
            'date' => $date,
            'threeDaysTasks' => $threeDaysTasks,
        ]);
    }

    /**
     * Display the month view partial for a given project,
     * handling the year and month via query parameters.
     */
    public function monthView(Project $project, Request $request)
    {
        $project->load('tasks');

        $year = (int) $request->query('year', now()->year);
        $month = (int) $request->query('month', now()->month);

        $date = \Carbon\Carbon::create($year, $month, 1);

        $daysInMonth = $date->daysInMonth;
        $firstDayOfWeek = ($date->dayOfWeek + 6) % 7;

        return view('project.view.calendar.month-view', [
            'project' => $project,
            'year' => $year,
            'month' => $month,
            'daysInMonth' => $daysInMonth,
            'firstDayOfWeek' => $firstDayOfWeek,
            'currentDate' => $date,
        ]);
    }

    /**
     * Display the week view for a given project,
     * handling the week via query parameters.
     */
    public function weekView(Project $project, Request $request)
    {
        $project->load('tasks');

        $now = Carbon::now();
        $year = (int) $request->query('year', $now->year);
        $month = (int) $request->query('month', $now->month);
        $day = (int) $request->query('day', $now->day);

        $selectedDate = Carbon::create($year, $month, $day);
        $startOfWeek = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $selectedDate->copy()->endOfWeek(Carbon::SUNDAY);

        $weekTasks = $project->tasks->filter(function ($task) use ($startOfWeek, $endOfWeek) {
            if (! $task->deadline_at) {
                return false;
            }

            $deadline = Carbon::parse($task->deadline_at)->startOfDay();

            return $deadline->between($startOfWeek->copy()->startOfDay(), $endOfWeek->copy()->endOfDay());
        });

        return view('project.view.calendar.week-view', [
            'project' => $project,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'weekTasks' => $weekTasks,
        ]);
    }
}
