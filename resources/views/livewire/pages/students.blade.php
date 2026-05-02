<x-pages.list-type :items="$students" :perPage="$perPage" :sortField="$sortField" :sortDirection="$sortDirection" type="student" modalParam="studentId" idColumn="student_id" alphaColumn="last_name" :filter="$filter"
    :columns="['Student Name', 'Contact Details', 'Last Referred By', 'Referral Type', 'Code', 'Action']"
    :modalConfig="[]"
/>
