@extends('layouts.master')

@section('title', 'customer')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">customer List</h4>
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
                        customer Name
                      </th>
                      <th>
                        Address
                      </th>
                      <th>
                        Phone
                      </th>
                      <th>
                       Advanced
                      </th>
                      <th>
                       NID
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($customers as $key => $customer)
                      <tr>
                        <td>
                          {{ $key + 1}}
                        </td>
                        <td>
                          {{ $customer->name}}
                        </td>
                        <td>
                            {{ $customer->address}}
                        </td>
                        <td>
                            {{ $customer->phone}}
                        </td>
                        <td>
                            {{ $customer->advanced}}
                        </td>
                        <td>
                            <img width="70" src="{{ asset('images/'. $customer->image) }}">
                        </td>
                        <td>
                            <button style="border-radius: 0.2rem;" id="{{ $customer->id }}" data-name="{{$customer->name}}" data-email="{{$customer->email}}" data-address="{{$customer->address}}" data-phone="{{$customer->phone}}" data-nid="{{$customer->nid}}" data-advanced="{{$customer->advanced}}" data-note="{{$customer->note}}"  data-toggle="modal" data-target=".bd-example-modal-sm" type="button" class="btn btn-primary btn-sm editModal">Edit</button>
                            <button type="button" onclick="deletecustomer({{ $customer->id }})" class="btn btn-danger btn-sm">Delete</button>
                            <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy',$customer->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                      </tr>

                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title">Edit customer<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                    </button></h4>

                                            {{-- <p class="card-category">Complete your profile</p> --}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                            <input name="name" id="editName" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="email" id="editEmail" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="address" id="editAddress" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="phone" id="editPhone" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="nid" id="editNid" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="advanced" id="editAdvanced" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="note" id="editNote" type="text" class="form-control">
                                                        </div>
                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div>
                                                                <span class="">
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <input type="file" name="image"/>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary pull-right">Update</button>
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
                    <h4 class="card-title">Add New customer</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Customer Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input name="email" type="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Address</label>
                                    <textarea name="address" type="text" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">NID No.</label>
                                    <input name="nid" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Advanced</label>
                                    <input name="advanced" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Note</label>
                                    <input name="note" type="text" class="form-control">
                                </div>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div>
                                        <span class="">
                                            <span class="fileinput-new">Select image</span>
                                            <input type="file" name="image"/>
                                        </span>
                                    </div>
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
        function deletecustomer(id) {
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
      var customerId = $(this).attr('id');
      var customerName= $(this).data('name');
      var customerEmail= $(this).data('email');
      var customerAddress= $(this).data('address');
      var customerPhone= $(this).data('phone');
      var customerNid= $(this).data('nid');
      var customerAdvanced= $(this).data('advanced');
      var customerNote= $(this).data('note');
      $(".card-body #editThisID").val(customerId);
      $(".card-body #editName").val(customerName);
      $(".card-body #editEmail").val(customerEmail);
      $(".card-body #editAddress").val(customerAddress);
      $(".card-body #editPhone").val(customerPhone);
      $(".card-body #editNid").val(customerNid);
      $(".card-body #editAdvanced").val(customerAdvanced);
      $(".card-body #editNote").val(customerNote);
    });
    </script>
@endpush
