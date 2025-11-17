<header class="bg-blue-900 text-white p-4" x-data="{open: false}">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-4xl">
            <a href="{{url('/')}}">
                <i class="fa-solid fa-person-walking fa-lg" style="color: #ffffff;"></i>Workland<i
                    class="fa-solid fa-briefcase fa-lg" style="color: #ffffff;"></i>
            </a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')">
                Home
            </x-nav-link>

            <x-nav-link url="jobs/saved" :active="request()->is('jobs/saved')">
                Saved Jobs
            </x-nav-link>

            <x-nav-link url="/jobs" :active="request()->is('jobs')">
                All Jobs
            </x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')">
                Register
            </x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge">
                Dashboard
            </x-nav-link>
            <x-button-link url="/jobs/create" :active="request()->is('jobs/create')" icon="edit">
                Create Job
            </x-button-link>
        </nav>
        <button @click="open = !open" class="text-white flex items-center">
            <i class="fa fa-bars text-2xl" style="color: #ffffff"></i>
        </button>
    </div>

    <ul x-show="open" @click.away="open = false">
        <li>1.test</li>
        <li>2.test</li>
    </ul>
</header>
