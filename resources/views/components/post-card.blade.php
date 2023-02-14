@props(['post'])
<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div
        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 pb-5">
        <a href="#">
            <img class="rounded-t-lg"
                 src="{{ asset('storage/posts/images/'.$post->images->first()->uuid.'.'.$post->images->first()->extension) }}"
                 alt="product image" style="height: 200px;"/>
        </a>
        <div class="px-2">
            <a href="#">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
            </a>
            <div class="flex items-center justify-between">
                <span class="text-xl font-bold text-gray-900 dark:text-white">MYR {{ $post->price }}</span>
                <a href="/posts/{{ $post->uuid }}"
                   class="text-white focus:ring-4 focus:outline-none font-small rounded-lg text-sm px-5 py-2.5 text-center {{ \Illuminate\Support\Facades\Auth::user() != null && \Illuminate\Support\Facades\Auth::user()->id == $post->user->id ? 'dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 bg-red-700 hover:bg-red-800 focus:ring-red-300' : 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800' }}">{{ \Illuminate\Support\Facades\Auth::user() != null && \Illuminate\Support\Facades\Auth::user()->id == $post->user->id ? 'Manage' : 'More' }}</a>
            </div>
            <div class="flex items-center mt-2.5 mb-5">
                <span class="mt-2 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </span>
            </div>
        </div>
        <footer>
            <div class="space-x-1">
                <x-category-button :category="$post->category"/>
            </div>
        </footer>
    </div>
</article>
