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
        $user = $request->user();
        $entries = Entry::query()
                ->with(['category'])
                ->where(function($query) use($request) {
                    $query->where('title', 'LIKE', '%'. $request->search .'%')
                        ->orWhere('content', 'LIKE', '%'. $request->search .'%');
                })
                ->when($user && $user->email !== 'erickokkuan@gmail.com', function($query) {
                    $query->whereRelation('category', 'name', '!=', 'Personal');
                })
                ->when(!$user, function($query) {
                    $query->whereRelation('category', 'name', '!=', 'Personal');
                })
                ->orderByDesc('created_at')
                ->get();

        return Inertia::render('Journal/Index', [
            'entries' => EntryResource::collection($entries),
            'categories' => EntryCategoryResource::collection(EntryCategory::all()),
            'filters' => [
                'search' => $request->search ?? null,
            ],
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Journal/Create', [
            'categories' => EntryCategoryResource::collection(EntryCategory::all()),
            'title' => $request->title ?? null,
        ]);
    }

    public function store(Request $request, Entry $entry)
    {
        abort_if(!$request->user() || $request->user()->email !== 'erickokkuan@gmail.com', 403, 'Only owner can submit an entry');
        //todo validation
        $entry->title = $request->title;
        $entry->entry_categories_id = $request->category;
        $entry->content = $request->content;
        $entry->save();

        return redirect()->route('journal.index')->with('success', 'Entry added!');
    }

    public function edit(Request $request, Entry $entry)
    {
        return Inertia::render('Journal/Edit', [
            'entry' => $entry->load('category'),
            'categories' => EntryCategoryResource::collection(EntryCategory::all()),
            'filters' => [
                'search' => $request->search ?? null,
            ],
        ]);
    }

    public function update(Request $request, Entry $entry)
    {
        // abort_if(!$request->user() || $request->user()->email !== 'erickokkuan@gmail.com', 403, 'Only owner can update an entry');
        //todo validation
        $entry->update([
           'title' => $request->title,
           'entry_categories_id' => $request->category_id,
           'content' => $request->content,
        ]);

        return redirect()->route('journal.edit', $entry->id)->with('success', 'Entry added!');
    }

    public function destroy(Request $request, Entry $entry)
    {
        $entry->delete();

        return redirect()->route('journal.index')->with('success', 'Entry deleted!');
    }
}
