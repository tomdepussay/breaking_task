<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;

class IcalSynchronizationController extends Controller
{
    public function export(Project $project)
    {
        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//Breaking Task//EN',
        ];

        foreach ($project->tasks as $task) {
            // On parse à la volée
            $startDate = $task->start_at ? Carbon::parse($task->start_at) : ($task->deadline_at ? Carbon::parse($task->deadline_at) : now());
            $endDate   = $task->end_at ? Carbon::parse($task->end_at) : ($task->deadline_at ? Carbon::parse($task->deadline_at) : $startDate);

            $start = $startDate->format('Ymd');
            $end   = $endDate->copy()->addDay()->format('Ymd'); // DTEND = lendemain pour journée entière

            $lines[] = 'BEGIN:VEVENT';
            $lines[] = 'UID:' . uniqid() . '@breaking-task.fr';
            $lines[] = 'SUMMARY:' . addslashes($task->name);
            $lines[] = 'DESCRIPTION:' . addslashes($task->description ?? '');
            $lines[] = 'DTSTART;VALUE=DATE:' . $start;
            $lines[] = 'DTEND;VALUE=DATE:' . $end;
            $lines[] = 'END:VEVENT';
        }


        $lines[] = 'END:VCALENDAR';

        $ical = implode("\r\n", $lines);

        return response($ical, 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="project-'.$project->id.'.ics"',
        ]);
    }
}
