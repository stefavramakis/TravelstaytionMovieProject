@extends('layouts.app')

@section('title', 'All Movies')

@section('content')
    <div class="flex justify-between align-items-center mb-4 mt-10 px-32">
        <div>Movie World</div>
        <div>
            <div class="flex items-center justify-end gap-1">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] leading-normal">
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-  border-on-hover border-on-hover:hover text-[#328da8] hover:text-[#ffffff]  leading-normal ">
                        Log In
                    </a>
                    <div>
                        or
                    </div>
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block signup-button leading-normal">
                            Sign Up
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="mb-2">
        Found {{ $movies->count() }} movies
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @foreach ($movies as $movie)
            <div style="
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 15px;
                position: relative;
                background-color: #f9f9f9;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            ">
                <!-- Top bar -->
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <strong>{{ $movie->title }}</strong>
                    <span style="font-size: 0.9em;">
                        Posted {{ $movie->created_at->format('d/m/Y') }}
                    </span>
                </div>

                <!-- Description -->
                <div style="margin-bottom: 15px;">
                    <p style="font-size: 0.95em; color: #333;">
                        {{ $movie->description }}
                    </p>
                </div>

                <!-- Bottom bar -->
                <div style="display: flex; justify-content: space-between; font-size: 0.9em;">
                    <div>
                        @auth
                            <form action="{{ route('movies.react', ['movie' => $movie->id, 'type' => 'like']) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                        style="background:none; border:none; color:#00acee; cursor:pointer;">
                                    {{ $movie->getLikesCount() }} likes
                                </button>
                            </form>
                            |
                            <form action="{{ route('movies.react', ['movie' => $movie->id, 'type' => 'hate']) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                        style="background:none; border:none; color:#e74c3c; cursor:pointer;">
                                    {{ $movie->getHatesCount() }} hates
                                </button>
                            </form>
                        @else
                            {{ $movie->getLikesCount() }} likes | {{ $movie->getHatesCount() }} hates
                        @endauth
                    </div>
                    <div>
                        Posted by <span style="color: #00acee;">{{ $movie->user->name ?? 'Unknown' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
<style>
    .border-on-hover {
        border: none;
        color: #00acee;
        font-weight: 500;

        /*transition: border 0.3s ease;*/
    }

    .border-on-hover:hover {
        border: 2px solid #00acee; /* Bootstrap primary blue */
        border-radius: 5px;
        font-weight: 500;

    }

    .signup-button {
        background-color: #00acee;
        color: #ffffff;
        border: 1px solid #0a0a0a;
        font-weight: 500;
        padding: 2px 25px 2px 25px;
        border-radius: 10px;
        text-decoration: none;
    }
</style>
