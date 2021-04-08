<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareRequest;
use App\Mail\Share;
use App\Models\Note;
use App\Models\NoteSharedToUser;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ShareController extends Controller
{
    /**
     * Display share form.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('share', [
            'notes' => Note::query()
                ->select(['id'])
                ->where('user_id', '=', Auth::id())
                ->where('public', '0')
                ->orderBy('updated_at', 'DESC')
                ->limit(200)
                ->get()
        ]);
    }

    /**
     * Share with user if user exists.
     *
     * @param ShareRequest $request
     * @return RedirectResponse
     */
    public function share(ShareRequest $request)
    {
        $validated = $request->validated();

        /** @var Note $note */
        $note = Note::query()->select('id')->where('id', $validated['note'])->first();
        $user = User::query()->select('id')->where('email', $validated['email'])->first();

        $share = new NoteSharedToUser();
        $share->setRawAttributes([
            'note_id' => $note->id,
            'user_id' => $user->id
        ]);
        $share->save();

        Mail::to($validated['email'])->send(new Share($validated['note']));

        $request->session()->flash('shareStatus', "Shared with {$validated['email']} !");
        return Redirect::to(route('share'));
    }
}
