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
        addToTable(data)
        clearField()
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
            'email' : email.value,
        }
        return data
    }

    function addToTable(data)
    {
        const dataTable = localStorage.getItem('table') !== null ? JSON.parse(localStorage.getItem('table')) : [];
        let indexNumber = dataTable.length ?? 0;
        data.number = indexNumber
        dataTable.push(data)
        localStorage.setItem('table',JSON.stringify(dataTable))
        displayToTableV2(data)
        const numberparticipant = document.querySelector('#participant')
        numberparticipant.value = indexNumber+1
    }

    function displayToTable()
    {
        let data = JSON.parse(localStorage.getItem('table'))
        let i = 1;
        data.forEach((item) => {
            const tableHeader = document.querySelector('.daftarpeserta')
            const tbody = tableHeader.querySelector('.tbodydata')

            let tr = document.createElement('tr')
            tbody.append(tr)

            let tdno = document.createElement('td')
            tdno.innerHTML = i
            tr.appendChild(tdno)

            let tdnama = document.createElement('td')
            tdnama.innerHTML = item.nama
            tr.appendChild(tdnama)

            let tdbagian = document.createElement('td')
            tdbagian.innerHTML = item.bagian
            tr.appendChild(tdbagian)

            let tdemail = document.createElement('td')
            tdemail.innerHTML = item.email
            tr.appendChild(tdemail)

            i++;
        })
    }

    function displayToTableV2(data)
    {
        let i=1;
        const tableHeader = document.querySelector('.daftarpeserta')
        const tbody = tableHeader.querySelector('.tbodydata')

        let tr = document.createElement('tr')
        tbody.append(tr)

        let tdnama = document.createElement('td')
        tdnama.innerHTML = data.nama
        tr.appendChild(tdnama)

        let tdbagian = document.createElement('td')
        tdbagian.innerHTML = data.bagian
        tr.appendChild(tdbagian)

        let tdemail = document.createElement('td')
        tdemail.innerHTML = data.email
        tr.appendChild(tdemail)

        let tdaksi = document.createElement('td')
        // let btn = document.createElement('button')
        // btn.className = 'btn btn-soft-danger btn-sm btn-rounded waves-effect waves-light'
        tdaksi.innerHTML = `<input type="hidden" name="jumlah" value="${data.number}" />
            <button type="button" class="btn btn-soft-danger btn-sm btn-rounded waves-effect waves-light" onclick="removeData(this)">
                <i class="fas fa-times font-size-16 align-middle"></i>
            </button>`
        tr.appendChild(tdaksi)
    }

    function removeData(el)
    {
        let tr = el.parentNode.parentNode
        let id = el.previousElementSibling
        // console.log(id)
        let arr = JSON.parse(localStorage.getItem('table'))
        arr.splice(tr.rowIndex-1,1)
        
        // arr.filter((e,i) => {
        localStorage.removeItem('table')
        arr.map((el,i) => {
            el.number = i
        })
        let ixNumber = arr.length
        localStorage.setItem('table',JSON.stringify(arr))

        tr.parentNode.removeChild(tr);
        const numberparticipant = document.querySelector('#participant')
        numberparticipant.value = ixNumber
    }
</script>