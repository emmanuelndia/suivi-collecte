@extends('layout.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Liste des utilisateurs</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="table-search-form row gx-1 align-items-center" method="GET" action="">
                        <div class="col-auto">
                            <input type="text" name="searchorders" class="form-control search-orders" placeholder="Search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-auto">
                    <!-- Bouton ajout modal -->
                    <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAjoutUser">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
                            <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Ajouter un nouvel utilisateur
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if (Session::get('success_message'))
    <div id="alert-box" class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

@if (Session::get('error'))
    <div id="alert-box" class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<div class="app-card app-card-orders-table shadow-sm mb-5">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left">
                <thead>
                    <tr>
                        <th class="cell">Nom</th>
                        <th class="cell">Prénom</th>
                        <th class="cell">Login</th>
                        <th class="cell">Email</th>
                        <th class="cell">Rôle</th>
                        <th class="cell">Action</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @include('partials.utilisateur-rows', ['users' => $users])
                </tbody>

            </table>
        </div><!--//table-responsive-->
    </div><!--//app-card-body-->
</div><!--//app-card-->

<nav class="app-pagination">
    {{ $users->links() }}
</nav>

@if ($errors->any())
    <div id="error-alert" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Modal ajout utilisateur -->
<div class="modal fade" id="modalAjoutUser" tabindex="-1" aria-labelledby="modalAjoutUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('utilisateurs.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjoutUserLabel">
                        <i class="fas fa-user-plus me-2"></i> Ajouter un nouvel utilisateur
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">
                                <i class="fas fa-user me-1 text-secondary"></i> Nom
                            </label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">
                                <i class="fas fa-user me-1 text-secondary"></i> Prénom
                            </label>
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="login" class="form-label">
                                <i class="fas fa-id-badge me-1 text-secondary"></i> Login
                            </label>
                            <input type="text" name="login" id="login" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1 text-secondary"></i> Email (facultatif)
                            </label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-user-tag me-1 text-secondary"></i> Rôle
                            </label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="user" selected>Agent</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1 text-secondary"></i> Mot de passe
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control pe-5" required>
                                <button class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y toggle-password" type="button" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"></div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-1 text-secondary"></i> Confirmation mot de passe
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control pe-5" required>
                                <button class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y toggle-password" type="button" data-target="password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Notifications  --}}
@if ($errors->any())
<script>
    setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000); // 3000 ms = 5 secondes
</script>
@endif


{{-- Recherche dynamique --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[name="searchorders"]');
    const userTableBody = document.getElementById('userTableBody');

    let debounce;

    searchInput.addEventListener('input', function () {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
            const query = searchInput.value.trim();

            fetch("{{ route('admin.users.search') }}?query=" + encodeURIComponent(query), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.text())
            .then(html => {
                userTableBody.innerHTML = html;
            })
            .catch(error => console.error('Erreur AJAX:', error));
        }, 300); // délai pour éviter les requêtes excessives
    });
});
</script>


{{-- Alerte pour la suppression d'un utilisateur  --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete-user').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-user-form');
            Swal.fire({
                title: 'Supprimer cet utilisateur ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>


{{-- Affichage de mot de passe --}}
<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('svg');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
            icon.innerHTML = `
                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.211.135-.52.315-.893.514l.77.771c.374-.199.684-.378.896-.514.335-.48.83-1.12 1.465-1.755A11.513 11.513 0 0 0 16 8z"/>
                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.77.772zm3.13-.892l.772.772c.567-.285 1.152-.492 1.767-.492C10.12 5 11.879 6.168 13.168 7.457A13.133 13.133 0 0 1 14.828 9.5l-.195.288c-.335.48-.83 1.12-1.465 1.755l-.772-.772c.567-.285 1.152-.492 1.767-.492C11.879 10.332 10.119 11.5 8 11.5c-.716 0-1.39-.133-2.02-.36l-.77-.772z"/>
            `;
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
            icon.innerHTML = `
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            `;
        }
    });
});
</script>



@endsection
