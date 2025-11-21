<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit"
            class="hover:text-red-500 cursor-pointer text-white px-4 py-2 rounded transition">
        <i class="fa fa-sign-out mr-1"></i> Logout
    </button>
</form>
