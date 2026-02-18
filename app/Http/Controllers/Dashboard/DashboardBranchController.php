<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardBranchController extends Controller
{
    /**
     * Display a listing of branches.
     */
    public function index(Request $request)
    {
        $query = Branch::with(['city', 'manager', 'main_branch'])
            ->withCount('users');

        // Search by name or city name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $isActive = $request->input('status') === 'active';
            $query->where('is_active', $isActive);
        }

        // Filter by city
        if ($request->filled('city_id') && $request->input('city_id') !== 'all') {
            $query->where('city_id', $request->input('city_id'));
        }

        // Filter by main branch (show sub-branches)
        if ($request->filled('main_branch_id') && $request->input('main_branch_id') !== 'all') {
            $query->where('main_branch_id', $request->input('main_branch_id'));
        }

        $branches = $query->orderBy('id')->get();

        $cities = City::orderBy('name')->get();
        $managers = User::orderBy('name')->get();
        $mainBranches = Branch::orderBy('name')->get();

        return view('branches.index', compact('branches', 'cities', 'managers', 'mainBranches'));
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
            'main_branch_id' => ['nullable', 'exists:branches,id'],
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
            'main_branch_id' => ['nullable', 'exists:branches,id'],
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
