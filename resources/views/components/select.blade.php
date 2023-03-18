<div class="mb-3">
    <div class="form-label"> {{ $title }} </div>
    <select name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        {{ $slot }}
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
