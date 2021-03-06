//controll the app models from here
const AppController = (function() {
  return {
    sendMessage: function(name, email, message) {},

    testing: function() {
      console.log("testing mic");
    }
  };
})();

//Ui Controller
const UiController = (function() {
  const elements = {
    fullName: document.querySelector("#fullName"),
    email: document.querySelector("#email"),
    message: document.querySelector("#message"),
    feedback: document.querySelector(".feedback")
  };

  function addActive() {
    const elements = document.querySelectorAll(
      ".intro, .about, .slug, .icon-wrapper, .projects, .navigation, .site-wrapper"
    );

    elements.forEach(function(current) {
      current.classList.add("active");
    });
  }

  const removeError = function(element) {
    element.classList.remove("error");
  };

  return {
    getInputs: function() {
      return {
        fullName: document.querySelector("#fullName").value,
        email: document.querySelector("#email").value,
        message: document.querySelector("#message").value
      };
    },

    getElements: function() {
      return elements;
    },

    displayMessage: function(message) {
      //display message

      elements.feedback.textContent = message;
    },

    clearFields: function() {
      const nodeFields = document.querySelectorAll(
        "#fullName, #email, #message"
      );

      const nodeArray = Array.from(nodeFields);

      nodeArray.forEach(function(current) {
        current.value = "";
      });
    },

    removeError: function(element) {
      element.classList.remove("error");
    },

    removeAllErrors: function() {
      this.removeError(elements.fullName);
      this.removeError(elements.email);
      this.removeError(elements.message);
    },

    landingAnimation: function() {
      //wait for 3secs and add active class to all landing elements

      setTimeout(addActive, 200);
    }
  };
})();

//Main Controller
const Controller = (function(AppController, UiController) {
  //remove loader wrapper
  window.onload = function() {
    setTimeout(load, 100);

    function load() {
      const loader = document.querySelector("#wrapper");

      loader.classList.add("active");
    }
  };

  UiController.landingAnimation();

  //console.log("testing mic");

  //toggle navigation
  const toggleActive = function() {
    const miniNav = document.querySelector(".mini-nav");

    miniNav.classList.toggle("active");
  };

  document.querySelector(".menu").addEventListener("click", toggleActive);

  // form validation

  //when user clicks on the submit button
  document.querySelector(".form").addEventListener("submit", function(e) {
    //contact form validation;

    contactFormValidation();

    function contactFormValidation() {
      //prevent default action
      e.preventDefault();

      //get elements
      const elements = UiController.getElements();

      //get user data
      const userData = UiController.getInputs();

      const fullName = userData.fullName;
      const email = userData.email;
      const message = userData.message;

      const addError = function(element) {
        element.classList.add("error");
      };

      //if fullName is empty add error class to fullname element

      if (fullName === "") {
        //add error class to fullName element

        const fullNameElement = elements.fullName;

        //add error to fullNameElement
        addError(fullNameElement);
        //console.log(fullNameElement);
      } else {
        UiController.removeError(elements.fullName);
      }

      if (email === "") {
        const emailElement = elements.email;

        addError(emailElement);
      } else {
        UiController.removeError(elements.email);
      }

      if (message === "") {
        //const messageElement = elements.message;
        addError(elements.message);
      } else {
        UiController.removeError(elements.message);
      }
      //console.log(elements);

      //get user data;

      if (message != "" && email != "" && fullName != "") {
        //remove error class from all element

        UiController.removeAllErrors();

        //display feedback on ui

        UiController.displayMessage("Message Sent");

        //clear all input field

        UiController.clearFields();

        //AppController.sendMessage(name, email, message);
      }
    }
  });
})(AppController, UiController);
