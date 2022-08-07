<x-layout>
    <h2 class="text-3xl text-slate-600 font-bold">
        <span class="text-4xl"><i class="fa far fas fa-info-circle"></i></span> Reports
    </h2>

    <div class="mt-14 md:ml-10">
        <!-- Main Content Here -->

        <table class="border border-slate-500 w-full lg:w-2/3">
            <thead>
                <tr>
                    <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Id</th>
                    <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Name</th>
                    <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Email</th>
                    <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Message</th>
                    <th class="border border-slate-600 p-2 text-left bg-slate-500 text-gray-300">Date</th>
                    <th class="border border-slate-600 p-2 text-center bg-slate-500 text-gray-300">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">{{ $report->id }}</td>
                    <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $report->name }}</td>
                    <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $report->email }}</td>
                    <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $report->msg }}</td>
                    <td class="border border-slate-700 p-2 text-left bg-slate-600 text-slate-400">{{ $report->created_at }}</td>
                    <td class="border border-slate-700 p-2 text-center bg-slate-600 text-slate-400">
                        <form action="/report/{{ $report->id }}" method="post">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="bg-slate-700 hover:bg-red-600 hover:text-white transition-all duration-300 py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!--!! Main Content Here !!-->
    </div>
</x-layout>