<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>

    @auth
        <p class="m-5 text-xl">Congrats! You are logged in.</p>
        <form class="m-5" action="/logout" method="POST">
            @csrf
            <button class=" bg-red-600 py-2 text-white rounded-lg px-4 font-semibold">Log out</button>
        </form>
        <div class="p-8 max-w-screen-lg mx-auto bg-green-100 rounded-md shadow-md mt-10 ">
            <h2 class="text-2xl font-semibold mb-6">Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <label class="block mb-2" for="title">Title</label>
                <input name="title" type="text" placeholder="Title"
                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:border-green-700">
                <textarea name="body" id="body" rows="10" placeholder="Body content..."
                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:border-green-700"></textarea>
                <button type="submit"
                    class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800 focus:outline-none focus:shadow-outline-green">Create
                    new post</button>
            </form>
        </div>
        <div class="p-8 max-w-screen-lg mx-auto shadow-md mt-10">
            <h2 class="text-2xl font-semibold mb-6">All Posts</h2>
            @foreach ($posts as $post)
                <div class="mb-6 p-5 bg-green-100 rounded-md">
                    <h3 class="text-lg font-semibold mb-2 text-green-700">{{ $post['title'] }} by <span
                            class="font-bold">{{ $post->user->name }}</span>
                    </h3>
                    <p class="text-gray-600">{{ $post['body'] }}</p>
                    <p class="mt-2 inline-block">
                        <a href="/edit-post/{{ $post->id }}" class="text-blue-500 hover:underline mr-2 ">Edit</a>
                    </p>
                    <form class="inline-block mt-5" action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 max-w-md mx-auto bg-white rounded-md shadow-md mt-10">
            <h2 class="text-2xl font-semibold mb-6">Register</h2>
            <form action="/register" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                <input type="text" name="email" placeholder="Email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Register</button>
            </form>
        </div>
        <div class="p-8 max-w-md mx-auto bg-white rounded-md shadow-md mt-10">
            <h2 class="text-2xl font-semibold mb-6">Login</h2>
            <form action="/login" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="loginname" placeholder="Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

                <input type="password" name="loginpassword" placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                <button type="submit"
                    class="w-full bg-blue-500  py-2 rounded-md text-white hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Login</button>
            </form>
        </div>
    @endauth
</body>

</html>
