$(".add-var").click( function () {
    var variants = document.querySelector('.vars');

    var element = document.createElement("div");
    element.classList.add("variant");

    var input = document.createElement("input")
    input.setAttribute("type", "text");
    input.setAttribute("required", "required");
    input.setAttribute("placeholder", "Введите вариант");
    input.setAttribute("class", "variants");
    element.appendChild(input);
    input.focus();

    var area = document.createElement("div");
    area.classList.add("removalArea");
    $(area).click(function() {
        var element = this;
        var remove = element.closest(".variant");
        remove.parentNode.removeChild(remove);
    });

    var x = document.createElement("div");
    x.classList.add("removeX");

    area.appendChild(x);
    element.appendChild(area);
    variants.appendChild(element);
});

	$(".removalArea").click(function() {
		var element = this;
		var remove = element.closest(".variant");
		remove.parentNode.removeChild(remove);
	});

	$(".submit").click(function() {
		var string = "";
		$(".variant input").each(function() {
			
			var text = $(this).val() + ";" ;
			string += text;
		});
		var element = document.getElementById("data");
		element.value = string;
		console.log(element.value); 
	});