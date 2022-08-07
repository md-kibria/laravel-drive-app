<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa fa-star"></i></span> Bookmarks
    </h2>

    <div class="mt-14 md:ml-10">
    <div class="lg:w-2/3">
        
        @php
            $docArr = array();

            foreach($bms as $bm) {
                if($bm->user_id == Request::query('user')) {
                    array_push($docArr, $bm->doc);
                }
            }
        @endphp
        
        @if(count($docArr))
            @foreach ($docArr as $doc)
                <!-- Single Document -->
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
            @endforeach
        @else
            <p class="text-slate-600">No have not any bookmark!</p>
        @endif


        {{-- <div class="mt-6 p-4">
            {{$docs->links()}}
        </div> --}}

    </div>
    </div>
</x-layout>