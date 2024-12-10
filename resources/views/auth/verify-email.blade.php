<div>
    <div>
        <div>
            Terima kasih sudah mendaftar! Sebelum memulai, anda dapat memverifikasi alamat email Anda dengan menekan
            link yang kami kirimkan. Jika Anda tidak menerima email, kami akan mengirimkan email yang berbeda.
        </div>

        @if (session('status') == 'verification-link-sent')
            <script>
                alert('{{ __('Email verifikasi berhasil dikirimkan, silahkan cek email Anda.') }}');
            </script>
        @endif

        <div>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit">{{ __('Kirim Ulang Email Verifikasi') }}</button>
            </form>


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>
    </div>
</div>
