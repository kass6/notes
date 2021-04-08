<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * Display share form.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $notes = Note::query()
                ->select(['id', 'user_id', 'content', 'public'])
                ->with('user:id,name')
                ->where('content', 'LIKE', "%{$request->get('search')}%")
                ->where('public', '1')
                ->orderBy('updated_at', 'DESC')
                ->paginate(4)
                ->appends($request->except(['page']));
        } else {
            $notes = null;
        }

        return view('search', [
            'search' => $request->get('search'),
            'notes' => $notes
        ]);
    }
}
