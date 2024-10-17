<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return view('AdminPanel.Employees.employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPanel.Employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'profession' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1500',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $storeData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'img' => $request->img,
            'profession' => $request->profession,
            'bio' => $request->bio,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,

        ];
        if ($request->img === null) {
            $storeData['img'] = 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg';
        }


        $employee = Employee::create($storeData);

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->back();
        }

        return view('AdminPanel.Employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->back();
        }
        return view('AdminPanel.Employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'profession' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1500',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        $updateData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'img' => $request->img,
            'profession' => $request->profession,
            'bio' => $request->bio,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,

        ];
        if ($request->img === null) {
            $updateData['img'] = 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg';
        }


        $employee->update($updateData);


        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['success' => true, 'message' => 'Employee deleted successfully']);
    }

    public function search(Request $request)
    {

        $search = strtolower(trim($request->input('search')));


        $employees = Employee::where('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->orWhere('profession', 'LIKE', "%{$search}%")
            ->paginate(10);


        return view('AdminPanel.Employees.partials.employees_table', compact('employees'))->render();
    }
}
