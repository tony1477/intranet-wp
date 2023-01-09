<script type="text/javascript">
const listDivisi = document.querySelector('#id_divisi')
const listDepartment = document.querySelector('#id_department')
listDivisi.addEventListener('change',getDepartment)

function getDepartment()
{
    let val = listDivisi.value
    getApiData(`<?=base_url()?>/api/getDepartment/${val}`)
    .then(resp => {
        const key = Object.keys(resp)
        const data = Object.values(resp)
        const lengthdata = data.length-1;

        const options = document.querySelectorAll('#id_department option')
        options.forEach(opts => opts.remove());

        let opt = []
        if(data[lengthdata]=='success') {
            const index = data.indexOf(data[lengthdata]);
            if (index > -1) data.splice(index, 1); 
            for(let i of data) {
                opt[i] = new Option(i.dep_nama,i.iddepartment);
                listDepartment.add(opt[i]);
            }
        }
    });
}

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