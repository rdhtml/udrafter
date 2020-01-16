<?php

namespace App\Http\Controllers;

use App\Models\BusinessStudentStatus;
use App\Models\StudentJobStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::where('id', Auth::user()->id)->first();

        $businessStudentStatuses = BusinessStudentStatus::select('business_student_status.*')
            ->join('business','business.id','business_student_status.business_id')
            ->join('users', 'users.business_id', 'business_student_status.business_id')
            ->join('students', 'students.id', 'business_student_status.student_id')
            ->where('users.id',$user->id)
            ->orderBy('students.name','asc')
            ->get();

        $jobStatuses = StudentJobStatus::kvlist();

        return view('home')
            ->with('employee', $user)
            ->with('jobStatuses', $jobStatuses)
            ->with('businessStudentStatuses', $businessStudentStatuses);
    }


    public function updateStudentStatus(Request $request)
    {

        try {

            $studentJobStatus = BusinessStudentStatus::withTrashed()
                ->updateOrCreate(['business_id' => $request->businessId, 'student_id' => $request->studentId],
                    [
                        'status_id' => $request->statusId,
                        'employee_id' => $request->employeeId,
                        'deleted_at' => null
                    ]);

            return response()->json([
                'state' => 'success',
                'message' => '<strong>' . $studentJobStatus->student->name . '</strong> '. trans('messages.status_set_to') .' <strong>' . ucfirst($studentJobStatus->status->status) . '</strong>'
            ]);

        } catch (\Exception $e) {

            \Log::error($e->getMessage());

            return response()->json([
                'state' => 'error',
                'message' => trans('messages.try_again')
            ]);

        }

    }
}
