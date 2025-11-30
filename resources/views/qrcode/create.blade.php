<form action="{{ route('qrcode.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}">
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror
    <br><br>
    <label for="url">URL:</label>
    <input type="text" id="url" name="url" value="{{ old('url') }}">
    @error('url')
        <div class="error">{{ $message }}</div>
    @enderror
    <br><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description">{{ old('description') }}</textarea>
    @error('description')
        <div class="error">{{ $message }}</div>
    @enderror
    <br><br>
    <input type="submit" value="Generate QR Code">
</form>
