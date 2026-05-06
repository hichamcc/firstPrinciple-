<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.cms.services.index', [
            'services' => Service::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.cms.services.create');
    }

    public function store(Request $request)
    {
        Service::create($request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]));

        return to_route('admin.services.index');
    }

    public function edit(Service $service)
    {
        return view('admin.cms.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]));

        return to_route('admin.services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return to_route('admin.services.index');
    }

    public function reorder(Request $request, Service $service)
    {
        $direction = $request->validate(['direction' => ['required', 'in:up,down']])['direction'];

        $swap = $direction === 'up'
            ? Service::where('sort_order', '<', $service->sort_order)->orderByDesc('sort_order')->first()
            : Service::where('sort_order', '>', $service->sort_order)->orderBy('sort_order')->first();

        if ($swap) {
            [$service->sort_order, $swap->sort_order] = [$swap->sort_order, $service->sort_order];
            $service->save();
            $swap->save();
        }

        return to_route('admin.services.index');
    }
}
