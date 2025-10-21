
@extends('layouts.app')

@section('content')
<div class="container">
  <h4>Follow Ups for: {{ $lead->title }}</h4>

  <form action="{{ route('followups.store') }}" method="POST" class="mb-4">
    @csrf
    <input type="hidden" name="lead_id" value="{{ $lead->id }}">

    <div class="row mb-2">
      <div class="col-md-3">
        <label>Tanggal</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Jenis</label>
        <select name="type" class="form-select">
          <option value="">-- Pilih --</option>
          <option value="call">Telepon</option>
          <option value="email">Email</option>
          <option value="meeting">Meeting</option>
          <option value="chat">Chat</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Catatan</label>
        <input type="text" name="notes" class="form-control">
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">
      <i class="bi bi-plus"></i> Tambah Follow Up
    </button>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Catatan</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($lead->followUps as $fu)
      <tr>
        <td>{{ $fu->date }}</td>
        <td>{{ ucfirst($fu->type) }}</td>
        <td>{{ $fu->notes }}</td>
      </tr>
      @empty
      <tr><td colspan="3" class="text-center">Belum ada follow up</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
