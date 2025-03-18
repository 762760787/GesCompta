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
        <h5 class="card-header">Liste des Comptes d'Utilisateur</h5>
        
        <div class="table-responsive text-nowrap">
            <table class="table">
                <caption class="ms-6">
                    Liste des Comptes
                </caption>
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td><i class="icon-base fab fa-vuejs icon-md text-success me-4"></i>
                                <span>{{ $user->name }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i
                                            class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('edit.user', $user->id) }}"><i
                                                class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('destroy.user', $user->id) }}"
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
                            <td colspan="3" class="alert alert-info">Aucun Compte trouvée.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
