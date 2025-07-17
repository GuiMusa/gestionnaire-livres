@extends('layouts.app')

@section('titre', 'Livres de l\'auteur')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1>Livres de {{ $author->name }}</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un nouveau livre
        </a>
    </div>
</div>

<div class="row">
    @foreach($author->books as $book)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">{{ $book->titre }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-info text-dark">Année: {{ $book->annee }}</span>
                    <span class="badge @switch($book->statut)
                            @case('lu') bg-success @break
                            @case('en cours') bg-warning text-dark @break
                            @default bg-secondary
                        @endswitch">
                        {{ ucfirst($book->statut) }}
                    </span>
                </div>
                
                @if($book->favori)
                    <span class="badge bg-danger mb-2"><i class="bi bi-heart-fill"></i> Favori</span>
                @endif
                
                @if($book->note)
                    <div class="mb-3">
                        <p class="text-muted">{{ Str::limit($book->note, 100) }}</p>
                    </div>
                @endif
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($author->books->isEmpty())
<div class="alert alert-info">
    Aucun livre trouvé pour cet auteur.
</div>
@endif


@endsection