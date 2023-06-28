function getUrl() {
    const hostname = window.location.hostname;
    let baseUrl='';
    // Periksa apakah hostname adalah "localhost" atau IP lokal
    if (hostname === 'localhost' || /^(\d{1,3}\.){3}\d{1,3}$/.test(hostname)) {
        // Jika sedang dalam mode pengembangan lokal, atur base URL ke localhost/subfolder
        baseUrl = 'http://localhost/intranet/';
    } else {
        // Jika dalam mode produksi, atur base URL ke domain produksi
        baseUrl = 'http://wilianperkasa.synology.me:88';
    }
    return baseUrl
}

const toggleLoading = () => {
    const question = document.querySelector('.questionHelpdesk')
    const loading = document.querySelector('.loadingQuestion')
    question.classList.toggle('d-none')
    loading.classList.toggle('d-none')
}
const checkRadioInput = () => {
    idopt = document.querySelector('input[name="parentoption"]:checked')
    if(idopt===null) return Swal.fire('Warning','Harap Pilih Salah Satu','warning')
    return true;
}
const gotoNextQuestion = (value,number) => {
    number++
    fetch(getUrl()+'helpdesk/nextquestion',{
        method:'POST',
        cache:'no-cache',
        mode:'cors',
        credentials:'same-origin',
        headers: {
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'data':value})
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.status == 'success') {
            const question = document.querySelector('.questionHelpdesk')
            const loading = document.querySelector('.loadingQuestion')
            const btnPrev = document.querySelector('.btnPrev')

            if(data.data.hasOwnProperty('last')) return gotoForm()
            const h3El = document.createElement('h3')
            h3El.innerHTML = 'Pilih Kategori dari '+ value.values+ ' :'
            question.replaceChildren(h3El)
            data.data.forEach(val => {
                const olddiv = document.querySelector('.questionHelpdesk')
                let div = document.createElement('div')
                div.className = 'form-check'
                div.innerHTML = `<input class="form-check-input form-check-input-helpdesk" type="radio" name="parentoption" id="radio${val.choiceid}" value="${val.choiceid}" data-question="question${number}">`
                
                let label = document.createElement('label')
                label.className = 'form-check-label d-flex align-items-center position-relative'
                label.setAttribute('for','radio'+val.choiceid)

                let spanText = document.createElement('span')
                spanText.className = 'position-relative fs-3'
                spanText.innerText = val.choicename

                label.appendChild(spanText)
                
                if(val.next_choice!=null) {
                    let choiceEl = document.createElement('span')
                    choiceEl.className = 'badge info-btn btn-rounded position-relative mx-1 mt-n3'
                    choiceEl.setAttribute("onmouseover","showthis(this)") 
                    choiceEl.setAttribute("onmouseout","hidethis(this)")
                    choiceEl.style.width = '1.5em'
                    choiceEl.style.height = '1.5em'
                    label.appendChild(choiceEl)
                    let info = document.createElement('i')
                    info.className = 'fas fa-info'
                    choiceEl.appendChild(info)
                }
                div.appendChild(label)
                if(val.next_choice!=null) {
                    let infoText = document.createElement('div')
                    infoText.className = 'radio-info my-3 fw-bold d-none'
                    infoText.setAttribute("data-show-info","hidden")
                    infoText.innerHTML = val.next_choice
                    div.appendChild(infoText)
                }
                question.appendChild(div)
                question.dataset.parentid = val.prevparent
            })
            // let btnKirim = document.createElement('button')
            // btnKirim.setAttribute('type','button')
            // btnKirim.className = 'btn btn-primary waves-effect waves-light btnNext mt-3'
            // btnKirim.setAttribute('data-number',number)
            // btnKirim.innerHTML = `<i class="bx bx-right-arrow-alt font-size-16 align-middle me-2"></i> Next`
            // question.appendChild(btnKirim)
            const btnKirim = document.querySelector('.btnNext')
            sessionStorage.setItem('prevparentid',question.dataset.parentid)
            sessionStorage.setItem('number',number)
            btnKirim.dataset.number = number
        }
    })
}
const nextQuestion = () => {
    if(checkRadioInput()==true) {
        toggleLoading()
        const btnNext = document.querySelector('.btnNext')
        let number = btnNext.dataset.number
        const question = document.querySelector('.questionHelpdesk')
        let parentid = question.dataset.parentid
        const btnPrev = document.querySelector('.btnPrev')
        let idopt = document.querySelector('input[name="parentoption"]:checked').value
        let valueopt = document.querySelector('label[for="radio'+idopt+'"]')
        const datas = {
            opt: idopt,
            values:valueopt.firstElementChild.innerHTML
        }
        const formRadio = document.querySelector('.form-check-input-helpdesk')
        let dataQuestion = formRadio.dataset.question;
        sessionStorage.setItem('question'+number,datas.opt)
        sessionStorage.setItem('question'+number+'value',datas.values)
        sessionStorage.setItem('parentid',datas.opt)
        
        gotoNextQuestion(datas,number)
        toggleLoading()
        btnPrev.classList.remove('d-none')
    }
}
const prevQuestion = () => {
    toggleLoading();
    const btnNext = document.querySelector('.btnNext')
    const btnPrev = document.querySelector('.btnPrev')
    let number = btnNext.dataset.number-1
    btnNext.dataset.number = number
    const data = {'opt':JSON.parse(sessionStorage.getItem('prevparentid'))}
    fetch(getUrl()+'helpdesk/nextquestion',{
        method:'POST',
        cache:'no-cache',
        mode:'cors',
        credentials:'same-origin',
        headers: {
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'data':data})
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.status == 'success') {
            const question = document.querySelector('.questionHelpdesk')

            const h3El = document.createElement('h3')
            h3El.innerHTML = 'Pilih Kategori dari  :'
            question.replaceChildren(h3El)
            data.data.forEach(val => {
                const olddiv = document.querySelector('.questionHelpdesk')
                let div = document.createElement('div')
                div.className = 'form-check'
                div.innerHTML = `<input class="form-check-input form-check-input-helpdesk" type="radio" name="parentoption" id="radio${val.choiceid}" value="${val.choiceid}" data-question="question${number}">`
                
                let label = document.createElement('label')
                label.className = 'form-check-label d-flex align-items-center position-relative'
                label.setAttribute('for','radio'+val.choiceid)

                let spanText = document.createElement('span')
                spanText.className = 'position-relative fs-3'
                spanText.innerText = val.choicename

                label.appendChild(spanText)
                
                if(val.next_choice!=null) {
                    let choiceEl = document.createElement('span')
                    choiceEl.className = 'badge info-btn btn-rounded position-relative mx-1 mt-n3'
                    choiceEl.setAttribute("onmouseover","showthis(this)") 
                    choiceEl.setAttribute("onmouseout","hidethis(this)")
                    choiceEl.style.width = '1.5em'
                    choiceEl.style.height = '1.5em'
                    label.appendChild(choiceEl)
                    let info = document.createElement('i')
                    info.className = 'fas fa-info'
                    choiceEl.appendChild(info)
                }
                div.appendChild(label)
                if(val.next_choice!=null) {
                    let infoText = document.createElement('div')
                    infoText.className = 'radio-info my-3 fw-bold d-none'
                    infoText.setAttribute("data-show-info","hidden")
                    infoText.innerHTML = val.next_choice
                    div.appendChild(infoText)
                }
                question.appendChild(div)
                question.dataset.parentid = val.prevparent
                if(val.parentid==null) btnPrev.classList.add('d-none')
            })
            sessionStorage.setItem('prevparentid',question.dataset.parentid)
            sessionStorage.setItem('number',number)
        }
    })
    toggleLoading();
}
const gotoForm = () => {
    const question = document.querySelector('.questionHelpdesk')
    const submitForm = document.querySelector('.submitForm')
    const nextPage = document.querySelector('.nextPage')
    
    const user_request = document.querySelector('input[name="user_request"]')
    const user_reason = document.querySelector('input[name="user_reason"]')
    let req_txt,rea_txt;

    if(user_request) req_txt = user_request.value
    if(user_reason) rea_txt = user_reason.value

    const h3El = document.createElement('h3')
    h3El.innerHTML = 'Tuliskan Uraian dengan Lengkap dan Jelas :'
    question.replaceChildren(h3El)
    let number = sessionStorage.getItem('number')
    const divCat = document.createElement('div')
    divCat.innerHTML = 'Kategori : '
    for(let i=1; i<=number; i++) {
        divCat.innerHTML += sessionStorage.getItem('question'+i+'value')
        if(i<number) divCat.innerHTML += `<i class="bx bx-caret-right"></i>`
    }
    divCat.innerHTML += `<button type="button" class="btn btn-sm btn-danger text-white mx-2 btn-rounded btn-cancelCat"><i class="fas fa-times" onclick="cancelCat()"></i></button>`
    question.appendChild(divCat)
    const div1 = document.createElement('div')
    div1.className = 'mb-3'
    div1.innerHTML = `<label for="formRequest" class="form-label">Permohonan Bantuan</label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Jelaskan permasalahan/permohonan Anda" id="floatingTextRequest" style="height: 100px" name="requesttext"></textarea>
        <label for="floatingTextRequest">Jelaskan permasalahan/permohonan Anda </label>
    </div>`
    
    const div2 = document.createElement('div')
    div2.className = 'mb-3'
    div2.innerHTML = `<label for="formReason" class="form-label">Alasan Permohonan</label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Penjelasan alasan permohonan" id="floatingTexReason" style="height: 100px" name="reasontext"></textarea>
        <label for="floatingTexReason">Penjelasan alasan permohonan</label>
    </div>`

    const div3 = document.createElement('div')
    div3.className = 'mb-3'
    div3.innerHTML = `<label for="formFile" class="form-label">Upload BA / Dokumen pendukung lainnya</label>
    <input class="form-control fileRequest" type="file" id="formFile" name="formFile">`

    const data = {
        id:[],
        value:[]
    }
    getData(data);
    
    const div4 = document.createElement('div')
    div4.className = 'mb-3'
    div4.innerHTML = `<input type="hidden" name="data_id" value="${data.id}"> <input type="hidden" name="data_value" value="${data.value}">`
    
    question.appendChild(div1)
    question.appendChild(div2)
    question.appendChild(div3)
    question.appendChild(div4)
    nextPage.classList.add('d-none')
    submitForm.classList.remove('d-none')
    submitForm.classList.add('d-flex')

    if(req_txt!='') document.querySelector('textarea[name="requesttext"]').value = req_txt
    if(rea_txt!='') document.querySelector('textarea[name="reasontext"]').value = rea_txt
}
const getData = (data) => {
    let number = sessionStorage.getItem('number')
    for(let i=1; i<=number; i++) {
        data.id.push(sessionStorage.getItem('question'+i))
        data.value.push(sessionStorage.getItem('question'+i+'value'))
    }
}

const goToFirst = () => {
    toggleLoading()
    fetch(getUrl()+'helpdesk/getfirst',{
        method: 'GET',
        cache: 'no-cache',
        mode: 'cors',
        credentials:'same-origin',
        headers: {
            'Content-Type':'application/json',
        },
    })
    .then(resp => resp.json())
    .then(data => {
        const question = document.querySelector('.questionHelpdesk')
        const h3El = document.createElement('h3')
        h3El.innerHTML = 'Pilih Jenis Permintaan Bantuan : '
        question.replaceChildren(h3El)
        // let text = ['IT System','IT Infrastructure']
        // let subtext = ['System ERP , System WB , System Intranet , System Website , Access System','Komputer , Jaringan , CCTV , Hardware / Perangkat Keras , Software / Aplikasi Komputer']
        data.data.forEach(function(value,i) {
            let div = document.createElement('div')
            div.className = 'form-check'
            div.innerHTML = `<input class="form-check-input form-check-input-helpdesk" type="radio" name="parentoption" id="radio${i+1}" value="${i+1}" data-question="question1">`
            
            let label = document.createElement('label')
            label.className = 'form-check-label d-flex align-items-center position-relative'
            label.setAttribute('for','radio'+(i+1))

            let spanText = document.createElement('span')
            spanText.className = 'position-relative fs-3'
            spanText.innerText = value.choicename

            label.appendChild(spanText)
            
            let choiceEl = document.createElement('span')
            choiceEl.className = 'badge info-btn btn-rounded position-relative mx-1 mt-n3'
            choiceEl.setAttribute("onmouseover","showthis(this)") 
            choiceEl.setAttribute("onmouseout","hidethis(this)")
            choiceEl.style.width = '1.5em'
            choiceEl.style.height = '1.5em'
            label.appendChild(choiceEl)
            let info = document.createElement('i')
            info.className = 'fas fa-info'
            choiceEl.appendChild(info)
            
            div.appendChild(label)
            
            let infoText = document.createElement('div')
            infoText.className = 'radio-info my-3 fw-bold d-none'
            infoText.setAttribute("data-show-info","hidden")
            infoText.innerHTML = value.next_choice
            div.appendChild(infoText)
            question.appendChild(div)
        })
        document.querySelector('.submitForm').classList.replace('d-flex','d-none')
        document.querySelector('.nextPage').classList.remove('d-none')        
        document.querySelector('.btnPrev').classList.add('d-none')        
        document.querySelector('.btnNext').dataset.number=1
        // console.log(document.querySelector('.submitForm'))
        question.dataset.parentid = 'null'
        toggleLoading();
    })
}

const cancelCat = () => {
    sessionStorage.clear()
    goToFirst()
}

const btnNext = document.querySelector('.btnNext')
const btnPrev = document.querySelector('.btnPrev')
const btnSubmit = document.querySelector('.btnSubmit')

btnNext.addEventListener('click', () => nextQuestion())
btnPrev.addEventListener('click', () => prevQuestion())