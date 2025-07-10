<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Ajouter une colonne</p>
        <button class="modal-close" data-modal="createColumn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="createColumnForm">
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded" type="text" name="name" id="name" autocomplete="off">
            </div>
            <div class="mt-2">
                <p class="">Automatisation</p>

                <div class="flex justify-evenly items-center gap-2">
                    <div class="">
                        <input class="rounded" type="radio" name="begin_end" id="begin_column" value="begin_column">
                        <label for="begin_column">Colonne de commencement</label>
                    </div>
                    <div class="">
                        <input class="rounded" type="radio" name="begin_end" id="end_column" value="end_column">
                        <label for="end_column">Colonne de fin</label>
                    </div>
                    <div class="">
                        <input class="rounded" type="radio" name="begin_end" id="none_column" value="none_column" checked>
                        <label for="none_column">Aucun</label>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button data-project-id="{{ $project->id }}" class="btn-store-column bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">Ajouter</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="createColumn">Fermer</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const beginBox = document.getElementById('begin_column');
        const endBox = document.getElementById('end_column');

        beginBox.addEventListener('change', () => {
            if (beginBox.checked) {
                endBox.setAttribute('checked', false)
            }
        });

        endBox.addEventListener('change', () => {
            if (endBox.checked) {
                beginBox.setAttribute('checked', false)
            }
        });
    });
</script>