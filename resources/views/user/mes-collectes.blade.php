@extends('layout.template')

@section('content')



<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Mes personnes collectées</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="row gx-1 align-items-center" method="GET" id="search-form">
                        <div class="col-auto">
                            <input type="text" id="searchInput" name="query" value="{{ request('query') }}" class="form-control" placeholder="Rechercher...">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Rechercher</button>
                        </div>
                    </form>
                </div>

                <div class="col-auto">
                    <!-- Bouton ajout modal -->
                    <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAjoutPersonne">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
                            <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Enregistrer une nouvelle personne
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

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                {{-- <th class="cell">#</th> --}}
                                <th class="cell">Nom</th>
                                <th class="cell">Prenom</th>
                                <th class="cell">Contact</th>{{--
                                <th class="cell">Lieu de résidence</th>
                                <th class="cell">Lieu de vote</th> --}}
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody id="collecteTableBody">
                            @include('partials.user-collecte-rows')
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->

        <nav class="app-pagination">
            {{ $personnecollecte->appends(['query' => request('query')])->links() }}
        </nav><!--//app-pagination-->

    </div><!--//tab-pane-->
</div><!--//tab-content-->

<!-- Modal pour l'enregistrement d'un collecté -->
<div class="modal fade" id="modalAjoutPersonne" tabindex="-1" aria-labelledby="modalAjoutPersonneLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- largeur agrandie -->
        <div class="modal-content">
            <form action="{{ route('collecte.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjoutPersonneLabel">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
                            <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Ajouter une nouvelle personne
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">
                                <i class="fas fa-user me-1"></i> Nom
                            </label>
                            <input type="text" name="nom" id="nom" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">
                                <i class="fas fa-user me-1"></i> Prénom
                            </label>
                            <input type="text" name="prenom" id="prenom" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">
                                <i class="fas fa-phone me-1"></i> Contact
                            </label>
                            <input type="text" name="contact" id="contact" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email (facultatif)
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lieu_residence" class="form-label">
                            <i class="fas fa-home me-1"></i> Lieu de résidence
                            </label>
                            <input type="text" name="lieu_residence" id="lieu_residence" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="region" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i> Région
                            </label>
                            <select name="region" id="region" class="form-control form-control-lg">
                                <option {{-- value="" --}}>Aucune region selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departement" class="form-label">
                                <i class="fas fa-map me-1"></i> Département
                            </label>
                            <select name="departement" id="departement" class="form-control form-control-lg">
                                <option {{-- value="" --}}>Aucune departement selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sous-prefecture" class="form-label">
                                <i class="fas fa-building me-1"></i> Sous-préfecture
                            </label>
                            <select name="sous-prefecture" id="sous-prefecture" class="form-control form-control-lg">
                                <option {{-- value="" --}}>Aucune sous-prefecture selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="commune" class="form-label">
                                <i class="fas fa-city me-1"></i> Commune
                            </label>
                            <select name="commune" id="commune" class="form-control form-control-lg">
                                <option {{-- value="" --}}>Aucune commune selectionnée</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="lieu_vote" class="form-label">
                                <i class="fas fa-vote-yea me-1"></i> Lieu de vote
                            </label>
                            <select name="lieu_vote" id="lieu_vote" class="form-control form-control-lg">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-circle me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const collecteTableBody = document.getElementById('collecteTableBody');
    const route = "{{ auth()->user()->is_admin ? route('admin.collectes.search') : route('user.collectes.search') }}";

    let debounceTimer;

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            const query = searchInput.value.trim();

            fetch(route + '?query=' + encodeURIComponent(query), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.text())
            .then(html => {
                collecteTableBody.innerHTML = html;
            })
            .catch(error => console.error('Erreur AJAX:', error));
        }, 300); // petit délai pour éviter les requêtes excessives
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>



@endsection
