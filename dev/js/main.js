

//smooth scroll using jquery
function smoothScroll (duration) {
	$('a[href^="#"]').on('click', function(event) {

	    var target = $( $(this).attr('href') );

	    if( target.length ) {

	        event.preventDefault();

	        $('html, body').animate({
	            scrollTop: target.offset().top
	        }, duration);

s	    }
	});
}


smoothScroll(300);
//Ui Controller



const UiController = (function(){

	const elements = {

		fullName: document.querySelector("#fullName"),
		email: document.querySelector('#email'),
		message: document.querySelector("#message")

	}


	return {

		getInputs: function() {

				return {

					fullName: document.querySelector('#fullName').value,
					email: document.querySelector("#email").value,
					message: document.querySelector("#message").value
				}
		}
	}

})();


//page Controller
const Controller = (function(UiController){

		//wheh user clicks on the menu icon

		 const toggleActive = function(){


			const miniNav = document.querySelector(".mini-nav");

			miniNav.classList.toggle("active");


			

		}

		//UiController.displayNavbar();

		document.querySelector(".menu").addEventListener('click', toggleActive);

		// form validation

		//when user clicks on the submit button
		document.querySelector('.form').addEventListener("submit", function(e){


			e.preventDefault();

			const userData = UiController.getInputs();

			const fullName = userData.fullName;

			if(fullName === "") {

				console.log("Full name cannot be empty");
			}


		});
		


})(UiController);