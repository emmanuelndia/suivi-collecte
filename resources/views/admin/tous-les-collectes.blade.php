@extends('layout.template')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Liste des personnes collectées</h1>
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
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
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
                            @include('partials.admin-collecte-rows')
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('collecte.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjoutPersonneLabel">Ajouter une nouvelle personne collectée</h5>
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
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (facultatif)</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="lieu_residence" class="form-label">Lieu de résidence</label>
                        <input type="text" name="lieu_residence" id="lieu_residence" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lieu_vote" class="form-label">Lieu de vote</label>
                        <input type="text" name="lieu_vote" id="lieu_vote" class="form-control" required>
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

@endsection
