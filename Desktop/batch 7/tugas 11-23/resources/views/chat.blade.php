<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.min.css" rel="stylesheet">
    <title>Chat CS Dino Market</title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow" style="max-width: 500px; margin: auto;">
        <div class="card-header bg-primary text-white">Chat Customer Service</div>
        <div class="card-body" style="height: 300px; overflow-y: auto;">
            @foreach($messages as $m)
                <div class="{{ $m->sender_id == 1 ? 'text-end' : 'text-start' }} mb-2">
                    <span class="badge {{ $m->sender_id == 1 ? 'bg-primary' : 'bg-secondary' }} p-2">{{ $m->message }}</span>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <form action="/send-message" method="POST" class="d-flex">
                @csrf
                <input type="text" name="message" class="form-control me-2" placeholder="Tulis pesan...">
                <button class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>