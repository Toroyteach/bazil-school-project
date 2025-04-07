<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Student::updateOrCreate(
            ['admission_number' => $row['admission_number']],
            [
                'first_name' => $row['first_name'],
                'middle_name' => $row['middle_name'],
                'last_name' => $row['last_name'],
                'gender' => $row['gender'],
                'dob' => $row['dob'],
                'address' => $row['address'],
                'city' => $row['city'],
                'state' => $row['state'],
                'country' => $row['country'],
                'postal_code' => $row['postal_code'],
                'parent_phone_1' => $row['parent_phone_1'],
                'parent_phone_2' => $row['parent_phone_2'],
                'parent_email_1' => $row['parent_email_1'],
                'parent_email_2' => $row['parent_email_2'],
                'admission_date' => $row['admission_date'],
                'class_id' => $row['class_id'],
                'section' => $row['section'],
                'emergency_contact_name' => $row['emergency_contact_name'],
                'emergency_contact_phone' => $row['emergency_contact_phone'],
                'profile_photo' => $row['profile_photo'],
            ]
        );
    }

    public function rules(): array
    {
        return Student::rules(); // from your rules method
    }
}
