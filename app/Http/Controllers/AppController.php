<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\WhyCard;

class AppController extends Controller
{
    public function __invoke()
    {
        return view('app', [
            'stats' => [
                'services'     => Service::count(),
                'projects'     => Project::count(),
                'team_members' => TeamMember::count(),
                'why_cards'    => WhyCard::count(),
                'unread'       => ContactSubmission::whereNull('read_at')->count(),
                'total_leads'  => ContactSubmission::count(),
            ],
            'recentSubmissions' => ContactSubmission::latest()->take(5)->get(),
        ]);
    }
}
