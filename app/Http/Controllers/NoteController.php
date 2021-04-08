<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('notes.list', [
            'notes' => Note::query()
                ->select(['id', 'user_id', 'content'])
                ->with('user:id,name')
                ->where('public', '=', true)
                ->orderBy('updated_at', 'DESC')
                ->paginate(4)
        ]);
    }

    /**
     * Display a listing of the resource created by user.
     *
     * @return Application|Factory|View|Response
     */
    public function myIndex()
    {
        return view('notes.my', [
            'notes' => Note::query()
                ->select(['id', 'user_id', 'content', 'public'])
                ->with('user:id,name')
                ->where('user_id', '=', Auth::id())
                ->orderBy('updated_at', 'DESC')
                ->paginate(4)
        ]);
    }

    /**
     * Display a listing of the resource shared to user.
     *
     * @return Application|Factory|View|Response
     */
    public function sharedIndex()
    {
        return view('notes.toMe', [
            'notes' => Note::query()
                ->select(['id', 'user_id', 'content', 'public'])
                ->with('user:id,name')
                ->whereHas('shares', function (Builder $query) {
                    $query->where('user_id', '=', Auth::id());
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('notes.create', ['url' => route('note-store')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNoteRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNoteRequest $request)
    {
        $validated = $request->validated();

        $note = new Note();
        $note->user_id = Auth::id();
        $note->public = $validated['public'];
        $note->content = $validated['content'];
        $note->save();

        return Redirect::to(route('note', ['note' => $note->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Note $note
     * @return Application|Factory|View|Response
     */
    public function show(Note $note)
    {
        Gate::authorize('view-note', $note);

        return view('notes.note', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Note $note
     * @return Application|Factory|View|Response
     */
    public function edit(Note $note)
    {
        return view('notes.create', [
            'url' => route('note-update', ['note' => $note->id]),
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $request
     * @param \App\Models\Note $note
     * @return RedirectResponse|Response
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $validated = $request->validated();

        $note->public = $validated['public'];
        $note->content = $validated['content'];
        $note->save();

        return Redirect::to(route('note-edit', ['note' => $note->id]));
    }
}
