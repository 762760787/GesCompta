@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-6">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="col-md-4">

                    <div class="card">
                        <h5 class="card-header">Nouvelle Catégorie</h5>
                        <div class="card-body">

                            <form action="{{ route('categories.store') }}" method="POST" class="browser-default-validation">
                                @csrf

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <label class="form-label" for="description">Description</label>
                                    <select class="form-select" name="description" id="description" required>
                                        <option value="">Sélectionner une Catégorie</option>
                                        <option value="Logo">Logo</option>
                                        <option value="Affcihe">Affiche</option>
                                        <option value="Internet">Internet</option>
                                        <option value="Cv">Cv</option>
                                        <option value="Application">Application</option>
                                        <option value="Carte de Membre">Carte de Membre</option>
                                        <option value="Carte de Visite">Carte de Visite</option>
                                        <option value="Operation divers">Opération divers</option>
                                        <option value="Fourniture de Bureau">Fourniture de Bureau</option>
                                        <option value="Achats">Achats</option>
                                        <option value="Ventes">Ventes</option>
                                        </select>
                                    <input type="text" class="form-control mt-1" id="nouvelleDescription"
                                        placeholder="Ajouter une nouvelle catégorie">
                                    <button type="button" class="form-control mt-1"
                                        id="ajouterDescription">Ajouter</button>
                                </div>

                                <script>
                                    document.getElementById('ajouterDescription').addEventListener('click', function() {
                                        var nouvelleDescription = document.getElementById('nouvelleDescription').value;
                                        if (nouvelleDescription) {
                                            var nouvelleOption = document.createElement('option');
                                            nouvelleOption.value = nouvelleDescription;
                                            nouvelleOption.text = nouvelleDescription;
                                            document.getElementById('description').appendChild(nouvelleOption);
                                            document.getElementById('nouvelleDescription').value = '';
                                        }
                                    });
                                </script>

                                <div class="mb-6">
                                    <label class="form-label" for="montantbudget">Montant</label>
                                    <input type="number" name="montantbudget" class="form-control" id="montantbudget"
                                        required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="description">Type De la catégorie</label>
                                    <select class="form-select" name="type" id="description" required>
                                        <option value="">Sélectionner Type</option>
                                        <option value="Depense">Dépense</option>
                                        <option value="Revenu">Revenu</option>

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <h5 class="card-header">Toutes mes Catégories</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Montant budgété</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->description }}</td>
                                            <td>{{ $categorie->montantbudget }}</td>
                                            @if ($categorie->type === 'Depense')
                                                <td><span class="badge bg-label-info me-1">{{ $categorie->type }}</span>
                                                </td>
                                            @else
                                                <td><span class="badge bg-label-success me-1">{{ $categorie->type }}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item "
                                                            href="{{ route('categories.edit', $categorie->id) }}">
                                                            <i class="icon-base bx bx-edit-alt me-1 "></i> Edit
                                                        </a>


                                                        <form action="{{ route('categories.destroy', $categorie->id) }}"
                                                            class="dropdown-item" method="POST"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="icon-base bx bx-trash me-1"></i>
                                                                Supprimer</button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="alert alert-info">Aucune catégorie trouvée.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
