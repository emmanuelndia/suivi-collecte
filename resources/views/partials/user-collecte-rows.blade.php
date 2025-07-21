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
                                        <form action="{{ route('collecte.destroy', $personne->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm app-btn-secondary">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal d'édition pour cette personne -->
                                <div class="modal fade" id="modalEditPersonne-{{ $personne->id }}" tabindex="-1" aria-labelledby="modalEditPersonneLabel{{ $personne->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('collecte.update', $personne->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditPersonneLabel{{ $personne->id }}">Modifier la personne</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nom-{{ $personne->id }}" class="form-label">Nom</label>
                                                        <input type="text" name="nom" id="nom-{{ $personne->id }}" class="form-control" value="{{ $personne->nom }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prenom-{{ $personne->id }}" class="form-label">Prénom</label>
                                                        <input type="text" name="prenom" id="prenom-{{ $personne->id }}" class="form-control" value="{{ $personne->prenom }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="contact-{{ $personne->id }}" class="form-label">Contact</label>
                                                        <input type="text" name="contact" id="contact-{{ $personne->id }}" class="form-control" value="{{ $personne->contact }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-{{ $personne->id }}" class="form-label">Email (facultatif)</label>
                                                        <input type="email" name="email" id="email-{{ $personne->id }}" class="form-control" value="{{ $personne->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lieu_residence-{{ $personne->id }}" class="form-label">Lieu de résidence</label>
                                                        <input type="text" name="lieu_residence" id="lieu_residence-{{ $personne->id }}" class="form-control" value="{{ $personne->lieu_residence }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lieu_vote-{{ $personne->id }}" class="form-label">Lieu de vote</label>
                                                        <input type="text" name="lieu_vote" id="lieu_vote-{{ $personne->id }}" class="form-control" value="{{ $personne->lieu_vote }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
