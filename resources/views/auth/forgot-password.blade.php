<div>
    <div>

        <h4>Reset Kata Sandi</h4>
        <p>Masukkan email Anda untuk mendapatkan link reset kata sandi</p>

        <form id="formAuthentication" action="{{ route('password.email') }}" method="POST">
            @csrf

            @if (session('status'))
                <script>
                    alert('{{ session('status') }}');
                </script>
            @endif

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan Email Anda">
                @error('email')
                    <script>
                        alert('{{ $message }}');
                    </script>
                @enderror
            </div>

            <button type="submit">
                Kirim Link Reset Kata Sandi
            </button>
        </form>

        <div>
            <a href="{{ route('login') }}">
                <span>Kembali ke Login</span>
            </a>
        </div>
    </div>
</div>
