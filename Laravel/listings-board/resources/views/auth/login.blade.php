<x-layout>
    <div class="bg-white-rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4 ">Login</h2>
        <form method="POST" action="{{route('login.authenticate')}}">
            @csrf
            <x-input type="email" name="email" placeholder="Enter your email"/>
            <x-input type="password" name="password" placeholder="Create a new password"/>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none rounded">
                Login
            </button>

            <p class="mt-4 text-gray-500">

                <x-nav-link textColor="text-blue-900" url="/register">Don't have an account yet?</x-nav-link>
            </p>
        </form>
    </div>
</x-layout>

