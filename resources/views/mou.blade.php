<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoU Tracker System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen p-8 text-slate-800">

    <div class="max-w-5xl mx-auto space-y-8">
        
        <header class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm border border-slate-100">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">MoU Tracker</h1>
                <p class="text-slate-500">Manage your Memorandums of Understanding</p>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-sm border border-slate-100 h-fit">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Add New MoU</h2>
                
                <form action="{{ route('mous.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                        <input type="text" name="title" required class="w-full border border-slate-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Parties Involved</label>
                        <input type="text" name="parties_involved" required class="w-full border border-slate-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Effective Date</label>
                        <input type="date" name="effective_date" required class="w-full border border-slate-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-700 transition">
                        Save MoU
                    </button>
                </form>
            </div>

            <div class="md:col-span-2 space-y-4">
                <h2 class="text-xl font-semibold mb-4">Active Agreements</h2>
                
                @if($mous->isEmpty())
                    <div class="bg-white p-8 text-center rounded-xl shadow-sm border border-slate-100 text-slate-500">
                        No MoUs found. Add one to get started.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($mous as $mou)
                            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-slate-900 leading-tight">{{ $mou->title }}</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $mou->status }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600 mb-1"><strong>Parties:</strong> {{ $mou->parties_involved }}</p>
                                <p class="text-sm text-slate-600 mb-3"><strong>Date:</strong> {{ date('M d, Y', strtotime($mou->effective_date)) }}</p>
                                
                                @if($mou->description)
                                    <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $mou->description }}</p>
                                @endif

                                <form action="{{ route('mous.destroy', $mou) }}" method="POST" class="mt-auto pt-4 border-t border-slate-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium transition" onclick="return confirm('Are you sure you want to delete this MoU?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</body>
</html>