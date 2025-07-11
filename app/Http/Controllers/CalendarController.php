<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $now = new \DateTime();
        $year = (int) $request->query('year', (int) $now->format('Y'));
        $month = (int) $request->query('month', (int) $now->format('m'));
        $day = (int) $request->query('day', (int) $now->format('d'));

        $selectedDate = new \DateTime();
        $selectedDate->setDate($year, $month, $day);

        $dayOfWeek = (int) $selectedDate->format('w');
        $offsetToMonday = ($dayOfWeek + 6) % 7;
        $startOfWeek = clone $selectedDate;
        $startOfWeek->modify("-$offsetToMonday days");

        $endOfWeek = clone $startOfWeek;
        $endOfWeek->modify('+6 days');

        $weekTasks = $project->tasks->filter(function ($task) use ($startOfWeek, $endOfWeek) {
            $deadline = new \DateTime($task->deadline_at);
            return $deadline >= $startOfWeek && $deadline <= $endOfWeek;
        });

        return view('project.view.calendar.week-view', [
            'project' => $project,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'weekTasks' => $weekTasks,
        ]);
    }
}
