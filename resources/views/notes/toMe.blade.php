<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shared to me Notes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (!empty($notes))
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    @each('components.note', $notes, 'note')
                </dl>

                @if ($notes->hasPages())
                    <dl class="space-y-20 mt-10">
                        <div class="px-4 py-3 bg-gray-50 sm:px-6">
                            {{ $notes->links() }}
                        </div>
                    </dl>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
