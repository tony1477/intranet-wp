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
        // const textUniqueVals = new Choices('#choices-text-unique-values', {
        // paste: false,
        //     duplicateItemsAllowed: false,
        //     editItems: true,
        //     removeItemButton: true,
        // });

        // const noSorting = new Choices("#choices-single-no-sorting",{shouldSort:!1})
    });

    const addParticipant = document.querySelector('.addParticipant');
    const btnSubmit = document.querySelector('.submitParticipant')
    addParticipant.addEventListener('click',(e) => {
        const formParticipant = document.querySelector('.formParticipant')
        clearField()
        formParticipant.style.display === 'none' ? formParticipant.style.display = "flex" : formParticipant.style.display = "none"
    })

    btnSubmit.addEventListener('click', (e) => {
        e.preventDefault();
        let data = getInputValue();
        console.log(data)
        // addToTable(data)
    })

    function clearField()
    {
        const formParticipant = document.querySelector('.formParticipant')
        const nama = formParticipant.querySelector('.namepeserta')
        const bagian = formParticipant.querySelector('.bagianpeserta')
        const email = formParticipant.querySelector('.emailpeserta')
        nama.value = '';bagian.value = '';email.value = '';
    }

    function getInputValue()
    {
        const formParticipant = document.querySelector('.formParticipant')
        const nama = formParticipant.querySelector('.namepeserta')
        const bagian = formParticipant.querySelector('.bagianpeserta')
        const email = formParticipant.querySelector('.emailpeserta')

        const data = {
            'nama' : nama.value,
            'bagian': bagian.value,
            'email' : email.value
        }
        return data
    }
</script>