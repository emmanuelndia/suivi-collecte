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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('utilisateurs.store') }}" method="POST" onsubmit="console.log('Form submitted')">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjoutUserLabel">Ajouter un nouvel utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" name="login" id="login" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (facultatif)</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="user" selected>Utilisateur</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmation mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

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



@endsection
