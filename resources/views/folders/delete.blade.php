@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを削除しますか？</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form
                action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                method="POST"
            >
              @csrf
              
              <div class="text-center">
                <button type="submit" class="btn btn-primary">はい</button>
              </div>
              
              
            
            </form>
            <form
                action="{{ route('tasks.index', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                method="GET"
            >
              @csrf
              
              <div class="text-center">
                <button type="submit" class="btn btn-primary">いいえ</button>
              </div>
              
              
            
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection
