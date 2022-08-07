<x-layout>

    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa fa-tachometer"></i></span> Dashboard
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->


    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="mx-5">

            <h1 class="text-slate-500 text-2xl my-4">Recent Added Docs</h1>
            <table class="border border-slate-500 w-full ">
                <thead>
                    <tr>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Id</th>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Title</th>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Desc</th>
                        <th class="border border-slate-600 p-2 text-center bg-slate-500 text-gray-300">Action</th>
                        @if(Auth::check() && auth()->user()->position == 'admin')
                        <th class="border border-slate-600 p-2 text-center bg-slate-500 text-gray-300">Delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($docs as $doc)
                    <tr>
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">{{ $doc->id }}</td>
                        <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ Str::substr($doc->title, 0, 17) }}...</td>
                        <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ Str::substr($doc->desc, 0, 17) }}...</td>
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400"><a href="/docs/{{$doc->id}}" class="bg-slate-700 hover:bg-green-600 hover:text-white transition-all duration-300 py-1 px-2 rounded">View</a></td>
                        @if(Auth::check() && auth()->user()->position == 'admin')
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">
                            <form action="/docs/{{$doc->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-slate-700 hover:bg-red-600 hover:text-white transition-all duration-300 py-1 px-2 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mx-5">
            <h1 class="text-slate-500 text-2xl my-4">Recent Added Users</h1>
            <table class="border border-slate-500 w-full ">
                <thead>
                    <tr>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Id</th>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Name</th>
                        <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Email</th>
                        <th class="border border-slate-600 p-2 text-center bg-slate-500 text-gray-300">Action</th>
                        @if(Auth::check() && auth()->user()->position == 'admin')
                        <th class="border border-slate-600 p-2 text-center bg-slate-500 text-gray-300">Delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">{{ $user->id }}</td>
                        <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $user->name }}</td>
                        <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $user->email }}</td>
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400"><a href="/users/{{$doc->user->id}}" class="bg-slate-700 hover:bg-green-600 hover:text-white transition-all duration-300 py-1 px-2 rounded">Profile</a></td>
                        @if(Auth::check() && auth()->user()->position == 'admin')
                        <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">
                            <form action="/users/{{ $user->id }}" method="post">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="bg-slate-700 hover:bg-red-600 hover:text-white transition-all duration-300 py-1 px-2 rounded">Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>


</x-layout>