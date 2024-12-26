@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-warning"></i>
                    Quest
                </h1>

                <a href="javascript:history.back()" class="btn btn-success d-inline-flex align-items-center" role="button"
                    title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back
                </a>
            </div>
            <hr>
            <div class="row">
                @foreach ($semuaQuest as $quest)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">#{{ $quest->id }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $quest->nama_quest }}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $quest->point . ' Point' }}</h6>
                                <p class="card-text">{{ $quest->deskripsi }}</p>
                                <div class="card-link">
                                    @if (auth()->user()->quest()->where('id_quest', $quest->id)->exists())
                                        <a href="{{ route('users.detail-quest', $quest->id) }}">Status quest</a>
                                    @else
                                        <a href="{{ route('quest.show', $quest->id) }}">Detail quest</a>
                                    @endif
                                    @haspermission('ambil-quest')
                                        <form action="{{ route('users.ambil-quest', $quest->id) }}" method="post">
                                            @csrf
                                            @method('post')

                                            <button type="submit" class="btn btn-primary btn-sm">Ambil Quest</button>
                                        </form>
                                    @endhaspermission
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- end of header --}}
@endsection
@section('customize-script')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif
@endsection
