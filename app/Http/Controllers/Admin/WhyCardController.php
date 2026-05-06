<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyCard;
use Illuminate\Http\Request;

class WhyCardController extends Controller
{
    public function index()
    {
        return view('admin.cms.why.index', [
            'cards' => WhyCard::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.cms.why.create');
    }

    public function store(Request $request)
    {
        WhyCard::create($request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]));

        return to_route('admin.why.index');
    }

    public function edit(WhyCard $why)
    {
        return view('admin.cms.why.edit', compact('why'));
    }

    public function update(Request $request, WhyCard $why)
    {
        $why->update($request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]));

        return to_route('admin.why.index');
    }

    public function destroy(WhyCard $why)
    {
        $why->delete();

        return to_route('admin.why.index');
    }

    public function reorder(Request $request, WhyCard $why)
    {
        $direction = $request->validate(['direction' => ['required', 'in:up,down']])['direction'];

        $swap = $direction === 'up'
            ? WhyCard::where('sort_order', '<', $why->sort_order)->orderByDesc('sort_order')->first()
            : WhyCard::where('sort_order', '>', $why->sort_order)->orderBy('sort_order')->first();

        if ($swap) {
            [$why->sort_order, $swap->sort_order] = [$swap->sort_order, $why->sort_order];
            $why->save();
            $swap->save();
        }

        return to_route('admin.why.index');
    }
}
