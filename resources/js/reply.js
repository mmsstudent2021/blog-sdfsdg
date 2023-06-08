const replyBtn = document.querySelectorAll(".reply-btn");


replyBtn.forEach(btn => {
    btn.addEventListener('click',function(){
        btn.nextElementSibling.classList.toggle("d-none")
    });
})
