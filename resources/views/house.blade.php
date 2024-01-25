@extends('layouts.master')

@section('title', 'House')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">House List</h4>
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
                        House Name
                      </th>
                      <th>
                        Address
                      </th>
                      <th>
                        Total Area
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($houses as $key => $house)
                      <tr>
                        <td>
                          {{ $key + 1}}
                        </td>
                        <td>
                          {{ $house->name}}
                        </td>
                        <td>
                            {{ $house->address}}
                        </td>
                        <td>
                            {{ $house->area}}
                        </td>
                        <td>
                            <button style="border-radius: 0.2rem;" id="{{ $house->id }}" data-name="{{$house->name}}" data-address="{{$house->address}}" data-area="{{$house->area}}" data-toggle="modal" data-target=".bd-example-modal-sm" type="button" class="btn btn-primary btn-sm editModal">Edit</button>
                            <button type="button" onclick="deletehouse({{ $house->id }})" class="btn btn-danger btn-sm">Delete</button>
                            <form id="delete-form-{{ $house->id }}" action="{{ route('house.destroy',$house->id) }}" method="POST" style="display: none;">
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
                                            <h4 class="card-title">Edit House<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                    </button></h4>

                                            {{-- <p class="card-category">Complete your profile</p> --}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('house.update', $house->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {{-- <label class="bmd-label-floating">House Name</label> --}}
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
                    <h4 class="card-title">Add New House</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('house.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">House Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <input name="address" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="bmd-label-floating">Total Area</label>
                                <input name="area" type="text" class="form-control">
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
        function deletehouse(id) {
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
      var houseId = $(this).attr('id');
      var houseName= $(this).data('name');
      var houseAddress= $(this).data('address');
      var houseArea= $(this).data('area');
      $(".card-body #editThisID").val(houseId);
      $(".card-body #editName").val(houseName);
      $(".card-body #editAddress").val(houseAddress);
      $(".card-body #editArea").val(houseArea);
    });
    </script>
@endpush
