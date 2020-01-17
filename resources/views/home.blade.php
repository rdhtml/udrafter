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

                    <div class="business-student-status-container">

                        <div class="business-student-status-header col-md-12">
                            <div class="col-md-5 col-sm-5 float-md-left">{{ucfirst(trans('messages.student'))}}</div>
                            <div class="col-md-2 col-sm-2 float-md-left">{{ucfirst(trans('messages.status'))}}</div>
                            <div class="col-md-2 col-sm-2 float-md-left updated">{{ucwords(trans('messages.last_updated'))}}</div>
                            <div class="col-md-3 col-sm-3 float-md-left updated-by">{{ucwords(trans('messages.updated_by'))}}</div>
                        </div>

                        @foreach($businessStudentStatuses as $businessStudentStatus)
                            <div class="business-student-status col-md-12">

                                <div class="col-md-5 col-sm-5 float-md-left">{{$businessStudentStatus->student->name}}</div>

                                <div class="col-md-2 col-sm-2 float-md-left">
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
                                </div>

                                <div class="col-md-2 col-sm-2 float-md-left updated" id="updated-{{$businessStudentStatus->student_id}}"
                                     title="{{dateFormattingWithTime($businessStudentStatus)}}">
                                    {{dateFormatting($businessStudentStatus)}}
                                </div>

                                <div class="col-md-3 col-sm-3 float-md-left updated-by" id="updated-by-{{$businessStudentStatus->student_id}}">
                                    {{ $businessStudentStatus->employee->name }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

                <button class="print-window btn btn-primary">Print</button>

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
                employeeName : "{{ $employee->name }}"
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

                        if(data.state === 'success') {
                            toastr.success(data.message);
                            $('#updated-by-' + student_id).html(config.employeeName);
                            $('#updated-' + student_id).html('1s');
                        } else if(data.state === 'error') {
                            toastr.error(data.message);
                        }

                    }
                });

            });

            $('.print-window').click(function() {
                window.print();
            });

        });

    </script>

@endsection
