<div>
    <div>
        <h4>Reset Kata Sandi</h4>
        <p>Masukkan kata sandi baru Anda!</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Password">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    placeholder="Password">
            </div>

            <div>
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>
