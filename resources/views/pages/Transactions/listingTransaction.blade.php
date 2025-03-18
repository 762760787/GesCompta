@extends('layouts.apps')

@section('content')
    <hr class="my-12" />

    <!-- Bootstrap Table with Caption -->
    <div class="card mx-2">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <h5 class="card-header">Liste des transactions liées aux dépenses</h5>
        
        <!-- Formulaire de recherche -->
        <div class="d-flex justify-content-between align-items-center mx-3 my-3">
            <form action="{{ route('transactions.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher une transaction..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
            <a href="{{ route('transactions.create') }}" class="btn btn-success">Nouvelle Dépense</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <caption class="ms-6">
                    Liste des transactions
                </caption>
                <thead class="table-dark">
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Compte</th>
                        <th>Montant</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td><i class="icon-base fab fa-vuejs icon-md text-success me-2"></i>
                                <span>{{ $transaction->description_transaction }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date_transaction)->format('d/m/Y') }}</td>
                            <td>{{ $transaction->nom_compte }}</td>
                            <td>{{ $transaction->montant_transaction }} FCA</td>
                            <td><span class="badge bg-info text-white">{{ $transaction->description_categorie }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('transactions.edit', $transaction->id) }}">
                                            <i class="icon-base bx bx-edit-alt me-1"></i> Modifier</a></li>
                                        <li>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="icon-base bx bx-trash me-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center alert alert-info">Aucune transaction trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
