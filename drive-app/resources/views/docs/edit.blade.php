<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa far fa-plus-square"></i></span> Add a document
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->

        <form action="/docs/{{ $doc->id }}" method="post" class="border-2 border-slate-500 py-10 px-5 rounded-md md:w-2/3 lg:w-1/2" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div class="my-2">
                <label for="" class="inline-block text-xl mb-2">Title</label>
                <input type="text" name="title" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Enter a title" value="{{ $doc->title }}">
                <span class="text-red-500 text-sm @error('title') visible @else invisible @enderror">@error('title') {{$message}}@enderror <span class="invisible">Error</span></span>
            </div>

            <div class="-my-2">
                <label for="" class="inline-block text-xl mb-2">Description</label>
                <textarea name="desc" class="border border-slate-500 rounded w-full py-2 px-3" rows="5" placeholder="Descriptions here">{{ $doc->desc }}</textarea>
                <span class="text-red-500 text-sm @error('desc') visible @else invisible @enderror">@error('desc') {{$message}}@enderror <span class="invisible">Error</span></span>
            </div>

            <div class="my-2">
                <label for="" class="inline-block text-xl mb-2">Files</label>
                <input type="file" name="file" class="border border-slate-500 rounded w-full py-2 px-3">
            </div>

            <img src="/storage/{{$doc->file}}" alt="" class="h-10 w-10">

            <div class="my-2">
                <p class="text-xl mb-2">Privacy</p>

                <input type="radio" id="public" name="privacy" value="public" @if($doc->privacy == 'public') checked @endif>
                <label for="public">Public</label>
                <input type="radio" id="private" name="privacy" value="private" class="ml-5" @if($doc->privacy == 'private') checked @endif>
                <label for="private">Private</label>
                <span class="text-red-500 block text-sm @error('privacy') visible @else invisible @enderror">@error('privacy') {{$message}}@enderror <span class="invisible">Error</span></span>
            </div>

            <div class="my-2">
                <input type="submit" value="Update" class="mt-5 bg-green-600 py-2 px-5 rounded-md text-white">
            </div>
        </form>

        <!--!! Main Content Here !!-->
    </div>
</x-layout>