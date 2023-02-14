<x-layout>
    @extends('layout.app')
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10 pb-10">
            <div class="col-span-12 lg:text-center lg:pt-14 mb-10">
                <div id="carouselExampleIndicators" class="carousel slide relative" data-bs-ride="carousel">
                    <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                        <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                            @for($i=0; $i < $post->images->count(); $i++)
                                <button
                                    type="button"
                                    data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{$i}}"
                                    class="{{$i == 0 ? 'active' : ''}}"
                                    aria-current="true"
                                    aria-label="Slide {{$i+1}}"
                                ></button>
                            @endfor
                        </div>
                    </div>
                    <div class="carousel-inner relative w-full overflow-hidden">
                        @foreach($post->images as $image)
                            <div
                                class="carousel-item {{ $image->id == $post->images->first()->id ? 'active' : '' }} float-left w-full align-center">
                                <img
                                    src="{{ asset('storage/posts/images/'.$image->uuid.'.'.$image->extension) }}"
                                    class="block d-flex justify-content-center"
                                    style="max-height: 450px !important; width: auto; margin: 0 auto;"
                                />
                            </div>
                        @endforeach
                    </div>
                    <button
                        class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev"
                    >
                        <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next"
                    >
                        <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p class="mt-4 block text-gray-400 text-xs">
                    Published
                    <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>
            </div>
            <div class="col-span-12 md:col-span-8">
                <h1 class="font-bold text-3xl lg:text-4xl mb-1">
                    {{ $post->title }}
                    <x-category-button :category="$post->category"/>
                </h1>
                <div class="space-y-18 lg:text-lg leading-loose">
                    <h2 class="text-primary">RM {{ $post->price }}</h2>
                    <p><br/>{{ $post->body}}</p>
                </div>
            </div>
            @auth()
                @if(Auth::user()->id == $post->user_id)
                    <div class="md:col-span-4 text-left flex flex-row">
                        <a href="/posts/{{$post->uuid}}/edit" class="btn rounded-pill me-2">
                            <img src="/images/setting.png" alt="" width="80" height="80">
                        </a>
                        <form action="/posts/{{$post->uuid}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill">
                                <img src="/images/delete.png" alt="" width="80" height="80">
                            </button>
                        </form>
                    </div>
                @else
                    <div class="md:col-span-4 text-left flex flex-col">
                        <div class="flex items-center lg:justify-left text-sm mt-4">
                            <img src="/images/lary-head.svg" alt="" width="20" height="16">
                            <div class="ml-3 text-left">
                                <h5 class="font-bold">{{ $post->author->name }}</h5>
                            </div>
                        </div>
                        <div class="flex items-center lg:justify-left text-sm mt-4">
                            <img src="/images/email.svg" alt="" width="20" height="16">
                            <div class="ml-3 text-left">
                                <h5 class="font-bold">{{ $post->author->email }}</h5>
                            </div>
                        </div>
                        <div class="flex items-center lg:justify-left text-sm mt-4">
                            <img src="/images/mobile.svg" alt="" width="20" height="16">
                            <div class="ml-3 text-left">
                                <h5 class="font-bold">{{ $post->author->mobile }}</h5>
                            </div>
                        </div>
                        <div class="flex items-center lg:justify-left text-sm mt-4">
                            <a href="https://wa.me/{{$post->author->mobile}}?text=Hi %F0%9F%98%87! I'm%20interested%20in%20your%20item: {{urlencode($post->title)}}"
                               target="_blank">
                                <img src="/images/whatsapp.png" alt="" width="50" height="50">
                            </a>
                            &nbsp;&nbsp;
                            <a href="mailto:{{ $post->author->email }}" target="_blank">
                                <img src="/images/email.png" alt="" width="50" height="50">
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <div class="md:col-span-4 text-left flex flex-row">
                    <div class="flex items-center lg:justify-left text-sm mt-4">
                        <div class="ml-3 text-left">
                            <a href="/login?redirect={{Request::url()}}">
                                <h5 class="font-bold">Login to view seller details!</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endauth
        </article>
    </main>
</x-layout>
