<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\WhyCard;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __invoke()
    {
        $settings = SiteSetting::all();

        $heroImage = $settings['hero_image'] ?? null;
        $heroImageSrc = $heroImage
            ? (str_starts_with($heroImage, 'http') ? $heroImage : '/storage/' . $heroImage)
            : 'https://halff.com/wp-content/uploads/2022/09/4_Services_B10_Landscape-Arch-2-scaled.jpg';

        return view('home', [
            'settings'    => $settings,
            'heroImage'   => $heroImageSrc,
            'services'    => Service::orderBy('sort_order')->get(),
            'projects'    => Project::orderBy('sort_order')->get(),
            'teamMembers' => TeamMember::orderBy('sort_order')->get(),
            'whyCards'    => WhyCard::orderBy('sort_order')->get(),
        ]);
    }
}
