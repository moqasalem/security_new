<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardBranchController extends Controller
{
    /**
     * Display a listing of branches.
     */
    public function index()
    {
        $branches = Branch::with(['city', 'manager'])
            ->withCount('users')
            ->orderBy('id')
            ->get();

        $cities = City::orderBy('name')->get();
        $managers = User::orderBy('name')->get();
        //Log::info($cities);
        return view('branches.index', compact('branches', 'cities', 'managers'));
    }

    /**
     * Display the specified branch.
     */
    public function show($id)
    {
        $branch = Branch::with(['city', 'manager', 'users'])
            ->withCount('users')
            ->findOrFail($id);

        $cities = City::orderBy('name')->get();
        $managers = User::orderBy('name')->get();
        $allUsers = User::orderBy('name')->get();

        return view('branches.show', compact('branch', 'cities', 'managers', 'allUsers'));
    }

    /**
     * Store a newly created branch.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'exists:cities,id'],
            'address' => ['nullable', 'string', 'max:500'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'اسم الفرع مطلوب',
            'city_id.required' => 'المدينة مطلوبة',
            'city_id.exists' => 'المدينة غير موجودة',
            'manager_id.exists' => 'المدير غير موجود',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Branch::create($validated);

        return redirect()->route('branches')->with('success', 'تم إضافة الفرع بنجاح');
    }

    /**
     * Update the specified branch.
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'exists:cities,id'],
            'address' => ['nullable', 'string', 'max:500'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'اسم الفرع مطلوب',
            'city_id.required' => 'المدينة مطلوبة',
            'city_id.exists' => 'المدينة غير موجودة',
            'manager_id.exists' => 'المدير غير موجود',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $branch->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الفرع بنجاح');
    }

    /**
     * Toggle branch active status.
     */
    public function toggleStatus($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update(['is_active' => !$branch->is_active]);

        $message = $branch->is_active ? 'تم تفعيل الفرع بنجاح' : 'تم إيقاف الفرع بنجاح';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Assign users to a branch.
     */
    public function assignUsers(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validated = $request->validate([
            'user_ids' => ['nullable', 'array'],
            'user_ids.*' => ['exists:users,id'],
        ]);

        // Remove all current users from this branch
        User::where('branch_id', $branch->id)->update(['branch_id' => null]);

        // Assign selected users to this branch
        if (!empty($validated['user_ids'])) {
            User::whereIn('id', $validated['user_ids'])->update(['branch_id' => $branch->id]);
        }

        return redirect()->back()->with('success', 'تم تحديث مستخدمي الفرع بنجاح');
    }
}
