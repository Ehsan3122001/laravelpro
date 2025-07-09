<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="{{ $id ?? 'dataTable' }}" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                        @if(isset($actions)) <th>Actions</th> @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $index => $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                            @if(isset($actions))
                                <td>
                                    @foreach ($actions as $action)
                                        <form method="POST" action="{{ route($action['route'], $row[0]) }}" style="display:inline;">
                                            @csrf
                                            @method($action['method'] ?? 'POST')
                                            <button type="submit" class="btn btn-sm btn-{{ $action['class'] ?? 'danger' }}" onclick="return confirm('{{ $action['confirm'] ?? 'Are you sure ?' }}')">
                                                {{ $action['label'] }}
                                            </button>
                                        </form>
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
