<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6 text-gray-900">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Student Profile</h1>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
            </div>
            <div><strong>Admission Number:</strong> {{ $student->admission_number }}</div>
            <div><strong>Gender:</strong> {{ $student->gender }}</div>
            <div><strong>DOB:</strong> {{ \Carbon\Carbon::parse($student->dob)->format('Y-m-d') }}</div>
            <div><strong>Class:</strong> {{ $student->st_class->class_name ?? 'N/A' }}</div>
            <div><strong>Address:</strong> {{ $student->address }}, {{ $student->city }}</div>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">Academic Progress</h2>
        <table class="w-full table-auto border-collapse border border-gray-300 mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Subject</th>
                    <th class="border p-2">Grade</th>
                    <th class="border p-2">Term</th>
                    <th class="border p-2">Year</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($progress as $item)
                    <tr>
                        <td class="border p-2">{{ $item->subject->title }}</td>
                        <td class="border p-2">{{ $item->grade }}</td>
                        <td class="border p-2">{{ $item->term }}</td>
                        <td class="border p-2">{{ $item->academic_year }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-semibold mb-2">School Fees</h2>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Amount Due</th>
                    <th class="border p-2">Paid</th>
                    <th class="border p-2">Balance</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fees as $fee)
                    <tr>
                        <td class="border p-2">{{ $fee->amount_due }}</td>
                        <td class="border p-2">{{ $fee->amount_paid }}</td>
                        <td class="border p-2">{{ $fee->balance }}</td>
                        <td class="border p-2">{{ $fee->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>