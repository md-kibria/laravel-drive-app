<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa far fas fa-info-circle"></i></span> Report us
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->

        <form action="/report" method="post" class="border-2 border-slate-500 py-10 px-5 rounded-md md:w-2/3 lg:w-1/2">
            @csrf 
            @method('POST')
            <div class="my-2">
                <label for="" class="inline-block text-xl mb-2">Name</label>
                <input type="text" name="name" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your name" value="{{ old('name') }}">
                @error('name') <span class="text-red-500 text-sm ">{{$message}}</span>@enderror
            </div>

            <div class="my-2">
                <label for="" class="inline-block text-xl mb-2">Email</label>
                <input type="text" name="email" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Your email" value="{{ old('email') }}">
                @error('email') <span class="text-red-500 text-sm ">{{$message}}</span>@enderror
            </div>


            <div class="my-2">
                <label for="" class="inline-block text-xl mb-2">Message</label>
                <textarea name="msg" class="border border-slate-500 rounded w-full py-2 px-3" rows="5" name="msg" placeholder="Your message">{{ old('msg') }}</textarea>
                @error('msg') <span class="text-red-500 text-sm ">{{$message}}</span>@enderror
            </div>

            <div class="my-2">
                <input type="submit" value="Send" class="mt-2 bg-green-600 py-2 px-5 rounded-md text-white cursor-pointer">
            </div>
        </form>

        <!--!! Main Content Here !!-->
    </div>
</x-layout>