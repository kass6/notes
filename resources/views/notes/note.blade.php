<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Public Notes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-1 md:gap-x-8 md:gap-y-10">

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
                    @if ($note->user->id === Auth::id())
                        <div class="m-4 mt-0 text-base">
                            <a href="{{route('note-edit', ['note' => $note->id])}}" class="font-bold text-purple-900">Edit</a>
                        </div>
                    @endif
                </div>

            </dl>
        </div>
    </div>
</x-app-layout>
