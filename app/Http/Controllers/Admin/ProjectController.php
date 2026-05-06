<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.cms.projects.index', [
            'projects' => Project::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.cms.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_file' => ['nullable', 'image', 'max:4096'],
            'image_url'  => ['nullable', 'url', 'max:500'],
            'category'   => ['required', 'string', 'max:100'],
            'title'      => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $data['image'] = $this->resolveImage($request);
        unset($data['image_file'], $data['image_url']);

        Project::create($data);

        return to_route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        return view('admin.cms.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'image_file'  => ['nullable', 'image', 'max:4096'],
            'image_url'   => ['nullable', 'url', 'max:500'],
            'category'    => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $newImage = $this->resolveImage($request, $project->image);
        $data['image'] = $newImage;
        unset($data['image_file'], $data['image_url']);

        $project->update($data);

        return to_route('admin.projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index');
    }

    public function reorder(Request $request, Project $project)
    {
        $direction = $request->validate(['direction' => ['required', 'in:up,down']])['direction'];

        $swap = $direction === 'up'
            ? Project::where('sort_order', '<', $project->sort_order)->orderByDesc('sort_order')->first()
            : Project::where('sort_order', '>', $project->sort_order)->orderBy('sort_order')->first();

        if ($swap) {
            [$project->sort_order, $swap->sort_order] = [$swap->sort_order, $project->sort_order];
            $project->save();
            $swap->save();
        }

        return to_route('admin.projects.index');
    }

    private function resolveImage(Request $request, ?string $existing = null): ?string
    {
        if ($request->hasFile('image_file')) {
            if ($existing && ! str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            return $request->file('image_file')->store('projects', 'public');
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return $existing;
    }
}
