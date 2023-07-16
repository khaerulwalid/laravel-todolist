<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Todo Wall</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200 pb-4">
    <div class="w-full py-4 px-6 bg-white rounded-b-xl border border-b-slate-800 drop-shadow-md">
        <h1 class="font-bold text-center text-5xl mb-8">Wall Tech - TodoList</h1>
    </div>

    <div class="lg:w-2/4 mx-auto py-6 px-6 bg-white border">
        <div class="mb-6">
            <form method="post" action="/" class="flex flex-col">
                @csrf

                @if (session()->has('success'))
                    <span class="mx-auto rounded w-60 h-8 bg-green-500 text-white font-semibold text-center">
                        {{ session('success') }}
                    </span>
                @endif
                
                <input type="text" name="title" placeholder="The todo title" class="bg-gray-100 py-3 px-4 rounded-xl mt-6  @error('title') border border-red-600 @enderror">
                @error('title')
                    <p class=" text-sm font-thin text-red-500 mt-1">{{ $message }}</p>
                @enderror

                <textarea name="description" placeholder="The todo description" class="py-3 px-4 rounded-xl bg-gray-100 mt-6"></textarea>

                <button class="w-28 py-4 px-5 bg-green-500 text-white rounded-xl hover:bg-green-600 font-bold mt-6">Submit</button>
            </form>
        </div>

        <hr />

        <div class="mt-2">

            @foreach ($todos as $todo)
            <div @class(['py-4 flex items-center border-b border-gray-300 px-3',
                $todo->isDone ? ' bg-green-200 rounded-xl' : ''
            ])>
                <div class="flex-1 pr-8">
                    <h3 class="text-lg font-semibold">{{ $todo->title }}</h3>
                    <p class="text-gray-500">{{ $todo->description }}</p>
                </div>

                
                <div class="flex space-x-2">
                    <form method="post" action="/{{ $todo->id }}">
                        @csrf
                        @method('patch')

                        @if (!$todo->isDone)
                        <button class="p-2 bg-green-500 text-white rounded-xl hover:bg-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </button>
                        @else
                        <button class="p-2 bg-red-500 text-white rounded-xl hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>                              
                        </button>
                        @endif
                    </form>

                    <form method="post" action="/{{ $todo->id }}">
                        @csrf
                        @method('delete')
                        <button class="p-2 bg-red-500 text-white rounded-xl hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    

    
</body>
</html>