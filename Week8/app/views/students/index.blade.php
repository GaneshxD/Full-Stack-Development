@extends('layouts.master')

@section('title', 'All Students')

@section('header-actions')
    <a href="index.php?action=create" class="inline-flex items-center gap-2 rounded-full bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
        Add Student
    </a>
@endsection

@section('content')
    <div class="overflow-hidden rounded-xl border border-slate-200">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Course</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white text-slate-800">
                @if(count($students) > 0)
                    @foreach($students as $student)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium">{{ $student['id'] }}</td>
                            <td class="px-4 py-3">{{ $student['name'] }}</td>
                            <td class="px-4 py-3">{{ $student['email'] }}</td>
                            <td class="px-4 py-3">{{ $student['course'] }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="index.php?action=edit&id={{ $student['id'] }}" class="inline-flex items-center rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                        Edit
                                    </a>
                                    <a href="index.php?action=delete&id={{ $student['id'] }}" 
                                       class="inline-flex items-center rounded-lg bg-rose-500 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-rose-600" 
                                       onclick="return confirm('Are you sure?')">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-500">No students found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection