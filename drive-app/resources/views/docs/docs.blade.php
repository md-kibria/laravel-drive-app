<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        @if (Auth::check() && request()->user == auth()->user()->id)
            <span class="text-4xl"><i class="fa far fa-plus-square"></i></span> Your documents
        @elseif (request()->user) 
            <span class="text-4xl"><i class="fa far fa-plus-square"></i></span> Users documents
        @else
            <span class="text-4xl"><i class="fa far fa-plus-square"></i></span> All documents
        @endif
    </h2>

    <div class="mt-14 md:ml-10">
    <div class="lg:w-2/3">

        @if($docs->count())
            @foreach ($docs as $doc)
                <!-- Single Document -->
                @if(request()->get('user'))
                    @if(request()->get('user') != auth()->user()->id)
                        @if($doc->privacy != 'private')
                        <div class="border border-slate-500 p-5 my-4 rounded">
                            <a href="/docs/{{$doc->id}}">
                                <h2 class="text-2xl">{{ $doc->title }}</h2>
                            </a>
                            <span class="text-gray-500">
                                by <a class="underline" href="/users/{{$doc->user->id}}">{{$doc->user->name}}</a>
                                , on {{ $doc->created_at }}</span>
                                {{-- on 7 Jun, 2022  --}}
                            <p class="text-slate-800 mt-1">{{ substr($doc->desc, 0, 245) }}...</p>
                            <div class="mt-2">
                                <ul class="flex justify-end">
                                    <li class="text-xl mx-1 text-slate-900">
                                        
                                        {{-- <form action="/bookmarks?doc={{ $doc->id }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <button type="submit">
                                                <i class="fa far fa-star-o"></i>
                                            </button>
                                        </form>
                                        <form action="/bookmarks/{{ $bookmark }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="fa far fa-star"></i>
                                            </button>
                                        </form> --}}
                                    </li>
                                    @if ($doc->privacy == 'public')
                                    <form action="/docs/{{ $doc->id }}" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <input type="hidden" name="privacy" value="private">
                                        <input type="hidden" name="title" value="{{ $doc->title }}">
                                        <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                        <button type="submit" class="text-xl mx-1 text-green-500">
                                            <i class="fa fa-globe"></i>
                                        </button>
                                    </form>
                                    
                                    @else
                                    <form action="/docs/{{ $doc->id }}" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <input type="hidden" name="privacy" value="public">
                                        <input type="hidden" name="title" value="{{ $doc->title }}">
                                        <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                        <button type="submit" class="text-xl mx-1 text-red-500">
                                            <i class="fa fa-eye-slash"></i>
                                        </button>
                                    </form>
                                    {{-- <li class="text-xl mx-1 text-red-500">
                                        <i class="fa fa-eye-slash"></i>
                                    </li> --}}
                                    @endif
                                    <a class="text-xl mx-1 text-yellow-600" href="/docs/{{$doc->id}}/edit">
                                        <i class="fa far fa-edit"></i>
                                    </a>
                                    <form action="/docs/{{$doc->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xl mx-1 text-red-500">
                                            <i class="fa far fa-trash"></i>
                                        </button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                        @endif
                    @else
                    <div class="border border-slate-500 p-5 my-4 rounded">
                        <a href="/docs/{{$doc->id}}">
                            <h2 class="text-2xl">{{ $doc->title }}</h2>
                        </a>
                        <span class="text-gray-500">
                            by <a class="underline" href="/users/{{$doc->user->id}}">{{$doc->user->name}}</a>
                            , on {{ $doc->created_at }}</span>
                            {{-- on 7 Jun, 2022  --}}
                        <p class="text-slate-800 mt-1">{{ substr($doc->desc, 0, 245) }}...</p>
                        <div class="mt-2">
                            <ul class="flex justify-end">
                                <li class="text-xl mx-1 text-slate-900">
                                    
                                    {{-- <form action="/bookmarks?doc={{ $doc->id }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button type="submit">
                                            <i class="fa far fa-star-o"></i>
                                        </button>
                                    </form>
                                    <form action="/bookmarks/{{ $bookmark }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa far fa-star"></i>
                                        </button>
                                    </form> --}}
                                </li>
                                @if ($doc->privacy == 'public')
                                <form action="/docs/{{ $doc->id }}" method="post">
                                    @csrf 
                                    @method('PUT')
                                    <input type="hidden" name="privacy" value="private">
                                    <input type="hidden" name="title" value="{{ $doc->title }}">
                                    <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                    <button type="submit" class="text-xl mx-1 text-green-500">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                </form>
                                
                                @else
                                <form action="/docs/{{ $doc->id }}" method="post">
                                    @csrf 
                                    @method('PUT')
                                    <input type="hidden" name="privacy" value="public">
                                    <input type="hidden" name="title" value="{{ $doc->title }}">
                                    <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                    <button type="submit" class="text-xl mx-1 text-red-500">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>
                                </form>
                                {{-- <li class="text-xl mx-1 text-red-500">
                                    <i class="fa fa-eye-slash"></i>
                                </li> --}}
                                @endif
                                <a class="text-xl mx-1 text-yellow-600" href="/docs/{{$doc->id}}/edit">
                                    <i class="fa far fa-edit"></i>
                                </a>
                                <form action="/docs/{{$doc->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xl mx-1 text-red-500">
                                        <i class="fa far fa-trash"></i>
                                    </button>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <!--!! Single Document !!-->
                    @endif
                    <!--!! Single Document !!-->
                @else

                <div class="border border-slate-500 p-5 my-4 rounded">
                    <a href="/docs/{{$doc->id}}">
                        <h2 class="text-2xl">{{ $doc->title }}</h2>
                    </a>
                    <span class="text-gray-500">
                        by <a class="underline" href="/users/{{$doc->user->id}}">{{$doc->user->name}}</a>
                        , on {{ $doc->created_at }}</span>
                        {{-- on 7 Jun, 2022  --}}
                    <p class="text-slate-800 mt-1">{{ substr($doc->desc, 0, 245) }}...</p>
                    <div class="mt-2">
                        <ul class="flex justify-end">
                            <li class="text-xl mx-1 text-slate-900">
                                
                                {{-- <form action="/bookmarks?doc={{ $doc->id }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit">
                                        <i class="fa far fa-star-o"></i>
                                    </button>
                                </form>
                                <form action="/bookmarks/{{ $bookmark }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa far fa-star"></i>
                                    </button>
                                </form> --}}
                            </li>
                            @if ($doc->privacy == 'public')
                            <form action="/docs/{{ $doc->id }}" method="post">
                                @csrf 
                                @method('PUT')
                                <input type="hidden" name="privacy" value="private">
                                <input type="hidden" name="title" value="{{ $doc->title }}">
                                <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                <button type="submit" class="text-xl mx-1 text-green-500">
                                    <i class="fa fa-globe"></i>
                                </button>
                            </form>
                            
                            @else
                            <form action="/docs/{{ $doc->id }}" method="post">
                                @csrf 
                                @method('PUT')
                                <input type="hidden" name="privacy" value="public">
                                <input type="hidden" name="title" value="{{ $doc->title }}">
                                <input type="hidden" name="desc" value="{{ $doc->desc }}">
                                <button type="submit" class="text-xl mx-1 text-red-500">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </form>
                            {{-- <li class="text-xl mx-1 text-red-500">
                                <i class="fa fa-eye-slash"></i>
                            </li> --}}
                            @endif
                            <a class="text-xl mx-1 text-yellow-600" href="/docs/{{$doc->id}}/edit">
                                <i class="fa far fa-edit"></i>
                            </a>
                            <form action="/docs/{{$doc->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xl mx-1 text-red-500">
                                    <i class="fa far fa-trash"></i>
                                </button>
                            </form>
                        </ul>
                    </div>
                </div>
                <!--!! Single Document !!-->
                @endif
            @endforeach
        @else 
            <p class="text-slate-600">No document available!</p>
        @endif


        <div class="mt-6 p-4">
            {{$docs->links()}}
        </div>

    </div>
    </div>
</x-layout>