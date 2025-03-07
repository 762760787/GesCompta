@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-6">
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Ajouter Un Compte</h5>
                        <div class="card-body">
                            <form action="{{ route('comptes.store') }}" method="POST" class="browser-default-validation">
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
                                    <label class="form-label" for="type">Type</label>
                                    <select class="form-select" name="type" id="type" required>
                                        <option value="">Sélectionner</option>
                                        <option value="Epargne">Épargne</option>
                                        <option value="Crédit">Crédit</option>
                                        <option value="Débit">Débit</option>
                                        <option value="Espèce">Espèce</option>
                                        <option value="Autre">Autre</option>
                                        <option value="Investissement">Investissement</option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" id="nom"
                                        placeholder="John Doe" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="solde_initial">Solde initial</label>
                                    <input type="number" name="solde" id="solde_initial" class="form-control"
                                        placeholder="5000000" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="numero">N° Compte</label>
                                    <input type="text" name="numero" class="form-control" id="numero" required />
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
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

                        <h5 class="card-header">Tous mes Comptes</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type Compte</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                        <th>Numero</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($comptes as $compte)
                                        <tr>
                                            <td>{{ $compte->type }}</td>
                                            <td>{{ $compte->nom }}</td>
                                            <td>{{ $compte->solde }}</td>
                                            <td>{{ $compte->numero }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('comptes.edit', $compte->id) }}">
                                                            <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <form action="{{ route('comptes.destroy', $compte->id) }}"
                                                            class="dropdown-item" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger mt-3"><i
                                                                    class="icon-base bx bx-trash me-1"></i>Supprimer</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="alert alert-info">Aucun Compte trouvé.</td>
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
