$(document).ready(function(){
    $('.search__page form[role=search]').submit(function(e){
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target)
        $('.products__list').html('<div class="preloader" style="font-size: 25px;">Loading....</div> ');
        setTimeout(()=>{
            window.location.href = '/?s=' + formData.get('s')
        },300)

    })
})

