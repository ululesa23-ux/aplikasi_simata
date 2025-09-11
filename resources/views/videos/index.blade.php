<!DOCTYPE html>
<html>
<head>
    <title>Daftar Video</title>
</head>
<body>
    <h1>Video Terbaru</h1>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('videos.index') }}">
        <input type="text" name="q" placeholder="Cari video..." value="{{ request('q') }}">
        <button type="submit">Search</button>
    </form>

    <hr>

    {{-- List Video --}}
    @forelse ($videos as $video)
        <h3>{{ $video['title'] }}</h3>
        <iframe width="560" height="315"
            src="{{ str_replace('watch?v=', 'embed/', $video['link']) }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
        <p><small>Dipublikasikan: {{ \Carbon\Carbon::parse($video['published'])->translatedFormat('d F Y H:i') }}</small></p>
        <hr>
    @empty
        <p>Tidak ada video.</p>
    @endforelse
</body>
</html>
