@extends('layouts.master')

@section('title', 'Floor')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">Floor List</h4>
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
                        Floor Name
                      </th>
                      <th>
                        Total Area
                      </th>
                      <th>
                       Total Flat
                      </th>
                      <th>
                       House Name
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($floors as $key => $floor)
                      <tr>
                        <td>
                          {{ $key + 1}}
                        </td>
                        <td>
                          {{ $floor->name}}
                        </td>
                        <td>
                            {{ $floor->area}}
                        </td>
                        <td>
                            {{ $floor->flat_number}}
                        </td>
                        <td>
                            {{ $floor->house->name}}
                        </td>
                        <td>
                            <button style="border-radius: 0.2rem;" id="{{ $floor->id }}" data-name="{{$floor->name}}" data-flat_number="{{$floor->flat_number}}" data-area="{{$floor->area}}" data-house_id="{{$floor->house_id}}" data-toggle="modal" data-target=".bd-example-modal-sm" type="button" class="btn btn-primary btn-sm editModal">Edit</button>
                            <button type="button" onclick="deletefloor({{ $floor->id }})" class="btn btn-danger btn-sm">Delete</button>
                            <form id="delete-form-{{ $floor->id }}" action="{{ route('floor.destroy',$floor->id) }}" method="POST" style="display: none;">
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
                                            <h4 class="card-title">Edit floor<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                    </button></h4>

                                            {{-- <p class="card-category">Complete your profile</p> --}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('floor.update', $floor->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                            <input name="name" id="editName" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="area" id="editArea" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="flat_number" id="editFlat_number" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">

                                                            <select name="house_id" id="editHouse_id" class="form-control" required>
                                                            <option value="">Select a house</option>
                                                            @foreach ($houses as $house)
                                                            <option value="{{ $house->id }}" {{ $house->id ==  $floor->house_id ? 'selected' : ''}}>{{ $house->name }}</option>
                                                            @endforeach

                                                            </select>
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
                    <h4 class="card-title">Add New Floor</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('floor.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Floor Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Area</label>
                                    <input name="area" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Flat</label>
                                    <input name="flat_number" type="text" class="form-control">
                                </div>
                                <div class="form-group">

                                    <select name="house_id" class="form-control" required>
                                    <option value="">Select a house</option>
                                    @foreach ($houses as $house)
                                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                                    @endforeach

                                    </select>
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
        function deletefloor(id) {
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
      var floorId = $(this).attr('id');
      var floorName= $(this).data('name');
      var floorArea= $(this).data('area');
      var floorFlat_number= $(this).data('flat_number');
      var floorHouse_id= $(this).data('house_id');
      $(".card-body #editThisID").val(floorId);
      $(".card-body #editName").val(floorName);
      $(".card-body #editArea").val(floorArea);
      $(".card-body #editFlat_number").val(floorFlat_number);
      $(".card-body #editHouse_id").val(floorHouse_id);
    });
    </script>
@endpush
