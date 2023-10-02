<script>
    const mouseIn = (e) => {
        e.classList.remove('bg-light')
    }

    const mouseOut = (e) => {
        if(e.value=='') e.classList.add('bg-light')
    }
    const searchForm = document.querySelector('.search-article')
    // // if(searchForm.value=='') searchForm.classList.add('bg-light')
    // // searchForm.addEventListener('')
    // searchForm.addEventListener('submit', (e) => {
    //     e.preventDefault()
    //     console.log('click')
    // })

    const searchdata = () => {
        console.log(searchForm.value)
    } 
</script>