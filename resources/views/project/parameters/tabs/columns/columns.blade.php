<div class="relative overflow-x-auto rounded">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-0">#</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Commencement</th>
                <th scope="col" class="px-6 py-3">Fin</th>
                <th scope="col" class="px-6 py-3 w-0"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->columns as $index => $column)
                <tr data-column-id="{{ $column->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $index + 1 }}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $column->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $column->begin_column ? 'Oui' : 'Non' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $column->end_column ? 'Oui' : 'Non' }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <button type="button" data-modal="editColumn" data-column-id="{{ $column->id }}" class="btn-edit-column  bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                        </button>
                        <button type="button" data-modal="deleteColumn" data-column-id="{{ $column->id }}" class="btn-delete-column  bg-red-800 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </button>
                        <div class="flex gap-1">
                            <button type="button" data-column-id="{{ $column->id }}" data-sort="down" class="btn-sort-column bg-gray-600 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-down-icon lucide-arrow-big-down"><path d="M15 6v6h4l-7 7-7-7h4V6h6z"/></svg>
                            </button>
                            <button type="button" data-column-id="{{ $column->id }}" data-sort="up" class="btn-sort-column bg-gray-600 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-up-icon lucide-arrow-big-up"><path d="M9 18v-6H5l7-7 7 7h-4v6H9z"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>