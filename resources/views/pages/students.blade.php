@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Students table</h6>
                    </div>
                    <div class="container d-flex justify-content-end mb-2 mt-2 align-items-center" style="margin-right:1.5%;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
        <i class="fa fa-plus"></i> Add New
            </button>
        <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fa fa-plus"></i> Upload
        </button>
    </div>
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-head">
            <h5 class="modal-title text-center mt-3" id="customerModalLabel">Add Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="clientForm" action="{{ route('students.store') }}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                    <div id="errors"></div>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Parents Name </label>
                    <input type="text" class="form-control" name="parents_name">
                    <div id="errors"></div>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Class</label>
                    <input type="text" class="form-control" name="class">
                    <div id="errors"></div>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Contact</label>
                    <input type="text" class="form-control" name="contact">
                    <div id="errors"></div>
                  </div>
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Fee Balance</label>
                    <input type="text" class="form-control" name="balance">
                    <div id="errors"></div>
                </div>
       
                <div class="modal-foot d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitForm" class="btn btn-primary ms-2">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           STUDENTS NAME</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            PARENTS NAME</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CLASS</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           CONTACT</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                           FEE BALANCE</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        @include('layouts.footers.auth.footer')
    </div>
    <script>
       
    $(document).ready(function () {
        $('#submitForm').on('click', function () {
            var formData = $('#clientForm').serialize();

            $.ajax({
                url: "{{ route('students.store') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    // Handle success, you might want to update the table or close the modal
                    console.log(response);
                },
                error: function (error) {
                    // Handle errors, you might want to display error messages
                    console.log(error);
                }
            });
        });
    });

    // The rest of your existing script


    function fetchClients(pageNumber, pageSize){
    $.ajax({
        url: "/students/get",
        type: "GET",
        data: {
            page: pageNumber,
            size: pageSize
        },
        dataType: "json",
        success: function(response) {
            $('tbody').empty();
            $.each(response.students, function(index, student) {
                $('tbody').append(
                `
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${student.name}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${student.parents_name}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${student.class}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${student.contact}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${student.balance}</p>
                    </td>
                </tr>
                `
                );
            });

            fillData();
            updatePagination(response.page, response.totalPages, pageSize);
            console.log(response.totalPages);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

    </script>
@endsection
