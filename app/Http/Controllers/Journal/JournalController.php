<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntryCategoryResource;
use App\Http\Resources\EntryResource;
use App\Models\Journal\Entry;
use App\Models\Journal\EntryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $entries = Entry::query()
                ->where(function($query) use($request) {
                    $query->where('title', 'LIKE', '%'. $request->search .'%')
                        ->orWhere('content', 'LIKE', '%'. $request->search .'%');
                })
                ->get();
        //policy to only allow me to post
        return Inertia::render('Journal/Index', [
            'entries' => EntryResource::collection($entries),
            'filters' => [
                'search' => $request->search ?? null,
            ],
        ]);
    }

    public function create(Request $request)
    {
        $categories = EntryCategory::all();

        return Inertia::render('Journal/Create', [
            'categories' => EntryCategoryResource::collection($categories),
            'title' => $request->title ?? null,
        ]);
    }

    public function store(Request $request, Entry $entry)
    {
        //todo validation
        $entry->title = $request->title;
        $entry->entry_categories_id = $request->category;
        $entry->content = $request->content;
        $entry->save();

        return redirect()->route('journal.index')->with('success', 'Entry added!');
    }
}
