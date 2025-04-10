@extends('layouts.front')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body overflow-auto" style="max-height: 70vh;">
            <h1 class="card-title h5 mb-3">Student Profile</h1>
            <div class="row mb-3">
                <div class="col-md-6"><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</div>
                <div class="col-md-6"><strong>Admission Number:</strong> {{ $student->admission_number }}</div>
                <div class="col-md-6"><strong>Gender:</strong> {{ $student->gender }}</div>
                <div class="col-md-6"><strong>DOB:</strong> {{ \Carbon\Carbon::parse($student->dob)->format('Y-m-d') }}</div>
                <div class="col-md-6"><strong>Class:</strong> {{ $student->st_class->class_name ?? 'N/A' }}</div>
                <div class="col-md-6"><strong>Address:</strong> {{ $student->address }}, {{ $student->city }}</div>
            </div>

            <h2 class="card-subtitle h6 mt-3 mb-2">Academic Progress</h2>
            @foreach ($progress as $term => $items)
                <h3 class="h6 mt-3 mb-2">Term: {{ $term }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-3">
                        <thead class="table-light">
                            <tr>
                                <th class="p-2">Subject</th>
                                <th class="p-2">Grade</th>
                                <th class="p-2">Year</th>
                                <th class="p-2">Teacher Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="p-2">{{ $item->subject->title ?? 'Not available' }}</td>
                                    <td class="p-2">{{ $item->grade }}</td>
                                    <td class="p-2">{{ $item->academic_year }}</td>
                                    <td class="p-2">
                                        <div class="overflow-auto" style="max-width: 400px; white-space: nowrap;">
                                            @if (is_array($item->teacher_comments) && count($item->teacher_comments))
                                                @foreach ($item->teacher_comments as $comment)
                                                    <div><strong>Date:</strong> {{ $comment['date'] ?? 'N/A' }}</div>
                                                    <div><strong>Comment:</strong> {{ $comment['comment'] ?? 'N/A' }}</div>
                                                    <div><strong>Teacher:</strong> {{ $comment['teacher_name'] ?? 'Not available' }}</div>
                                                    <hr class="my-1">
                                                @endforeach
                                            @else
                                                No Data available
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

            <h2 class="card-subtitle h6 mt-3 mb-2">School Fees</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="p-2">Amount Due</th>
                            <th class="p-2">Paid</th>
                            <th class="p-2">Balance</th>
                            <th class="p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr>
                                <td class="p-2">ksh {{ $fee->amount_due }}</td>
                                <td class="p-2">ksh {{ $fee->amount_paid }}</td>
                                <td class="p-2">ksh {{ $fee->balance }}</td>
                                <td class="p-2">
                                    {{ $fee->status === 'Paid' ? 'Paid on ' . \Carbon\Carbon::parse($fee->date_paid)->format('d M Y') : $fee->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection