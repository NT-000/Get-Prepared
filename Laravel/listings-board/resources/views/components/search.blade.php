<form method="GET" action="{{route('jobs.search')}}" class="block mx-5 md:mx-auto md:space-x-2">

    <input type="search" name="keywords" placeholder="Keywords"
           class="w-full md:w-72 px-4 py-3 focus:outline-none bg-white opacity-50 rounded-2xl focus:brightness-200"/>
    <input type="search" name="location" placeholder="Location"
           class="w-full md:w-72 px-4 py-3 focus:outline-none bg-white opacity-50 rounded-2xl focus:brightness-200"/>
    <button
        class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none cursor-pointer">
        <i class="fa fa-search mr-1"></i>Search
    </button>
</form>
