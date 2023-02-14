<header class="max-w-xl mx-auto mt-7 text-center">
    <div class="space-y-2 lg:space-y-0 lg:space-x-8 mt-5">
        <div class="relative lg:inline-flex bg-gray-100 px-2 py-2" style="border: 2px solid black">
            <div x-data="{ show:false }" @click.away="show = false">
                <button
                    @click="show = !show"
                    class="py-1 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
                    {{ isset($currentCategory) ? ucwords($currentCategory->name) :
                    'Categories' }}
                    <svg class="transform -rotate-90 absolute pointer-events-none"
                         style="right: 12px;" width="22" height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012"
                                  stroke-width=".5" d="M21 1v20.16H.84V1z"></path>
                            <path fill="#222"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                        </g>
                    </svg>
                </button>
                <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl w-full z-50"
                     style="display: none">
                    <a href="/"
                       class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus"
                    >
                        All
                    </a>
                    @foreach($categories as $category)
                        <a href="/categories/{{ $category->slug }}"
                           class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'bg-blue-500 text-white' : '' }}">
                            {{ ucwords($category->name) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="relative flex lg:inline-flex items-center bg-gray-100 px-3 py-2" style="border: 2px solid black">
            <form method="GET" action="#">
                <input type="text" name="search" placeholder="Find"
                       class="bg-transparent placeholder-black font-semibold text-sm"
                       value="{{ request('search') }}">
            </form>
        </div>
        <div class="relative flex lg:inline-flex items-center bg-gray-100 px-3 py-2" style="border: 2px solid black">
            <form action="{{ route('sort_posts') }}" method="GET">
                <select class="bg-transparent placeholder-black font-semibold text-sm" name="sort"
                        onchange="this.form.submit()">
                    <option>Sort Posts</option>
                    <option value="asc">Oldest first</option>
                    <option value="desc">Newest first</option>
                </select>
            </form>
        </div>
    </div>
</header>
