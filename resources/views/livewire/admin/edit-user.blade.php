<div>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile">
        <!-- Add your form fields here, for example: -->
        <div>
            <label for="name">Name:</label>
            <input wire:model="name" type="text" id="name" name="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input wire:model="email" type="email" id="email" name="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Add other form fields as needed -->

        <div>
            <button type="submit">Update User</button>
        </div>
    </form>
</div>