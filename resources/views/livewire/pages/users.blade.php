<x-pages.list-type :items="$users" :perPage="$perPage" :sortField="$sortField" :sortDirection="$sortDirection" type="user" modalParam="userId" idColumn="user_id" alphaColumn="last_name" :filter="$filter"
    :columns="['Username', 'Contact Details', 'Role', 'Status', 'Actions']"
    :modalConfig="[
        'activate' => ['title' => 'Activating', 'color' => 'confirm', 'action' => 'activate', 'msg' => 'activate', 'person' => 'user', 'target' => 'user account'],
        'deactivate' => ['title' => 'Deactivating', 'color' => 'confirm', 'action' => 'deactivate', 'msg' => 'deactivate', 'person' => 'user', 'target' => 'user account'],
        'delete' => ['title' => 'Deleting', 'color' => 'danger', 'action' => 'delete', 'msg' => 'delete', 'person' => 'user', 'target' => 'user account']
    ]"
/>
