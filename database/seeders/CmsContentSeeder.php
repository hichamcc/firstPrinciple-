<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\WhyCard;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    public function run(): void
    {
        // Site Settings
        $settings = [
            'hero_headline'    => 'Urban Planning & Landscape Architecture',
            'hero_subheadline' => 'Thoughtful, community-centred solutions in urban planning, land development, and landscape architecture.',
            'hero_image'       => 'https://halff.com/wp-content/uploads/2022/09/4_Services_B10_Landscape-Arch-2-scaled.jpg',
            'about_badge'      => 'Who We Are',
            'about_heading'    => 'Planning from first principles',
            'about_text_1'     => '1st Principles Planning is a multidisciplinary consulting firm specializing in urban planning and landscape architecture. Our team brings together over 70 years of collective experience working across municipal, private, and community-driven projects.',
            'about_text_2'     => 'We take a holistic approach to every project — one that considers the interconnected needs of communities, municipalities, developers, and the environment. From a single development permit to an entire neighbourhood plan, we bring the same rigour and care.',
            'about_text_3'     => 'Our philosophy is built on genuine public engagement and community consensus. We believe the best plans are those that give people a real voice in shaping the places where they live, work, and play.',
            'phone'            => '(403) 555-1234',
            'email'            => 'info@1stprinciplesplanning.com',
        ];
        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // Services
        $services = [
            ['icon' => 'phosphor-file-text',     'title' => 'Development Permits & Approvals',      'description' => 'Navigate the complex approvals process with confidence. We manage applications from pre-consultation through to final permit issuance.'],
            ['icon' => 'phosphor-squares-four',   'title' => 'Subdivision Planning',                  'description' => 'From concept to registered plan, we handle tentative plans, detailed engineering coordination, and municipal submissions.'],
            ['icon' => 'phosphor-map-trifold',    'title' => 'Land Use Applications',                 'description' => 'Rezoning, land use amendments, and redesignation applications prepared and managed to meet municipal requirements.'],
            ['icon' => 'phosphor-buildings',      'title' => 'Neighbourhood & Area Structure Plans',  'description' => 'Large-scale community planning that balances growth objectives with livability, infrastructure, and environmental considerations.'],
            ['icon' => 'phosphor-scales',         'title' => 'Municipal Policy & Bylaw Updates',      'description' => 'Policy analysis, bylaw drafting, and stakeholder engagement to support municipalities in modernizing their planning frameworks.'],
            ['icon' => 'phosphor-users-three',    'title' => 'Community & Public Engagement',         'description' => 'Meaningful public participation strategies that build consensus and give communities a genuine voice in planning decisions.'],
            ['icon' => 'phosphor-tree',           'title' => 'Landscape Architecture & Design',       'description' => 'Functional, beautiful outdoor spaces — from streetscapes and parks to residential and commercial site design.'],
        ];
        foreach ($services as $i => $data) {
            Service::create(array_merge($data, ['sort_order' => $i + 1]));
        }

        // Projects
        $projects = [
            [
                'image'       => 'https://www.rpsgroup.com/media/ewfeclor/mollison-park_scottburrowsphotography_09.jpg',
                'category'    => 'Area Structure Plan',
                'title'       => 'Riverside Community Plan',
                'description' => 'A 240-acre master-planned community featuring mixed-use development, connected trail systems, and sustainable stormwater management.',
            ],
            [
                'image'       => 'https://www.ecocentrix.com/wp-content/uploads/2017/06/Oak-View-Drive-Slide-3-1.jpg',
                'category'    => 'Landscape Architecture',
                'title'       => 'Downtown Streetscape Renewal',
                'description' => 'Revitalized a six-block downtown corridor with widened sidewalks, native plantings, public art, and improved pedestrian crossings.',
            ],
            [
                'image'       => 'https://blog.landscapedrains.com/hs-fs/hubfs/AdobeStock_137216603_web.jpg?width=1000&height=667&name=AdobeStock_137216603_web.jpg',
                'category'    => 'Land Use & Policy',
                'title'       => 'Heritage District Rezoning',
                'description' => 'Successfully rezoned a 15-acre heritage-adjacent site to allow sensitive mixed-use infill while preserving neighbourhood character.',
            ],
            [
                'image'       => 'https://media.licdn.com/dms/image/v2/C4D1BAQGJHN_CjyxVNw/company-background_10000/company-background_10000/0/1583607248608/alderwood_landscaping_cover?e=2147483647&v=beta&t=E8ilKYIwEqnzrxXLQ1CgjEGR8vmAOO569Vsopm01Pcc',
                'category'    => 'Public Engagement & Design',
                'title'       => 'Regional Park Master Plan',
                'description' => 'Led a community-driven design process for a 60-acre regional park with athletic facilities, natural areas, and inclusive play spaces.',
            ],
        ];
        foreach ($projects as $i => $data) {
            Project::create(array_merge($data, ['sort_order' => $i + 1]));
        }

        // Team Members
        $team = [
            ['title' => 'Senior Urban Planner',  'years' => '25+ years', 'skills' => ['Area Structure Plans', 'Municipal Policy', 'Land Use Strategy']],
            ['title' => 'Urban Planner',          'years' => '20+ years', 'skills' => ['Development Permits', 'Subdivision Planning', 'Rezoning Applications']],
            ['title' => 'Urban Planner',          'years' => '15+ years', 'skills' => ['Community Engagement', 'Public Consultation', 'Policy Research']],
            ['title' => 'Landscape Architect',   'years' => '12+ years', 'skills' => ['Streetscape Design', 'Park Planning', 'Sustainable Landscapes']],
        ];
        foreach ($team as $i => $data) {
            TeamMember::create(array_merge($data, ['sort_order' => $i + 1]));
        }

        // Why Cards
        $why = [
            ['icon' => 'phosphor-shield-check', 'title' => 'Holistic Approach',   'description' => 'We consider every dimension — environmental, social, economic, and regulatory — to deliver integrated solutions.'],
            ['icon' => 'phosphor-users',         'title' => 'Community Builders',  'description' => 'Authentic public engagement that gives residents and municipalities a genuine voice in planning outcomes.'],
            ['icon' => 'phosphor-arrows-out',    'title' => 'Scalable Expertise',  'description' => 'From a single development permit to an entire neighbourhood, the same depth at every scale.'],
            ['icon' => 'phosphor-buildings',     'title' => 'Municipal Insight',   'description' => 'Deep experience within municipalities means we understand the processes, policies, and people that drive decisions.'],
        ];
        foreach ($why as $i => $data) {
            WhyCard::create(array_merge($data, ['sort_order' => $i + 1]));
        }
    }
}
