// let testP;
// testP = document.createElement("p");
// testP.textContent = "* * * * * test text_content * * * * *";
// document.getElementById("test_div").appendChild(testP);

$(function () {
    $("#sortable").sortable();
    $("#sortable").disableSelection();
});
