@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-6 mb-6">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">Nouveau Revenu</h5>
                        <div class="card-body">
                            <form action="{{ route('transactionsRevenu.store') }}" method="POST" class="browser-default-validation">
                                @csrf
                                @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                                @endif 
                               
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif 
                                    

                                    <div class="mb-6">
                                        <label class="form-label" for="idcategorie">Choisissez une Catégorie</label>
                                        <select class="form-select" name="idcategorie" id="idcategorie" required>
                                            <option value="">Sélectionner</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" name="description" class="form-control" id="description"
                                            placeholder="Description" required />
                                    </div>
                                    <div class="mb-6 form-password-toggle">
                                        <label class="form-label" for="montant">Montant</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" name="montant" id="montant" class="form-control"
                                                placeholder="234.0" aria-describedby="montant" required />
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="date">Date</label>
                                        <input type="date" id="date" name="date" class="form-control"
                                            placeholder="Date trans" required />
                                    </div>
                                    {{-- <div class="mb-6">
                                        <label class="form-label" for="idcompte">Compte</label>
                                        <select class="form-select" name="idcompte" id="idcompte" required>
                                            <option value="">Sélectionner</option>
                                            @foreach ($comptes as $compte)
                                                <option value="{{ $compte->id }}">{{ $compte->nom }} {{ $compte->solde }}FCFA</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
