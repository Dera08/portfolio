<nav class="admin-nav" x-data="{ mobileOpen: false, userOpen: false }">
    <div class="admin-nav-inner">
        <a href="{{ route('dashboard') }}" class="admin-brand">
            <span class="admin-brand-mark">
                {{ collect(explode(' ', Auth::user()->nom ?? 'P A'))->map(fn($w) => mb_substr($w,0,1))->join('') }}
            </span>
            Portfolio
        </a>

        <div class="admin-links">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('projets.index') }}" class="{{ request()->routeIs('projets.*') ? 'active' : '' }}">Projets</a>
            <a href="{{ route('skills.index') }}" class="{{ request()->routeIs('skills.*') ? 'active' : '' }}">Compétences</a>
            <a href="{{ route('experiences.index') }}" class="{{ request()->routeIs('experiences.*') ? 'active' : '' }}">Expériences</a>
            <a href="{{ route('contacts.index') }}" class="{{ request()->routeIs('contacts.*') ? 'active' : '' }}">Messages</a>
        </div>

        <div class="admin-right">
            <div class="admin-dropdown">
                <button class="admin-user-toggle" @click="userOpen = !userOpen" @click.outside="userOpen = false">
                    {{ Auth::user()->nom }}
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7l5 5 5-5" />
                    </svg>
                </button>

                <div class="admin-dropdown-menu" x-show="userOpen" x-cloak style="display:none;">
                    <div class="admin-dropdown-email">{{ Auth::user()->email }}</div>
                    <a href="{{ route('profile.edit') }}">Mon profil</a>
                    <a href="{{ url('/') }}">Voir le portfolio public</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Se déconnecter</button>
                    </form>
                </div>
            </div>

            <button class="admin-hamburger" @click="mobileOpen = !mobileOpen" aria-label="Ouvrir le menu">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div class="admin-mobile-menu" :class="{ 'open': mobileOpen }">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('projets.index') }}" class="{{ request()->routeIs('projets.*') ? 'active' : '' }}">Projets</a>
        <a href="{{ route('skills.index') }}" class="{{ request()->routeIs('skills.*') ? 'active' : '' }}">Compétences</a>
        <a href="{{ route('experiences.index') }}" class="{{ request()->routeIs('experiences.*') ? 'active' : '' }}">Expériences</a>
        <a href="{{ route('contacts.index') }}" class="{{ request()->routeIs('contacts.*') ? 'active' : '' }}">Messages</a>
        <div class="divider"></div>
        <a href="{{ route('profile.edit') }}">Mon profil</a>
        <a href="{{ url('/') }}">Voir le portfolio public</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Se déconnecter</a>
        </form>
    </div>
</nav>