<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa fa-user"></i></span> Profile
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->

        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col items-center justify-center border border-slate-500 rounded-lg p-5 w-full md:w-80 h-96">
                @if($user->img)
                    <img src="{{ asset('/storage/'.$user->img) }}" alt="" class="w-24 h-24 rounded-full ring-4">
                @else
                <img src="{{ asset('/photopng.png') }}" alt="" class="w-24 h-24 rounded-full ring-4">
                @endif

                <h1 class="text-2xl font-medium my-2">{{$user->name}}</h1>
                <div class="flex flex-col my-2">
                    <div class="flex items-center text-slate-700 text-md">
                        <i class="fa far fa-envelope-o"></i>
                        <p class="mx-2">{{$user->email}}</p>
                    </div>
                    @if ($user->phone)
                        <div class="flex items-center text-slate-700 text-md">
                            <i class="fa far fas fa-phone"></i>
                            <p class="mx-2">{{$user->phone}}</p>
                        </div>
                    @endif
                    @if ($user->address)
                    <div class="flex items-center text-slate-700 text-md">
                        <i class="fa far fas fa-map-marker"></i>
                        <p class="mx-2">{{$user->address}}</p>
                    </div>
                    @endif
                </div>

                <a href="/docs?user={{ $user->id }}" class="bg-green-500 py-2 px-4 rounded-md text-slate-700 mt-3">Documents</a>
                
            </div>

            <!-- Update section -->

            @if (Auth::check() && auth()->user()->id == $user->id)

            <div class="flex lg:mx-5 my-10 lg:my-0 lg:ml-20 border border-slate-500 rounded-md p-5 w-full md:w-80 lg:w-96">
                <form action="/users/{{$user->id}}" method="post" class="w-full" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <div class="my-2">
                        <label for="" class="inline-block text-xl mb-2">Name</label>
                        <input type="text" name="name" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your name" value="{{ $user->name }}">
                    </div>

                    <div class="my-2">
                        <label for="" class="inline-block text-xl mb-2">Email</label>
                        <input type="text" name="email" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your email" value="{{ $user->email }}">
                    </div>

                    <div class="my-2">
                        <label for="" class="inline-block text-xl mb-2">Phone</label>
                        <input type="text" name="phone" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your phone" value="{{ $user->phone }}">
                    </div>

                    <div class="my-2">
                        <label for="" class="inline-block text-xl mb-2">Address</label>
                        <input type="text" name="address" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your address" value="{{ $user->address }}">
                    </div>

                    <div class="my-2">
                        <label for="" class="inline-block text-xl mb-2">Profile Image</label>
                        <input type="file" name="img" class="border border-slate-500 rounded w-full py-2 px-3">
                    </div>

                    <div class="my-2">
                        <input type="submit" value="Update" class="mt-5 bg-yellow-600 py-2 px-5 rounded-md text-white cursor-pointer">
                    </div>
                </form>
            </div>

            @endif

            <!--!! Update section !!-->
        </div>

        <!--!! Main Content Here !!-->
    </div>
</x-layout>