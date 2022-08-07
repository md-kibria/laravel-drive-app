<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="tailwind.js"></script>
</head>

<body class="min-h-screen w-screen flex items-center justify-center">
    <main class="flex flex-col items-center justify-center border border-slate-700 bg-gray-300 w-96 rounded-lg">
        <h1 class="text-3xl text-slate-500 p-4">Login</h1>
        <form action="/users/authenticate" method="post" class="px-5 w-full">
            @csrf 

            <div class="-my-2">
                <label for="" class="inline-block text-xl mb-2">Email</label>
                <input type="text" name="email" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Enter your email" value="{{ old('email') }}">
                <span class="text-red-500 text-sm @error('email') visible @else invisible @enderror">@error('email') {{$message}}@enderror <span class="invisible">A</span></span>
            </div>

            <div class="-my-2">
                <label for="" class="inline-block text-xl mb-2">Password</label>
                <input type="password" name="password" class="border border-slate-500 rounded w-full py-2 px-3" placeholder="Enter a password">
                <span class="text-red-500 text-sm @error('password') visible @else invisible @enderror">@error('password') {{$message}}@enderror <span class="invisible">A</span></span>
            </div>

            <p class="text-slate-600">Don't have an accout?
                <a href="/register" class="underline">register</a> here
            </p>

            <div class="my-2">
                <input type="submit" value="Submit" class="mt-2 mb-5 bg-slate-400 hover:bg-slate-500 py-2 rounded w-full text-white cursor-pointer">
            </div>
        </form>
    </main>
</body>

</html>