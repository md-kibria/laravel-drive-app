@if(session()->has('message'))
    <div 
        x-data="{show: true}" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="fixed top-40 left-1/2 transform -translate-x-1/2 bg-slate-600 text-white w-80 py-5 px-5  rounded-lg border-2 border-green-500"
    >
        <p>
            <h3 class="text-green-300 text-center text-xl mb-2">Message</h3>
            <p class="text-center text-slate-300 mt-3">{{ session('message') }}</p>
        </p>
    </div> 
@endif
