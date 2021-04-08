<div class="relative bg-white">
    <dt>
        <p class="m-4 mb-2 text-lg leading-6 font-medium text-gray-900">
            {{ $note->user->name }}
            @if ($note->public === 0)
                <span class="font-black text-red-700">Private</span>
            @endif
        </p>
    </dt>
    <dd class="m-4 mt-0 mb-2 text-base text-gray-500">
        {!! Markdown::convertToHtml($note->content) !!}
    </dd>
    <div class="m-4 mt-0 text-base">
        <a href="{{route('note', ['note' => $note->id])}}" class="font-bold text-purple-900">Open</a>
    </div>
    @if ($note->user->id === Auth::id())
        <div class="m-4 mt-0 text-base">
            <a href="{{route('note-edit', ['note' => $note->id])}}" class="font-bold text-purple-900">Edit</a>
        </div>
    @endif
</div>
