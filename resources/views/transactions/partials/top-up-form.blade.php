<form action="{{ route('transactions.store', 'type=' . $type->slug) }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email Penerima">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
        @error('amount')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary w-100" type="submit">Send</button>
</form>
