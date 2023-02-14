<x-layout>
    @include('_posts-header')
    <main class="max-w-5xl mx-auto mt-6 lg:mt-5 space-y-6">
        @if ($posts->count())
            <div class="lg:grid lg:grid-cols-4 ">
                @foreach($posts as $post)
                    <x-post-card :post="$post"/>
                @endforeach
            </div>
        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif
    </main>
</x-layout>
