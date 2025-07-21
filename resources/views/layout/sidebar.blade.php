@auth
<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <!-- Bouton de fermeture pour mobile -->
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>

        <!-- Branding -->
        <div class="app-branding">
            <a class="app-logo" href="{{ route('user.index') }}">
                <img class="logo-icon me-2" src="{{ asset('logo_2.png') }}" alt="logo">
                <span class="logo-text">Suivi Collecte</span>
            </a>
        </div>

        <!-- Navigation principale -->
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.index') || request()->routeIs('user.index') ? 'active' : '' }}"
                    href="{{ Auth::user()->role === 'admin' ? route('admin.index') : route('user.index') }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <!-- Section ADMIN uniquement -->
                @if(Auth::user()->role === 'admin')

                @php
                    $isAdminCollecteActive = request()->routeIs('admin.allcollected') || request()->routeIs('admin.tous-les-utilisateurs');
                @endphp

                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ $isAdminCollecteActive ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-admin" aria-expanded="{{ $isAdminCollecteActive ? 'true' : 'false' }}">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-link-text">Gestion Collecte</span>
                        <span class="submenu-arrow"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div id="submenu-admin" class="collapse submenu submenu-1 {{ $isAdminCollecteActive ? 'show' : '' }}">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item">
                                <a class="submenu-link {{ request()->routeIs('admin.allcollected') ? 'active' : '' }}" href="{{ route('admin.allcollected') }}">Listes des personnes enregistrées</a>
                            </li>
                            <li class="submenu-item">
                                <a class="submenu-link {{ request()->routeIs('admin.tous-les-utilisateurs') ? 'active' : '' }}" href="{{ route('admin.tous-les-utilisateurs') }}">Liste des utilisateurs</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Section USER uniquement -->
                @if(Auth::user()->role === 'user')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.mes-collectes') ? 'active' : '' }}" href="{{ route('user.mes-collectes') }}">
                        <span class="nav-icon"><i class="fas fa-user-check"></i></span>
                        <span class="nav-link-text">Mes collectes</span>
                    </a>
                </li>
                @endif

            </ul>
        </nav>



        <!-- Pied du menu -->
        <div class="app-sidepanel-footer">

            <!-- Profil utilisateur -->
            <div class="user-box d-flex align-items-center p-3 bg-light rounded shadow-sm">
                <div class="user-initial bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-size: 18px;">
                    {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name fw-bold">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>
                    <div class="user-role text-muted" style="font-size: 0.8rem;">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>

            <!-- Lien de déconnexion -->
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="nav-link-text">Déconnexion</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>
@endauth
