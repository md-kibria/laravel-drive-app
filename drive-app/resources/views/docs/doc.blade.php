<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa fa-file"></i></span> Document
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->

        <!-- Single Document -->
        <div class="border border-slate-500 p-5 my-4 rounded">

            {{-- <a href="./doc.html"> --}}
                <h2 class="text-2xl">{{ $doc->title }}</h2>
            {{-- </a> --}}
            <span class="text-gray-500">
                by <a class="underline" href="/users/{{$doc->user->id}}">{{$doc->user->name}}</a>
                , on {{ $doc->created_at }}</span>
                {{-- on 7 Jun, 2022  --}}
            <p class="text-slate-800 mt-2">{{ $doc->desc }}</p>
            <div class="flex items-end justify-between">
                <ul class="flex mb-5 mt-10">
                    @if ($doc->file)
                    <li class=" mx-3 flex flex-col relative">
                        <a href="/storage/{{$doc->file}}" target="_blank">
                            <span class="absolute h-5 w-5 bg-gray-200 flex items-center justify-center rounded-full -top-2 -left-2 ring-1 ring-indigo-500 text-indigo-500">1</span>
                            @if (substr(strrev($doc->file), 0, 3) == 'gpj')
                                <i class="fa fa-file-image-o text-6xl text-indigo-500"></i>
                            @elseif (substr(strrev($doc->file), 0, 3) == 'gnp')
                                <i class="fa fa-file-image-o text-6xl text-indigo-500"></i>
                            @elseif (substr(strrev($doc->file), 0, 3) == 'piz')
                                <i class="fa fa-file-zip-o text-6xl text-indigo-500"></i>
                            @elseif (substr(strrev($doc->file), 0, 3) == 'fdp')
                                <i class="fa fa-file-pdf-o text-6xl text-indigo-500"></i>
                            @else
                                <i class="fa fa-file-o text-6xl text-indigo-500"></i>
                            @endif
                            
                        </a>
                        {{-- <div class="flex justify-center my-1">
                            <i class="fa fas fa-eye mx-1 text-emerald-500"></i>
                            <i class="fa fa-trash mx-1 text-red-500"></i>
                        </div> --}}
                    </li>
                    @endif
                    {{-- <li class="mx-3 flex flex-col relative">
                        <span class="absolute h-5 w-5 bg-gray-200 flex items-center justify-center rounded-full -top-2 -left-2 ring-1 ring-indigo-500 text-indigo-500">2</span>
                        <i class="fa fa-file-zip-o text-6xl text-indigo-500"></i>
                        <div class="flex justify-center my-1">
                            <i class="fa fas fa-eye mx-1 text-emerald-500"></i>
                            <i class="fa fa-trash mx-1 text-red-500"></i>
                        </div>
                    </li>
                    <li class="mx-3 flex flex-col relative">
                        <span class="absolute h-5 w-5 bg-gray-200 flex items-center justify-center rounded-full -top-2 -left-2 ring-1 ring-indigo-500 text-indigo-500">3</span>
                        <i class="fa fa-file-pdf-o text-6xl text-indigo-500"></i>
                        <div class="flex justify-center my-1">
                            <i class="fa fas fa-eye mx-1 text-emerald-500"></i>
                            <i class="fa fa-trash mx-1 text-red-500"></i>
                        </div>
                    </li> --}}
                </ul>

                <div class="mt-2">
                    <ul class="flex justify-end">
                        <li class="text-xl mx-1 text-slate-900">
                            @if(!$bookmark) 
                                <form action="/bookmarks?doc={{ $doc->id }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit">
                                        <i class="fa far fa-star-o"></i>
                                    </button>
                                </form>
                            @else 
                                <form action="/bookmarks/{{ $bookmark }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa far fa-star"></i>
                                    </button>
                                </form>
                            @endif
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
        </div>

        <!--!! Single Document !!-->

        <!--!! Main Content Here !!-->
    </div>
</x-layout>