<x-app-layout>

@section('content')
<div class="container">
    <h1 class="mb-4">Proposal Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            <strong>{{ $proposal->title }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> {{ $proposal->status ?? '-' }}</p>
            
            <p>
                <strong>Assigned To:</strong> 
                {{ optional($proposal->assignedUser)->name ?? '-' }}
            </p>

            <p>
                <strong>Lead Info:</strong><br>
                {{ optional($proposal->lead?->crm)->name ?? '-' }}<br>
                <small>{{ optional($proposal->lead?->crm)->company_name ?? '-' }}</small>
            </p>

            <p>
                <strong>Description:</strong><br>
                {!! nl2br(e($proposal->description)) !!}
            </p>

            @if($proposal->attachment)
                <p>
                    <strong>Attachment:</strong>
                    <a href="{{ asset('storage/' . $proposal->attachment) }}" target="_blank">
                        Download
                    </a>
                </p>
            @endif
        </div>
    </div>

    <a href="{{ route('proposals.index') }}" class="btn btn-secondary">Back to List</a>
</div>
</x-app-layout>
