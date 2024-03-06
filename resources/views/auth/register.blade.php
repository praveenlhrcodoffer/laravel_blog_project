@extends('layouts.auth-layouts')

@section('content')
    <div class="login-form-page">
        <div class="back-btn-container">
            <a href="{{ route('posts.home') }}">
                <p> ←BACK</p>
            </a>
        </div>

        <div class="login-form-wrapper">


            <div class="login-form-inner-container">
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="error-div">
                            <p>{{ $err }}</p>
                        </div>
                    @endforeach
                @endif


                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login in to
                            your account</h2>
                    </div>

                    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                        <form class="space-y-6" action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <div>
                                <label for="fullname" class="block text-sm font-medium leading-6 text-gray-900">Full Name
                                </label>
                                <div class="mt-2">
                                    <input id="fullname" name="fullname" type="text" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between">
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                </div>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        required
                                        class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                            </div>
                            <div>

                                <div class="flex items-center justify-between">
                                    <label for="confirm_password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Confirm
                                        Password</label>
                                </div>
                                <div class="mt-2">
                                    <input id="confirm_password" name="confirm_password" type="password"
                                        autocomplete="current-password" required
                                        class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div>
                                <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 px-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                                    in</button>
                            </div>
                        </form>

                        <p class="mt-10 text-center text-sm text-gray-500">
                            Already Register?
                            <a href="{{ route('user.login') }}"
                                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a
                                Sign In</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
