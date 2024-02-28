<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addPost.css') }}">
    <title>@yield('title', 'Laravel Blog')</title>
</head>

<body>
    <div class="add-post-page">
        <div class="add-post-backBtnContainer">
            <div class="btn-container">
                <div class="back-btn-container">
                    <a href="{{ route('posts.home') }}">
                        <p> ←BACK</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="add-post-form-container">
            <div class="form-wrapper">

                <form class="max-w-sm mx-auto" action="{{ route('post.add') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title
                        </label>
                        <div class="mt-2">
                            <input id="title" name="title" type="text" autocomplete="current-password" required
                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author
                        </label>
                        <div class="mt-2">
                            <input id="author" name="author" type="text" autocomplete="current-password" required
                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>


                    <div class="mt-6">
                        <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">Upload Image</label>
                        <input name="image"
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 800x400px).</p>
                    </div>

                    <div class="mt-5">
                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Post
                            Content</label>
                        <div class="mt-2">
                            {{-- <textarea id="content" name="content" type="textarea" required
                                class="block w-full rounded-md border-0 py-1.5 px-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </textarea> --}}
                            <textarea id="content" name="content" type="textarea" required
                                class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                    <button class="bg-blue-500 mt-5 hover:bg-blue-700 text-white  py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
