<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        return view('admin.cms.team.index', [
            'members' => TeamMember::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.cms.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'years'      => ['required', 'string', 'max:50'],
            'skills'     => ['required', 'string'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'image_url'  => ['nullable', 'url', 'max:500'],
        ]);

        $data['skills'] = $this->parseSkills($data['skills']);
        $data['image']  = $this->resolveImage($request);
        unset($data['image_file'], $data['image_url']);

        TeamMember::create($data);

        return to_route('admin.team.index');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.cms.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'years'      => ['required', 'string', 'max:50'],
            'skills'     => ['required', 'string'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'image_url'  => ['nullable', 'url', 'max:500'],
        ]);

        $data['skills'] = $this->parseSkills($data['skills']);
        $data['image']  = $this->resolveImage($request, $team->image);
        unset($data['image_file'], $data['image_url']);

        $team->update($data);

        return to_route('admin.team.index');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();

        return to_route('admin.team.index');
    }

    public function reorder(Request $request, TeamMember $team)
    {
        $direction = $request->validate(['direction' => ['required', 'in:up,down']])['direction'];

        $swap = $direction === 'up'
            ? TeamMember::where('sort_order', '<', $team->sort_order)->orderByDesc('sort_order')->first()
            : TeamMember::where('sort_order', '>', $team->sort_order)->orderBy('sort_order')->first();

        if ($swap) {
            [$team->sort_order, $swap->sort_order] = [$swap->sort_order, $team->sort_order];
            $team->save();
            $swap->save();
        }

        return to_route('admin.team.index');
    }

    private function resolveImage(Request $request, ?string $existing = null): ?string
    {
        if ($request->hasFile('image_file')) {
            if ($existing && ! str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            return $request->file('image_file')->store('team', 'public');
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return $existing;
    }

    private function parseSkills(string $raw): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }
}
