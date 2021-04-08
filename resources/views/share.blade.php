<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Share') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0">
                    <form method="POST" action="{{route('share-process')}}">
                        @csrf

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-12">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="text" name="email" id="email"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-12">
                                        <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                                        <select id="note" name="note"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach($notes as $note)
                                                <option value="{{$note->id}}">{{$note->id}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="px-4 py-5 bg-red-400 sm:p-6">
                                    <ul class="pt-4">
                                        @foreach ($errors->all() as $error)
                                            <li class="pb-4 font-bold text-black">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif (session('shareStatus'))
                                <div class="px-4 py-5 bg-green-400 sm:p-6">
                                    <p class="font-bold text-black">{{ session('shareStatus') }}</p>
                                </div>
                            @endif

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
