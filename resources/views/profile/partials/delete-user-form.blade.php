<section class="space-y-6">
    <div style="margin-bottom: 2rem;">
        <p style="font-size: 0.95rem; color: var(--text2); line-height: 1.6;">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="btn-admin btn-admin-danger"
            style="margin-top: 1.5rem; padding: 0.75rem 2rem;"
        >
            <i class="fa-solid fa-user-xmark" style="margin-right: 0.5rem;"></i> {{ __('Hapus Akun Permanen') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2rem; background: var(--bg2); color: var(--text);">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.5rem; font-weight: 800; color: #f87171; margin-bottom: 1rem;">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p style="font-size: 0.95rem; color: var(--text2); margin-bottom: 2rem;">
                {{ __('Tindakan ini tidak dapat dibatalkan. Harap masukkan password Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun Anda secara permanen.') }}
            </p>

            <div class="form-group">
                <label class="form-label" for="password">Password Anda</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input"
                    placeholder="{{ __('Password') }}"
                    required
                >
                @if($errors->userDeletion->has('password'))
                    <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
                @endif
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                <button type="button" x-on:click="$dispatch('close')" class="btn-admin btn-admin-ghost">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="btn-admin btn-admin-danger" style="padding: 0.6rem 1.75rem;">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
