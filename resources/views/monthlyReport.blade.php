@extends('layouts.master')

@section('title', 'Monthly Report')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
                @if ((!empty($monthlyReport)))
              <div class="card-header">
                <form action="{{ route('monthlyReport.store') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col">
                        <input type="date" name="from_date" value="{{ $from_date }}" class="form-control" placeholder="Start Date">
                      </div>
                      <div class="col">
                        <input type="date" name="to_date" value="{{ $to_date }}" class="form-control" placeholder="End Date">
                      </div>
                      <div class="col">
                        <input type="submit" class="btn btn-primary" value="Search">
                      </div>
                    </div>
                </form>
              </div>
              @else
                <div class="card-header">
                    <form action="{{ route('monthlyReport.store') }}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col">
                            <input type="date" name="from_date" class="form-control" placeholder="Start Date">
                          </div>
                          <div class="col">
                            <input type="date" name="to_date" class="form-control" placeholder="End Date">
                          </div>
                          <div class="col">
                            <input type="submit" class="btn btn-primary" value="Search">
                          </div>
                        </div>
                    </form>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                @if ((!empty($monthlyReport)))
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <th>
                          ID
                        </th>
                        <th>
                          Customer Name
                        </th>
                        <th>
                          Flat Name
                        </th>
                        <th>
                          Amount
                        </th>

                      </thead>
                      <tfoot>
                        <th colspan="4" class="text-right">
                            Total Collection: {{ $total_amount }}
                        </th>
                      </tfoot>
                      <tbody>
                      @foreach ($monthlyReport as $key => $bill)
                        <tr>
                          <td>
                            {{ $key + 1}}
                          </td>
                          <td>
                            {{ $bill->user->name}}
                          </td>
                          <td>
                              {{ $bill->flat->name}}
                          </td>
                          <td>
                              {{ $bill->amount}}
                          </td>

                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                @else
                <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead class="">
                              <th>
                                ID
                              </th>
                              <th>
                                Customer Name
                              </th>
                              <th>
                                Flat Name
                              </th>
                              <th>
                                Amount
                              </th>
                            </thead>
                          </table>
                        </div>
                      </div>
                @endif
              </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        function deletebill(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

    <script>
        $(document).on("click", ".editModal", function () {
      var billId = $(this).attr('id');
      var billName= $(this).data('name');
      var billAddress= $(this).data('address');
      var billArea= $(this).data('area');
      $(".card-body #editThisID").val(billId);
      $(".card-body #editName").val(billName);
      $(".card-body #editAddress").val(billAddress);
      $(".card-body #editArea").val(billArea);
    });
    </script>
@endpush
