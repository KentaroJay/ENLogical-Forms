// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  "use strict";
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });

  let checkedsum;
  $('.science-section').on("click", function () {
    checkedsum = $('.science-section:checked').length;
    if (checkedsum > 0) {
      $('.science-section').prop("required", false)
    } else {
      $('.science-section').prop("required", true)
    }
  })
  $('.society-section').on("click", function () {
    checkedsum = $('.society-section:checked').length;
    if (checkedsum > 0) {
      $('.society-section').prop("required", false)
    } else {
      $('.society-section').prop("required", true)
    }
  })
})();
