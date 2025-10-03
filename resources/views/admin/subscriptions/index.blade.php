@extends('layouts.admin')
@section('content')
<div class="content">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.subscriptions.create') }}" style="color: white;">
                        Add Subscription Plans
                    </a>

            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                Subscription List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subscription-dataTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Designer</th>
                                    <th>Design</th>
                                    <th>Price</th>
                                    <th>Days</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    @php
                                    $decodePoints = json_decode($subscription->points);
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td>{{ $subscription->name }}</td>
                                        <td>{{ $subscription->designer }}</td>
                                        <td>{{ $subscription->design }}</td>


                                        <td>{{ $subscription->price }} Tk</td>
                                        <td>{{ $subscription->days }} days</td>
                                        <td>
                                            @foreach($decodePoints as $keyPoints)
                                                <li>{{$keyPoints}}</li>
                                            @endforeach
                                        </td>
                                        @if($subscription->status == 1)
                                        <td>
                                            <span class="badge badge-danger" style="background-color: green">Active</span>
                                        </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger" style="background-color: red">Inactive</span>
                                            </td>
                                        @endif
                                        <td>
                                             <a class="btn btn-xs btn-success" href="{{ route('admin.subscriptions.edit', $subscription->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>

                                            <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], defaultButtons);
@can('category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

initDataTable('#subscription-dataTable', dtButtons);

})

</script>

@endsection
