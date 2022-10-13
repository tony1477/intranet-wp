<script>

    $(document).ready(function() {
        $('#basic-pills-wizard').bootstrapWizard({
            'tabClass': 'nav nav-pills nav-justified'
        });
    });

    // Active tab pane on nav link

    const triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'))
    triggerTabList.forEach(function (triggerEl) {
        const tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })

    document.addEventListener('DOMContentLoaded', function () {
        const textUniqueVals = new Choices('#choices-text-unique-values', {
        paste: false,
            duplicateItemsAllowed: false,
            editItems: true,
            removeItemButton: true,
        });

        const noSorting = new Choices("#choices-single-no-sorting",{shouldSort:!1})
    });


</script>