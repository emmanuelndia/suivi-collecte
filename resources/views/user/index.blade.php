@extends('layout.template')

@section('content')

    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="app-card app-card-stat shadow-sm h-100 p-4 d-flex justify-content-between align-items-center flex-nowrap flex-md-wrap" style="background-color: #f8f9fa; border-left: 4px solid #198754; overflow-x: auto;">
                <div class="d-flex align-items-center me-4 flex-shrink-0" style="min-width: 200px;">
                    <div class="me-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Personnes collectées</h6>
                        <h4 class="mb-0">{{ $totalCollectes }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Quelques personnes collectés</h1>
				    </div>

			    </div><!--//row-->

                @if (Session::get('success_message'))
                    <div class="alert alert-success"> {{ Session::get('success_message') }} </div>
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
												{{-- <th class="cell">Action</th>
												<th class="cell"></th> --}}
											</tr>
										</thead>
										<tbody>
                                            @forelse ($personnecollecte as $personne)
                                                <tr>
                                                    {{-- <td class="cell">{{ $personne->id }}</td> --}}
                                                    <td class="cell"><span class="truncate">{{ $personne->nom }}</span></td>
                                                    <td class="cell">{{ $personne->prenom }}</td>
                                                    <td class="cell">{{ $personne->contact }}</td>{{--
                                                    <td class="cell">{{ $personne->lieu_residence }}</td>
                                                    <td class="cell">{{ $personne->lieu_vote }}</td> --}}
                                                    {{-- <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="#">Editer</a>
                                                        <a class="btn-sm app-btn-secondary" href="#">Supprimer</a>
                                                    </td> --}}

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="cell" colspan="6">Aucune personne collectée enregistrée</td>
                                                </tr>
                                            @endforelse




										</tbody>
									</table>
						        </div><!--//table-responsive-->

						    </div><!--//app-card-body-->
						</div><!--//app-card-->
						{{-- <nav class="app-pagination">
							{{ $personnecollecte->links() }}
						</nav><!--//app-pagination--> --}}

			        </div><!--//tab-pane-->

				</div><!--//tab-content-->


                {{-- <!-- Modal pour l'enregistrement d'un collecté -->
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
                </div> --}}


@endsection
