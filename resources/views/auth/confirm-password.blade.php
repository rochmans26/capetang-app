<div>
    <div>
        {{ __('Silahkan konfirmasi kata sandi Anda sebelum melanjutkan') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Masukkan Kata Sandi Anda">
            @error('password')
                <script>
                    alert('{{ $message }}');
                </script>
            @enderror
        </div>

        <div>
            <button type="submit">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</div>
