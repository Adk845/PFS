<x-app-layout>
    <style>
        body {
            background-color: #fdf6f6;
        }

        .proposal-container {
            max-width: 1200px;
            margin: 40px auto;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(136, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #880000, #b33333);
            color: #fff;
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .card-body {
            background-color: #fff;
            padding: 2rem;
        }

        .card-body p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .card-body strong {
            color: #880000;
        }

        .attached-files .file-box {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            background-color: #fafafa;
            transition: all 0.2s ease;
        }

        .attached-files .file-box:hover {
            background-color: #fff;
            box-shadow: 0 3px 10px rgba(136, 0, 0, 0.1);
        }

        .file-icon {
            font-size: 2rem;
            color: #b33333;
            margin-right: 15px;
        }

        .file-info {
            flex-grow: 1;
        }

        .file-info .file-name {
            font-weight: 600;
            color: #880000;
            text-decoration: none;
        }

        .file-info .file-name:hover {
            text-decoration: underline;
        }

        .file-meta {
            font-size: 0.9rem;
            color: #777;
        }

        .missing {
            color: #b30000;
            font-weight: 600;
        }

        .btn-secondary {
            background-color: #880000;
            border: none;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #b30000;
        }

        .section-title {
            color: #880000;
            border-bottom: 3px solid #b33333;
            display: inline-block;
            padding-bottom: 4px;
            margin-bottom: 20px;
        }
    </style>

    <div class="proposal-container">
        <h1 class="section-title mb-4">
            <i class="bi bi-file-earmark-text-fill me-2"></i> Proposal Details
        </h1>

        <div class="card mb-6">
            <div class="card-header">
                {{ $proposal->title }}
            </div>
            <div class="card-body">
                <p><strong>Status :</strong> <br> {{ $proposal->status ?? '-' }}</p>
                <p><strong>PIC  :</strong>  <br>{{ optional($proposal->assignedUser)->name ?? '-' }}</p>
                <p>
                    <strong>Lead Info: <br></strong>
                    {{ optional($proposal->lead?->crm)->name ?? '-' }}
                    <small class="text-danger">{{ optional($proposal->lead?->crm)->company ?? '-' }}</small>
                </p>
                <p><strong>Description:</strong><br>{!! nl2br(e($proposal->description)) !!}</p>

                <div class="attached-files mt-4">
                    <h5 class="mb-3"><i class="bi bi-paperclip me-1"></i><strong>Attached Files</strong> </h5>

                    @if($proposal->files && $proposal->files->count() > 0)
                        @foreach($proposal->files as $file)
                            @php
                                $disk = 'public';
                                $exists = \Illuminate\Support\Facades\Storage::disk($disk)->exists($file->file_path);

                                try {
                                    $size = $exists 
                                        ? number_format(\Illuminate\Support\Facades\Storage::disk($disk)->size($file->file_path) / 1024, 1) . ' KB' 
                                        : 'Unknown';
                                    $lastModified = $exists 
                                        ? date('d M Y, H:i', \Illuminate\Support\Facades\Storage::disk($disk)->lastModified($file->file_path)) 
                                        : '-';
                                } catch (Exception $e) {
                                    $size = 'Unknown';
                                    $lastModified = '-';
                                }

                                $extension = pathinfo($file->file_name, PATHINFO_EXTENSION);
                                $icon = match($extension) {
                                    'pdf' => 'bi bi-filetype-pdf',
                                    'doc', 'docx' => 'bi bi-filetype-docx',
                                    'xls', 'xlsx' => 'bi bi-filetype-xlsx',
                                    'zip', 'rar' => 'bi bi-file-zip',
                                    'png', 'jpg', 'jpeg' => 'bi bi-file-earmark-image',
                                    default => 'bi bi-file-earmark'
                                };
                            @endphp

                            <div class="file-box">
                                <i class="{{ $icon }} file-icon"></i>
                                <div class="file-info">
                                    @if($exists)
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="file-name">
                                            {{ $file->file_name }}
                                        </a>
                                        <div class="file-meta">
                                            Size: {{ $size }} &nbsp; | &nbsp; Last Modified: {{ $lastModified }}
                                        </div>
                                    @else
                                        <div class="file-name missing">
                                            {{ $file->file_name }} (File Missing)
                                        </div>
                                        <div class="file-meta">
                                            Size: {{ $size }} &nbsp; | &nbsp; Last Modified: {{ $lastModified }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No files attached.</p>
                    @endif
                </div>
            </div>
        </div>

        <a href="{{ route('proposals.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to List
        </a>
    </div>
</x-app-layout>
