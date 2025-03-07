@extends('layouts.apps')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row g-3 mb-6">
                <!-- Browser Default -->
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Modifier Catégorie</h5>
                        <div class="card-body">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="browser-default-validation">
                                @csrf
                                @method('PUT') {{-- Ajout de la méthode PUT pour la mise à jour --}}
                
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                
                                <input type="hidden" name="id" value="{{ $category->id }}"> {{-- Champ caché pour l'ID --}}
                
                                <div class="mb-6">
                                    <label class="form-label" for="description">Description</label>
                                    <select class="form-select" name="description" id="description" required>
                                        <option value="">Sélectionner une Catégorie</option>
                                        <option value="Cadeau ou don" {{ $category->description == 'Cadeau ou don' ? 'selected' : '' }}>Cadeau ou don</option>
                                        <option value="Salaires" {{ $category->description == 'Salaires' ? 'selected' : '' }}>Salaires</option>
                                        <option value="Epargne" {{ $category->description == 'Epargne' ? 'selected' : '' }}>Épargne</option>
                                        <option value="Transport" {{ $category->description == 'Transport' ? 'selected' : '' }}>Transport</option>
                                        <option value="Achats" {{ $category->description == 'Achats' ? 'selected' : '' }}>Achats</option>
                                        <option value="Ventes" {{ $category->description == 'Ventes' ? 'selected' : '' }}>Ventes</option>
                                        <option value="Operation divers" {{ $category->description == 'Operation divers' ? 'selected' : '' }}>Opération divers</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" id="nouvelleDescription" placeholder="Ajouter une nouvelle catégorie">
                                    <button type="button" class="form-control mt-1" id="ajouterDescription">Ajouter</button>
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
                                    <label class="form-label" for="montantbudget">Montant budgété</label>
                                    <input type="number" name="montantbudget" class="form-control" id="montantbudget" value="{{ $category->montantbudget }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="description">Type De la catégorie</label>
                                    <select class="form-select" name="type" id="description" required>
                                        <option value="">Sélectionner Type</option>
                                        <option value="Depense" {{ $category->type == 'Depense' ? 'selected' : '' }}>Dépense</option>
                                        <option value="Revenu" {{ $category->type == 'Revenu' ? 'selected' : '' }}>Revenu</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Browser Default -->
            </div>
        </div>
    </div>
@endsection
