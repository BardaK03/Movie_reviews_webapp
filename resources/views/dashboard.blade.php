<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">{{ __("Your Reviews") }}</h3>

                    @if($reviews->isEmpty())
                        <p>{{ __("You haven't written any reviews yet.") }}</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($reviews as $review)
                                <li class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __("Movie:") }}</strong> {{ $review->movie->name }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __("Rating:") }}</strong> {{ $review->rating }} / 5
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __("Comment:") }}</strong> {{ $review->comment }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
