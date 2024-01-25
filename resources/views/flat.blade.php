@extends('layouts.master')

@section('title', 'Flat')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title mt-0">flat List</h4>
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
                        flat Name
                      </th>
                      <th>
                        Rent
                      </th>
                      <th>
                       Total Room
                      </th>
                      <th>
                       floor Name
                      </th>
                      <th>
                       House Name
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($flats as $key => $flat)
                      <tr>
                        <td>
                          {{ $key + 1}}
                        </td>
                        <td>
                          {{ $flat->name}}
                        </td>
                        <td>
                            {{ $flat->rent}}
                        </td>
                        <td>
                            {{ $flat->room_number}}
                        </td>
                        <td>
                            {{ $flat->floor->name}}
                        </td>
                        <td>
                            {{ $flat->floor->house->name}}
                        </td>
                        <td>
                            <button style="border-radius: 0.2rem;" id="{{ $flat->id }}" data-name="{{$flat->name}}" data-room_number="{{$flat->room_number}}" data-area="{{$flat->area}}" data-floor_id="{{$flat->floor_id}}" data-rent="{{$flat->rent}}" data-electricity_bill="{{$flat->electricity_bill}}" data-gass_bill="{{$flat->gass_bill}}" data-water_bill="{{$flat->water_bill}}" data-others_bill="{{$flat->others_bill}}" data-toggle="modal" data-target=".bd-example-modal-sm" type="button" class="btn btn-primary btn-sm editModal">Edit</button>
                            <button type="button" onclick="deleteflat({{ $flat->id }})" class="btn btn-danger btn-sm">Delete</button>
                            <form id="delete-form-{{ $flat->id }}" action="{{ route('flat.destroy',$flat->id) }}" method="POST" style="display: none;">
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
                                            <h4 class="card-title">Edit flat<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                    </button></h4>

                                            {{-- <p class="card-category">Complete your profile</p> --}}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('flat.update', $flat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                            <input name="name" id="editName" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="area" id="editArea" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="room_number" id="editRoom_number" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="rent" id="editRent" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="electricity_bill" id="editElectricity_bill" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="gass_bill" id="editGass_bill" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="water_bill" id="editWater_bill" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="others_bill" id="editOthers_bill" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">

                                                            <select name="floor_id" id="editfloor_id" class="form-control" required>
                                                            <option value="">Select a floor</option>
                                                            @foreach ($floors as $floor)
                                                            <option value="{{ $floor->id }}" {{ $floor->id ==  $flat->floor_id ? 'selected' : ''}}>{{ $floor->name }}</option>
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
                    <h4 class="card-title">Add New Flat</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('flat.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Flat Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Area</label>
                                    <input name="area" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Room</label>
                                    <input name="room_number" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Rent</label>
                                    <input name="rent" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Electricity Bill</label>
                                    <input name="electricity_bill" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Gass Bill</label>
                                    <input name="gass_bill" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Water Bill</label>
                                    <input name="water_bill" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Others Bill</label>
                                    <input name="others_bill" type="text" class="form-control">
                                </div>
                                <div class="form-group">

                                    <select name="floor_id" class="form-control" required>
                                    <option value="">Select a floor</option>
                                    @foreach ($floors as $floor)
                                    <option value="{{ $floor->id }}">{{ $floor->name }}</option>
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
        function deleteflat(id) {
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
      var flatId = $(this).attr('id');
      var flatName= $(this).data('name');
      var flatArea= $(this).data('area');
      var flatRent= $(this).data('rent');
      var flatElectricity_bill= $(this).data('electricity_bill');
      var flatGass_bill= $(this).data('gass_bill');
      var flatWater_bill= $(this).data('water_bill');
      var flatOthers_bill= $(this).data('others_bill');
      var flatRoom_number= $(this).data('room_number');
      var flatfloor_id= $(this).data('floor_id');
      $(".card-body #editThisID").val(flatId);
      $(".card-body #editName").val(flatName);
      $(".card-body #editArea").val(flatArea);
      $(".card-body #editRent").val(flatRent);
      $(".card-body #editElectricity_bill").val(flatElectricity_bill);
      $(".card-body #editGass_bill").val(flatGass_bill);
      $(".card-body #editWater_bill").val(flatWater_bill);
      $(".card-body #editOthers_bill").val(flatOthers_bill);
      $(".card-body #editRoom_number").val(flatRoom_number);
      $(".card-body #editfloor_id").val(flatfloor_id);
    });
    </script>
@endpush
