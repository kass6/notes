<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0">
                    <form method="GET" action="{{route('search')}}">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-12">
                                        <label for="search"
                                               class="block text-sm font-medium text-gray-700">Search</label>
                                        <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Search
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            @if (!empty($notes))
                <dl class="pt-10 space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
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
