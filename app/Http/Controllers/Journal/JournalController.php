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
                ->when($user && $user->email !== config('mail.personal.email'), function($query) {
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
        abort_if(!$request->user() || $request->user()->email !== config('mail.personal.email'), 403, 'Only owner can create an entry');
        
        $entry = new Entry();
        $entry->user_id = $request->user()->id;
        $entry->entry_categories_id = 1;
        $entry->is_draft = true;
        $entry->title = $request->title ?? null;
        $entry->save();

        return Inertia::render('Journal/Create', [
            'entry' => $entry->load('category'),
            'categories' => EntryCategoryResource::collection(EntryCategory::all()),
            'title' => $request->title ?? null,
        ]);
    }

    public function store(Request $request, Entry $entry)
    {
        abort_if(!$request->user() || $request->user()->email !== config('mail.personal.email'), 403, 'Only owner can submit an entry');
        //todo validation
        $entry->title = $request->title;
        $entry->entry_categories_id = data_get($request->category, 'id');
        $entry->content = $request->content;
        $entry->is_draft = true;
        $entry->user_id = $request->user()->id;
        $entry->save();

        return redirect()->route('journal.index')->with('success', 'Entry added!');
    }

    public function edit(Request $request, Entry $entry)
    {
        abort_if(!$request->user() || $request->user()->email !== config('mail.personal.email'), 403, 'Only owner can edit an entry');

        return Inertia::render('Journal/Create', [
            'entry' => $entry->load('category'),
            'categories' => EntryCategoryResource::collection(EntryCategory::all()),
            'filters' => [
                'search' => $request->search ?? null,
            ],
        ]);
    }

    public function update(Request $request, Entry $entry)
    {
        abort_if(!$request->user() || $request->user()->email !== config('mail.personal.email'), 403, 'Only owner can update an entry');
        //todo validation
        $entry->update([
           'title' => $request->title,
           'entry_categories_id' => $request->category_id,
           'content' => $request->content,
           'is_draft' => $request->is_draft,
        ]);

        return redirect()->route('journal.edit', $entry->id)->with('success', 'Entry added!');
    }

    public function destroy(Request $request, Entry $entry)
    {
        abort_if(!$request->user() || $request->user()->email !== config('mail.personal.email'), 403, 'Only owner can delete an entry');

        $entry->delete();

        return redirect()->route('journal.index')->with('success', 'Entry deleted!');
    }
}
