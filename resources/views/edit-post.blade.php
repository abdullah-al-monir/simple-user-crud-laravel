<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div class="p-8 max-w-screen-lg mx-auto shadow-md mt-10 bg-blue-100 rounded-md">
        <h1 class="text-2xl font-semibold mb-6">Edit Post</h1>
        <form action="/edit-post/{{ $post->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
            <input type="text" name="title" value="{{ $post->title }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">

            <label for="body" class="block text-sm font-medium text-gray-600">Body</label>
            <textarea name="body" cols="30" rows="10"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">{{ $post->body }}</textarea>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Save
                Changes</button>
        </form>
    </div>

</body>

</html>
