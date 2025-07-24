@forelse ($personnecollecte as $personne)
                                <tr>
                                    {{-- <td class="cell">{{ $personne->id }}</td> --}}
                                    <td class="cell"><span class="truncate">{{ $personne->nom }}</span></td>
                                    <td class="cell">{{ $personne->prenom }}</td>
                                    <td class="cell">{{ $personne->contact }}</td>{{--
                                    <td class="cell">{{ $personne->lieu_residence }}</td>
                                    <td class="cell">{{ $personne->lieu_vote }}</td> --}}
                                    <td class="cell">
                                        <!-- Bouton modifier -->
                                        <button class="btn-sm app-btn-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditPersonne-{{ $personne->id }}">
                                            Éditer
                                        </button>

                                        <!-- Bouton supprimer -->
                                        <form method="POST" action="{{ route('collecte.destroy', $personne->id) }}" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm app-btn-secondary btn-delete">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal d'édition pour cette personne -->
<div class="modal fade" id="modalEditPersonne-{{ $personne->id }}" tabindex="-1" aria-labelledby="modalEditPersonneLabel{{ $personne->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Largeur augmentée -->
        <div class="modal-content">
            <form action="{{ route('collecte.update', $personne->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPersonneLabel{{ $personne->id }}">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
                            <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Modifier la personne
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom-{{ $personne->id }}" class="form-label"><i class="fas fa-user me-1"></i> Nom</label>
                            <input type="text" name="nom" id="nom-{{ $personne->id }}" class="form-control form-control-lg" value="{{ $personne->nom }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prenom-{{ $personne->id }}" class="form-label"><i class="fas fa-user me-1"></i> Prénom</label>
                            <input type="text" name="prenom" id="prenom-{{ $personne->id }}" class="form-control form-control-lg" value="{{ $personne->prenom }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact-{{ $personne->id }}" class="form-label"><i class="fas fa-phone me-1"></i> Contact</label>
                            <input type="text" name="contact" id="contact-{{ $personne->id }}" class="form-control form-control-lg" value="{{ $personne->contact }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email-{{ $personne->id }}" class="form-label"><i class="fas fa-envelope me-1"></i> Email (facultatif)</label>
                            <input type="email" name="email" id="email-{{ $personne->id }}" class="form-control form-control-lg" value="{{ $personne->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lieu_residence-{{ $personne->id }}" class="form-label"><i class="fas fa-home me-1"></i> Lieu de résidence</label>
                            <input type="text" name="lieu_residence" id="lieu_residence-{{ $personne->id }}" class="form-control form-control-lg" value="{{ $personne->lieu_residence }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="region-{{ $personne->id }}" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Région</label>
                            <select name="region" id="region-{{ $personne->id }}" class="form-control form-control-lg">
                                <option {{-- value="{{ $personne->region }}" --}}>Aucune region selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="departement-{{ $personne->id }}" class="form-label"><i class="fas fa-map me-1"></i> Département</label>
                            <select name="departement" id="departement-{{ $personne->id }}" class="form-control form-control-lg">
                                <option {{-- value="{{ $personne->departement }}" --}}>Aucune departement selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sous-prefecture-{{ $personne->id }}" class="form-label"><i class="fas fa-building me-1"></i> Sous-préfecture</label>
                            <select name="sous-prefecture" id="sous-prefecture-{{ $personne->id }}" class="form-control form-control-lg">
                                <option {{-- value="{{ $personne->sous-prefecture }}" --}}>Aucune sous-prefecture selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="commune-{{ $personne->id }}" class="form-label"><i class="fas fa-city me-1"></i> Commune</label>
                            <select name="commune" id="commune-{{ $personne->id }}" class="form-control form-control-lg">
                                <option {{-- value="{{ $personne->commune }}" --}}>Aucune commune selectionnée</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lieu_vote-{{ $personne->id }}" class="form-label"><i class="fas fa-vote-yea me-1"></i> Lieu de vote</label>
                            <select name="lieu_vote" id="lieu_vote-{{ $personne->id }}" class="form-control form-control-lg">
                                <option value="">{{ $personne->lieu_vote }}</option>
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
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


                            @empty
                                <tr>
                                    <td class="cell" colspan="6">Aucune personne collectée enregistrée</td>
                                </tr>
                            @endforelse
