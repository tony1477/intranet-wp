<script>

    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    }

    $(document).ready(function() {
        $('#basic-pills-wizard').bootstrapWizard({
            'tabClass': 'nav nav-pills nav-justified'
        });

        <?php if($edited===true):?>
            sessionStorage.clear();
            let data = [];
            // let data=[
            <?php foreach($participant as $row):?>
                data.push({
                    'nama':'<?=$row->nama_peserta?>',
                    'bagian':'<?=$row->bagian?>',
                    'email':'<?=$row->email?>'
                })
        <?php endforeach;?>
        // ]
        sessionStorage.setItem('table',JSON.stringify(data))
        <?php endif;?>
        const dataTable = sessionStorage.getItem('table')
        if(dataTable !== null) {
            const numberParticipant = JSON.parse(sessionStorage.getItem('table')).length
            document.querySelector('#participant').value = numberParticipant
            displayToTable()
        }
        const namapeserta = new Choices(document.getElementById("namapeserta"), {removeItems: true,shouldSort:false,itemSelectText:''});
        
        fetch('<?=base_url()?>/api/getKaryawanwithExt',{
            method:'GET',
            headers: {
                'Content-Type':'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization' : 'Bearer <?=hash('sha256',getenv('SECRET_KEY').date('Y-m-d'))?>',
            },
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(datas) {
            // return datas.map(function(data) {
            //     return { value: data.id, label: data.fullname };
            // });
            const intGroup = []
            const extGroup = []
            datas.forEach(items => {
                if(items.Internal!='Internal') {
                    extGroup.push({value:items.id,label:items.fullname})
                }
                else {
                    intGroup.push({value:items.id, label:items.fullname})
                }
            })
            namapeserta.setChoices([
                {
                    label:'Internal',
                    id:1,
                    choices:intGroup
                },
                {
                    label:'Eksternal',
                    id:2,
                    choices:extGroup
                },
            ],
            'value',
            'label',
            false
            )
            // console.log(data)
        });

        const element = document.getElementById('namapeserta');
        element.addEventListener(
        'change',
        function(event) {
            const value = event.target.value
            const name = event.target.innerText.split(' ').join('_')
            
            fetch('<?=base_url()?>/api/getInfoKaryawanbyIdName/'+name+'/'+value,{
                method:'GET',
                headers:{
                    'Content-Type':'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Authorization' : 'Bearer <?=hash('sha256',getenv('SECRET_KEY').date('Y-m-d'))?>',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                bagian.value = toTitleCase(data[0].dep_nama);
                emailpeserta.value = data[0].email;
            })
        },
        false);

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

    const addParticipant = document.querySelector('.addParticipant');
    const btnSubmit = document.querySelector('.submitParticipant')
    addParticipant.addEventListener('click',(e) => {
        const formParticipant = document.querySelector('.formParticipant')
        // clearField()
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
        const bagian = formParticipant.querySelector('.bagianpeserta')
        const email = formParticipant.querySelector('.emailpeserta')
        bagian.value = '';email.value = '';
    }

    function getInputValue()
    {
        const formParticipant = document.querySelector('.formParticipant')
        const nama = document.getElementById('namapeserta')
        const bagian = formParticipant.querySelector('.bagianpeserta')
        const email = formParticipant.querySelector('.emailpeserta')
        const data = {
            'nama' : nama.selectedOptions[0].text,
            'bagian': bagian.value,
            'email' : email.value,
        }
        return data
    }

    function addToTable(data)
    {
        const dataTable = sessionStorage.getItem('table') !== null ? JSON.parse(sessionStorage.getItem('table')) : [];
        let indexNumber = dataTable.length ?? 0;
        data.number = indexNumber
        dataTable.push(data)
        sessionStorage.setItem('table',JSON.stringify(dataTable))
        displayToTableV2(data)
        const numberparticipant = document.querySelector('#participant')
        numberparticipant.value = indexNumber+1
    }

    function displayToTable()
    {
        let data = JSON.parse(sessionStorage.getItem('table'))
        let i = 1;
        data.forEach((item) => {
            const tableHeader = document.querySelector('.daftarpeserta')
            const tbody = tableHeader.querySelector('.tbodydata')

            let tr = document.createElement('tr')
            tbody.append(tr)

            // let tdno = document.createElement('td')
            // tdno.innerHTML = i
            // tr.appendChild(tdno)

            let tdnama = document.createElement('td')
            tdnama.innerHTML = item.nama
            tr.appendChild(tdnama)

            let tdbagian = document.createElement('td')
            tdbagian.innerHTML = item.bagian
            tr.appendChild(tdbagian)

            let tdemail = document.createElement('td')
            tdemail.innerHTML = item.email
            tr.appendChild(tdemail)

            let tdaksi = document.createElement('td')
            // let btn = document.createElement('button')
            // btn.className = 'btn btn-soft-danger btn-sm btn-rounded waves-effect waves-light'
            tdaksi.innerHTML = `<input type="hidden" name="jumlah" value="${data.number}" />
                <button type="button" class="btn btn-soft-danger btn-sm btn-rounded waves-effect waves-light" onclick="removeData(this)">
                    <i class="fas fa-times font-size-16 align-middle"></i>
                </button>`
            tr.appendChild(tdaksi)

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
        let arr = JSON.parse(sessionStorage.getItem('table'))
        arr.splice(tr.rowIndex-1,1)
        
        // arr.filter((e,i) => {
        sessionStorage.removeItem('table')
        arr.map((el,i) => {
            el.number = i
        })
        let ixNumber = arr.length
        sessionStorage.setItem('table',JSON.stringify(arr))

        tr.parentNode.removeChild(tr);
        const numberparticipant = document.querySelector('#participant')
        numberparticipant.value = ixNumber
    }

    // const inputField = document.getElementById('namapeserta');
    
    // inputField.addEventListener('input', function() {
    // const inputValue = inputField.value;

    // if(inputValue.length>=3) {
    //     getApiData('<?=base_url()?>/api/getKaryawan/'+inputValue)
    //     .then(resp => {
    //         console.log(resp)
    //         // const key = Object.keys(resp)
    //         // const data = Object.values(resp)
    //         // const lengthdata = data.length-1;

    //         // let opt = []
    //         // if(data[lengthdata]=='success') {
    //         //     const index = data.indexOf(data[lengthdata]);
    //         //     if (index > -1) data.splice(index, 1); 
    //         //     for(let i of data) {
    //         //         opt[i] = new Option(i.div_nama,i.iddivisi);
    //         //         listDivisi.add(opt[i]);
    //         //     }
    //         // }
    //     });
    // }
    // // console.log(inputvalue.length)
    // });

    async function getApiData(url='') 
    {
        const resp = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            creadentials: 'same-origin',
            headers: {
                'Content-Type':'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization' : 'Bearer <?=hash('sha256',getenv('SECRET_KEY').date('Y-m-d H:i'))?>',
            },  
        })
        return resp.json()
    }
</script>