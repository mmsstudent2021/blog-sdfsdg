

console.log("single upload");


const singleUploadDiv = document.querySelector(".single-photo-update");
const realUpload = document.querySelector(".real-upload");
const uploadPreview = document.querySelector(".upload-preview");

singleUploadDiv.addEventListener("click",() => {
    realUpload.click()
})


realUpload.addEventListener("change",(event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    const img = new Image();
    const div = document.createElement("div");
    const delButton = document.createElement("button");
    img.style.height = 100 + "px";
    div.classList.add("d-flex","flex-column");
    delButton.innerHTML = `<i class=' bi bi-trash'></i>`;
    delButton.classList.add("btn","btn-sm","btn-danger");

    delButton.addEventListener("click",(event) => {
        event.stopPropagation();
        realUpload.value = null;
        delButton.parentElement.remove();
    })

    reader.addEventListener("load",() => {
        // console.log(reader.result);
        img.src = reader.result
        div.prepend(img)
        div.append(delButton)
        singleUploadDiv.prepend(div);

    })

    reader.readAsDataURL(file)
})
