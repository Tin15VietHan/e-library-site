document.addEventListener("keydown", function(event){
    if (event.ctrlKey == true && (event.key == "c" || event.key == "C")) {
        event.preventDefault();
}});


document.addEventListener("copy", function(event){
    event.preventDefault();
});