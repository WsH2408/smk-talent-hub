<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #2563EB; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #1E3A8A; font-size: 28px; }
        .header p { margin: 5px 0; color: #666; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 18px; font-weight: bold; color: #2563EB; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
        .skill-tag { display: inline-block; background: #EFF6FF; color: #1D4ED8; padding: 4px 10px; border-radius: 12px; font-size: 12px; margin: 2px; }
        .project { margin-bottom: 15px; }
        .project h3 { margin: 0 0 5px 0; font-size: 16px; }
        .project p { margin: 0; font-size: 14px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $user->name }}</h1>
        <p>{{ $profile->tagline ?? 'Siswa SMK' }} | {{ $profile->jurusan ?? 'Jurusan' }}</p>
        <p>Email: {{ $user->email }} | Phone: {{ $profile->phone ?? '-' }}</p>
    </div>

    <div class="section">
        <div class="section-title">Keahlian (Skills)</div>
        @foreach($skills as $skill)
            <span class="skill-tag">{{ $skill->name }}</span>
        @endforeach
    </div>

    <div class="section">
        <div class="section-title">Portofolio Proyek</div>
        @foreach($projects as $project)
            <div class="project">
                <h3>{{ $project->judul }} ({{ $project->category->name }})</h3>
                <p>{{ $project->deskripsi }}</p>
                @if($project->link_demo)
                    <p style="font-size: 12px; color: #2563EB;">Link: {{ $project->link_demo }}</p>
                @endif
            </div>
        @endforeach
    </div>
</body>
</html>