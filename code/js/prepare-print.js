prepare_print = function() {


    // change page title
    var titleTag = document.getElementsByTagName("title")[0];
    var title = document.getElementById("actual-title");
    //alert(title.innerText);
    titleTag.innerHTML = title.innerText;


    // remove body padding
    var body = document.getElementsByTagName("body")[0];
    body.classList.add("for-print-body-padding");


    // display notebook title
    var h1 = document.getElementById("notebook-title");
    h1.classList.add("for-print-display-h1");


    // remove main nav
    var nav = document.getElementsByTagName("nav")[0];
    nav.classList.add("for-print-removed");


    // remove all anchor hrefs
    var anchors = document.getElementsByTagName("a");
    for(i = 0; i < anchors.length; i++)
    {
        anchors[i].removeAttribute("href");
    }
    

    // remove all anchor bullets
    var bullets = document.getElementsByClassName("edit-link");
    for(i = 0; i < bullets.length; i++)
    {
        bullets[i].classList.add("for-print-removed");
    }


    // change links to blocks
    var links = document.getElementsByClassName("lnk");
    for(i = 0; i < links.length; i++)
    {
        links[i].classList.add("for-print-lnk-block");
    }


    // remove all labels
    var labels = document.getElementsByTagName("label");
    for(i = 0; i < labels.length; i++)
    {
        labels[i].classList.add("for-print-removed");
    }


    // remove columns from term sections
    var terms = document.getElementsByClassName("terms");
    for(i = 0; i < terms.length; i++)
    {
        terms[i].classList.add("for-print-removed-columns");
    }


    // set display: block property to all image blocks
    var images = document.getElementsByClassName("image");
    for(i = 0; i < images.length; i++)
    {
        images[i].classList.add("for-print-display-as-block");
    }
    

    // alert('works');
    return false;
}