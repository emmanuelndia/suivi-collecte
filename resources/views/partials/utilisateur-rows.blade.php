@forelse ($users as $user)
                        <tr>
                            <td class="cell">{{ $user->nom }}</td>
                            <td class="cell">{{ $user->prenom }}</td>
                            <td class="cell">{{ $user->login }}</td>
                            <td class="cell">{{ $user->email }}</td>
                            <td class="cell">{{ ucfirst($user->role) }}</td>
                            <td class="cell">
                                <!-- Bouton modifier -->
                                <button class="btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditUser-{{ $user->id }}">
                                    Éditer
                                </button>

                                <!-- Bouton supprimer -->
                                <form method="POST" action="{{ route('utilisateurs.destroy', $user->id) }}" class="d-inline delete-user-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-sm app-btn-secondary btn-delete-user">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal édition utilisateur -->
                        <div class="modal fade" id="modalEditUser-{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditUserLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('utilisateurs.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditUserLabel{{ $user->id }}">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
                                                    <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5z"/>
                                                </svg>
                                                Modifier l'utilisateur
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="nom-{{ $user->id }}" class="form-label"><i class="fas fa-user me-1 text-secondary"></i> Nom</label>
                                                    <input type="text" name="nom" id="nom-{{ $user->id }}" class="form-control" value="{{ $user->nom }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="prenom-{{ $user->id }}" class="form-label"><i class="fas fa-user me-1 text-secondary"></i> Prénom</label>
                                                    <input type="text" name="prenom" id="prenom-{{ $user->id }}" class="form-control" value="{{ $user->prenom }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="login-{{ $user->id }}" class="form-label"><i class="fas fa-id-badge me-1 text-secondary"></i> Login</label>
                                                    <input type="text" name="login" id="login-{{ $user->id }}" class="form-control" value="{{ $user->login }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email-{{ $user->id }}" class="form-label"><i class="fas fa-envelope me-1 text-secondary"></i> Email (facultatif)</label>
                                                    <input type="email" name="email" id="email-{{ $user->id }}" class="form-control" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="role-{{ $user->id }}" class="form-label"><i class="fas fa-user-tag me-1 text-secondary"></i> Rôle</label>
                                                    <select name="role" id="role-{{ $user->id }}" class="form-select" required>
                                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Agent</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="password-{{ $user->id }}" class="form-label"><i class="fas fa-lock me-1 text-secondary"></i> Nouveau mot de passe <span class="text-muted small">(laissez vide si pas de modification)</span></label>
                                                    <div class="position-relative">
                                                        <input type="password" name="password" id="password-{{ $user->id }}" class="form-control pe-5">
                                                        <button class="btn btn-link position-absolute top-50 end-0 translate-middle-y toggle-password" type="button" data-target="password-{{ $user->id }}">
                                                            <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3"></div> <!-- Colonne vide pour maintenir la grille -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="password_confirmation-{{ $user->id }}" class="form-label"><i class="fas fa-lock me-1 text-secondary"></i> Confirmation mot de passe <span class="text-muted small">(laissez vide si pas de modification)</span></label>
                                                    <div class="position-relative">
                                                        <input type="password" name="password_confirmation" id="password_confirmation-{{ $user->id }}" class="form-control pe-5">
                                                        <button class="btn btn-link position-absolute top-50 end-0 translate-middle-y toggle-password" type="button" data-target="password_confirmation-{{ $user->id }}">
                                                            <svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
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
                            <td colspan="6" class="cell">Aucun utilisateur trouvé</td>
                        </tr>
                    @endforelse
