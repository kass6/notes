<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Note') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0">
                    <form method="POST" action="{{$url}}">
                        @csrf

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-12">
                                        <label for="public"
                                               class="block text-sm font-medium text-gray-700">Visibility</label>
                                        <select id="public" name="public"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="0" @if(isset($note) && $note->public == 0) selected @endif>Private</option>
                                            <option value="1" @if(isset($note) && $note->public == 1) selected @endif>Public</option>
                                        </select>
                                    </div>

                                    <div class="col-span-12">
                                        <label for="content" class="block text-sm font-medium text-gray-700">
                                            Content
                                        </label>
                                        <div class="mt-1">
                                            <textarea id="content" name="content" rows="3"
                                                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                                      placeholder="some text">{{ $note->content ?? '' }}</textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">
                                            You can use markdown. Not all styles presents, but **works perfectly**
                                        </p>
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
