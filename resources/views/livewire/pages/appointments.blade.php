<x-pages.list-type :items="$appointments" :perPage="$perPage" :sortField="$sortField" :sortDirection="$sortDirection" type="appointment" modalParam="appointmentId" idColumn="appointment_date" alphaColumn="last_name" :filter="$filter"
    :columns="['Student Name', 'Code', 'Booked Time', 'Reason', 'Status', 'Actions']"
    :modalConfig="[
        'complete' => ['title' => 'Marking', 'color' => 'confirm', 'action' => 'complete', 'msg' => 'mark as done', 'person' => 'appointment', 'target' => 'appointment as \'done\''],
        'cancel' => ['title' => 'Cancelling', 'color' => 'confirm', 'action' => 'cancel', 'msg' => 'cancel', 'person' => 'appointment', 'target' => 'appointment']
    ]"
/>
