<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntryCategoryResource;
use App\Models\Journal\Entry;
use App\Models\Journal\EntryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Journal/Index', [
            'entries' => Entry::all(),
        ]);
    }

    public function create(Request $request)
    {
        $categories = EntryCategory::all();
        return Inertia::render('Journal/Create', [
            'categories' => EntryCategoryResource::collection($categories)
        ]);
    }

    public function store(Request $request, Entry $entry)
    {
        $entry->title = $request->title;
        $entry->entry_categories_id = $request->category;
        $entry->content = $request->content;
        $entry->save();

        return redirect()->route('journal.index')->with('success', 'Entry added!');
    }
}
