@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-6">
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Modifier Un Compte</h5>
                        <div class="card-body">
                            <form action="{{ route('comptes.update', $compte->id) }}" method="POST" class="browser-default-validation">
                                @csrf
                                @method('PUT') {{-- Ajout de la méthode PUT pour la mise à jour --}}
                
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                
                                <input type="hidden" name="id" value="{{ $compte->id }}"> {{-- Champ caché pour l'ID --}}
                
                                <div class="mb-6">
                                    <label class="form-label" for="type">Type</label>
                                    <select class="form-select" name="type" id="type" required>
                                        <option value="">Sélectionner</option>
                                        <option value="Epargne" {{ $compte->type == 'Epargne' ? 'selected' : '' }}>Épargne</option>
                                        <option value="Crédit" {{ $compte->type == 'Crédit' ? 'selected' : '' }}>Crédit</option>
                                        <option value="Débit" {{ $compte->type == 'Débit' ? 'selected' : '' }}>Débit</option>
                                        <option value="Espèce" {{ $compte->type == 'Espèce' ? 'selected' : '' }}>Espèce</option>
                                        <option value="Autre" {{ $compte->type == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        <option value="Investissement" {{ $compte->type == 'Investissement' ? 'selected' : '' }}>Investissement</option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="John Doe" value="{{ $compte->nom }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="solde_initial">Solde initial</label>
                                    <input type="number" name="solde" id="solde_initial" class="form-control" placeholder="5000000" value="{{ $compte->solde }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="numero">N° Compte</label>
                                    <input type="text" name="numero" class="form-control" id="numero" value="{{ $compte->numero }}" required />
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
            </div>
        </div>
    </div>
@endsection
