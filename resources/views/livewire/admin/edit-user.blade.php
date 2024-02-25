<div>
    <form wire:submit.prevent="update">
        @csrf

        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" wire:model.defer="user.name">
            @error('user.name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" wire:model.defer="user.email">
            @error('user.email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="bio">Biografía:</label>
            <textarea id="bio" wire:model.defer="user.bio"></textarea>
            @error('user.bio') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="twitter">Twitter:</label>
            <input type="url" id="twitter" wire:model.defer="user.twitter">
            @error('user.twitter') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" wire:model.defer="user.password">
            @error('user.password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" wire:model.defer="user.password_confirmation">
        </div>

        <button type="submit">Guardar cambios</button>
    </form>
</div>