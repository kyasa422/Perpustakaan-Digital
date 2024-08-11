<nav class="bg-white" x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" @click="isOpen = !isOpen"
        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-950 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg :class="{ 'hidden': isOpen, 'block': !isOpen }"
          class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg :class="{ 'block': isOpen, 'hidden': !isOpen }"
          class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <h2 class="text-3xl font-bold text-gray-700 my-auto">EatsIQ</h2>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/dashboard" class=" {{ request()->is('/dashboard')}} rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 hover:text-white ">Dashboard</a>
            <a href="/menu" class="{{ request()->is('/menu')}} rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 hover:text-white">Menu</a>
            <a href="/sentimen" class="{{ request()->is('/sentimen')}}rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 hover:text-white">Review</a>
            <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" class="{{ request()->is('/logout')}} rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 hover:text-white">Logout</a>
           
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div x-show="isOpen" class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="/dashboard" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
      <a href="/menu" class=" {{ request()->is('/menu')}} block rounded-md px-3 py-2 text-base font-medium text-gray-950 hover:bg-gray-700 hover:text-white">menu</a>
      <a href="/sentimen" class="block rounded-md px-3 py-2 text-base font-medium text-gray-950 hover:bg-gray-700 hover:text-white">Review</a>
      <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" class="{{ request()->is('/logout')}} rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 hover:text-white">Logout</a>
           
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

    </div>
  </div>
</nav>