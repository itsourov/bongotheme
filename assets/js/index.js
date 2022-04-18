//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}





var content = document.getElementById('content')
if (content!=null) {
    console.log(content.length)

    images = content.getElementsByTagName('img');

    for (let i = 0; i < images.length; i++) {
        const image = images[i];
        var wrapper = document.createElement('a');
        wrapper.setAttribute('href', image.src);
        wrapper.setAttribute('data-toggle', 'lightbox');
        wrapper.setAttribute('data-type', 'image');
        wrapper.appendChild(image.cloneNode(true));
        image.parentNode.replaceChild(wrapper, image);
    }


}



var contactform = document.getElementsByClassName('wpcf7')[0];
if (contactform!=null) {
    var inputs = contactform.getElementsByClassName('wpcf7-form-control')
    var outputs = contactform.getElementsByClassName('wpcf7-response-output')
    var submitBtns = contactform.getElementsByClassName('wpcf7-submit')

    for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        input.className = input.className + ' form-control'
    }

    for (let i = 0; i < outputs.length; i++) {
        const output = outputs[i];
        output.className = output.className + ' alert alert-primary'
    }
    for (let i = 0; i < submitBtns.length; i++) {
        const submitBtn = submitBtns[i];
        submitBtn.classList.remove("form-control")
    }

}
