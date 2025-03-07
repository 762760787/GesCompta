@extends('layouts.apps')

@section('content')
    <hr class="my-12" />

    <!-- Bootstrap Table with Caption -->
    <div class="card ms-2 me-2">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <h5 class="card-header">Liste des transactions liées aux dépenses</h5>
        <div class="col-12 " style="position: absolute; margin-left: 70rem">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Nouvelle Dépense</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <caption class="ms-6">
                    Liste des effecteurs de transaction
                </caption>
                <thead>
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
                            <td><i class="icon-base fab fa-vuejs icon-md text-success me-4"></i>
                                <span>{{ $transaction->description_transaction }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date_transaction)->format('d/m/Y') }}</td>
                            <td>{{ $transaction->nom_compte }}</td>
                            <td>{{ $transaction->montant_transaction }} FCA</td>

                            <td><span class="badge bg-label-info me-1">{{ $transaction->description_categorie }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i
                                            class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('transactions.edit', $transaction->id) }}"><i
                                                class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                            class="dropdown-item" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-3"><i
                                                    class="icon-base bx bx-trash me-1"></i> Delete</a></button>
                                        </form>
                                        <a href="javascript:void(0);">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="alert alert-info">Aucune Transaction trouvée.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
