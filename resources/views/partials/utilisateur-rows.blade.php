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
                                <form action="{{ route('utilisateurs.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm app-btn-secondary">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal édition utilisateur -->
                        <div class="modal fade" id="modalEditUser-{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditUserLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('utilisateurs.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditUserLabel{{ $user->id }}">Modifier l'utilisateur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nom-{{ $user->id }}" class="form-label">Nom</label>
                                                <input type="text" name="nom" id="nom-{{ $user->id }}" class="form-control" value="{{ $user->nom }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prenom-{{ $user->id }}" class="form-label">Prénom</label>
                                                <input type="text" name="prenom" id="prenom-{{ $user->id }}" class="form-control" value="{{ $user->prenom }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="login-{{ $user->id }}" class="form-label">Login</label>
                                                <input type="text" name="login" id="login-{{ $user->id }}" class="form-control" value="{{ $user->login }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-{{ $user->id }}" class="form-label">Email</label>
                                                <input type="email" name="email" id="email-{{ $user->id }}" class="form-control" value="{{ $user->email }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role-{{ $user->id }}" class="form-label">Rôle</label>
                                                <select name="role" id="role-{{ $user->id }}" class="form-select" required>
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Agent</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password-{{ $user->id }}" class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                                                <input type="password" name="password" id="password-{{ $user->id }}" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation-{{ $user->id }}" class="form-label">Confirmation mot de passe</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation-{{ $user->id }}" class="form-control">
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
                            <td colspan="6" class="cell">Aucun utilisateur trouvé</td>
                        </tr>
                    @endforelse
