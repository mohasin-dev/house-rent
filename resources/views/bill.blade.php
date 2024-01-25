@extends('layouts.master')

@section('title', 'bill')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">
                    @php
                        $date = \Carbon\Carbon::now();
                        echo $date->subMonth()->format('F');
                    @endphp
                    Month rent collection List</h4>
                {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
              </div>
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
                      <th>
                        Date
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($bills as $key => $bill)
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
                        <td>
                            {{ $bill->date}}
                        </td>
                        <td>
                            <button style="border-radius: 0.2rem;" id="{{ $bill->id }}" data-name="{{$bill->name}}" data-address="{{$bill->address}}" data-area="{{$bill->area}}" data-toggle="modal" data-target=".bd-example-modal-sm" type="button" class="btn btn-primary btn-sm editModal">Edit</button>
                            {{-- <button type="button" onclick="deletebill({{ $bill->id }})" class="btn btn-danger btn-sm">Delete</button>
                            <form id="delete-form-{{ $bill->id }}" action="{{ route('bill.destroy',$bill->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form> --}}
                        </td>
                      </tr>

                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title">Edit bill<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                    </button></h4>

                                            {{-- <p class="card-category">Complete your profile</p> --}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('bill.update', $bill->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{-- <label class="bmd-label-floating">bill Name</label> --}}
                                                        <input type="hidden" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                        <input name="name" id="editName" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        {{-- <label class="bmd-label-floating">Address</label> --}}
                                                        <input name="address" id="editAddress" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        {{-- <label class="bmd-label-floating">Total Area</label> --}}
                                                        <input name="area" id="editArea" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                                            <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">New bill</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('bill.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="user_id" id="editHouse_id" class="form-control" required>
                                <option value="">Select a Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="flat_id" id="editHouse_id" class="form-control" required>
                                <option value="">Select a Flat</option>
                                @foreach ($flats as $flat)
                                <option value="{{ $flat->id }}">{{ $flat->name }} - {{ $flat->rent }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="month" id="editHouse_id" class="form-control" required>
                                <option value="">Select a Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">Auguest</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="bmd-label-floating">Amount</label>
                                <input name="amount" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                {{-- <label class="bmd-label-floating">Date</label> --}}
                                <input name="date" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <div class="clearfix"></div>
                    </form>
                </div>
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
