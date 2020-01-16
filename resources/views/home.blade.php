@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{$businessStudentStatuses[0]->business->name}} {{ucfirst(trans('messages.dashboard'))}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>{{ucwords(trans('messages.student_job_suitability'))}}</h4>

                    <table class="table table-responsive" id="cook">

                        <thead>
                            <th class="col-md-4">{{ucfirst(trans('messages.student'))}}</th>
                            <th class="col-md-2">{{ucfirst(trans('messages.status'))}}</th>
                            <th class="col-md-3">{{ucwords(trans('messages.last_updated'))}}</th>
                            <th class="col-md-3">{{ucwords(trans('messages.updated_by'))}}</th>
                        </thead>

                        <tbody>

                            @foreach($businessStudentStatuses as $businessStudentStatus)
                                <tr class="business-student-status col-md-12">

                                    <td class="col-md-4">
                                        {{$businessStudentStatus->student->name}}
                                    </td>

                                    <td class="col-md-2">
                                        <select class="job-status" id="job-status-{{$businessStudentStatus->student_id}}"
                                                data-business-id="{{$businessStudentStatus->business_id}}"
                                                data-student-id="{{$businessStudentStatus->student_id}}"
                                                data-employee-id="{{$employee->id}}"
                                        >
                                            @foreach($jobStatuses as $jobStatusId => $jobStatus)
                                               <option value="{{$jobStatusId}}"
                                               {{( $jobStatusId == $businessStudentStatus->status_id) ? 'selected' : '' }}
                                               >{{ucfirst($jobStatus)}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="col-md-3">
                                        {{ $businessStudentStatus->updated_at->diffForHumans() }}
                                    </td>

                                    <td class="col-md-3">
                                        {{ $businessStudentStatus->employee->name }}
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
@endsection

@section('script')

    <script type="text/javascript">

        var config = (function() {
            return {
                updateStudentJobStatus: "{{ route('update.student.status')}}",
            }
        }());


        $(document).ready(function() {

            ScrollReveal().reveal('.business-student-status', { interval: 15 });

            $('.job-status').on('change', function () {

                var business_id = $(this).attr('data-business-id');

                var student_id = $(this).attr('data-student-id');

                var status_id = $('#job-status-' + student_id).val();

                var employee_id = $(this).attr('data-employee-id');

                var data = {
                    businessId : business_id,
                    studentId: student_id,
                    statusId : status_id,
                    employeeId : employee_id
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    data: data,
                    url: config.updateStudentJobStatus,
                    success: function (data) {

                        console.log(data);

                        if(data.state === 'success') {
                            toastr.success(data.message);
                        } else if(data.state === 'error') {
                            toastr.error(data.message);
                        }

                    }
                });

            });



        });

    </script>

@endsection
