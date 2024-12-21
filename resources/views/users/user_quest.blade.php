@extends('layouts.main')
@section('customize-style')
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            /* Pastikan padding termasuk dalam ukuran total */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="container shadow h-auto rounded">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center mt-3">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-warning"></i>
                    Quest Aktif
                </h1>

                <a href="{{ route('users.list-quest') }}" class="btn btn-success d-inline-flex align-items-center"
                    role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back
                </a>
            </div>
            <hr>
            {{-- end of header --}}
            <div class="row">
                @if ($questTersedia->isEmpty())
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">Anda Tidak Memiliki Quest Aktif</div>
                        </div>
                    </div>
                @else
                    @foreach ($questTersedia as $quest)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="title d-flex justify-content-between align-items-center mt-5">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-warning"></i>
                    Quest Tidak Aktif
                </h1>
            </div>
            <hr>
            <div class="row">
                @if ($questKadaluarsa->isEmpty())
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">Anda Tidak Memiliki Quest Tidak Aktif</div>
                        </div>
                    </div>
                @else
                    @foreach ($questKadaluarsa as $quest)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="title d-flex justify-content-between align-items-center mt-5">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-warning"></i>
                    Quest Yang Telah Diselesaikan
                </h1>
            </div>
            <hr>
            <div class="row">
                @if ($questDiSelesaikan->isEmpty())
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">Anda Belum Pernah Menyelesaikan Quest</div>
                        </div>
                    </div>
                @else
                    @foreach ($questDiSelesaikan as $quest)
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
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
