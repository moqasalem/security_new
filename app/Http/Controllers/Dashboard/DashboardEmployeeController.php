<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use Illuminate\Http\Request;

class DashboardEmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(Request $request)
    {
        $query = Employee::with('branch');

        // Search by name, email, or identity number
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('identity_number', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $isActive = $request->input('status') === 'active';
            $query->where('is_active', $isActive);
        }

        // Filter by branch
        if ($request->filled('branch_id') && $request->input('branch_id') !== 'all') {
            $query->where('branch_id', $request->input('branch_id'));
        }

        $employees = $query->orderBy('id')->get();
        $branches = Branch::where('is_active', true)->orderBy('name')->get();

        return view('employees.index', compact('employees', 'branches'));
    }

    /**
     * Store a newly created employee.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
            'identity_number' => ['required', 'string', 'max:20'],
            'branch_id' => ['required', 'exists:branches,id'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'اسم الموظف مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
            'identity_number.required' => 'رقم الهوية مطلوب',
            'branch_id.required' => 'الفرع مطلوب',
            'branch_id.exists' => 'الفرع غير موجود',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['password'] = bcrypt($validated['password']);

        Employee::create($validated);

        return redirect()->route('employees')->with('success', 'تم إضافة الموظف بنجاح');
    }

    /**
     * Update the specified employee.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
            'identity_number' => ['required', 'string', 'max:20'],
            'branch_id' => ['required', 'exists:branches,id'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'اسم الموظف مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
            'identity_number.required' => 'رقم الهوية مطلوب',
            'branch_id.required' => 'الفرع مطلوب',
            'branch_id.exists' => 'الفرع غير موجود',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Only update password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $employee->update($validated);

        return redirect()->route('employees')->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    /**
     * Remove the specified employee.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees')->with('success', 'تم حذف الموظف بنجاح');
    }

    /**
     * Toggle employee active status.
     */
    public function toggleStatus($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update(['is_active' => !$employee->is_active]);

        $message = $employee->is_active ? 'تم تفعيل الموظف بنجاح' : 'تم إيقاف الموظف بنجاح';
        return redirect()->back()->with('success', $message);
    }
}
