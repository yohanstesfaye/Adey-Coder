let form = document.getElementById("form");

form.addEventListener("submit", function (e) {
  //stop form submission of default
  e.preventDefault();
  let loading = document.getElementsByClassName("loading")[0];
  let report = document.getElementById("report");

  let formData = new FormData(form);

  $.ajax({
    url: "ajax.php",
    type: "POST",
    processData: false,
    contentType: false,
    beforeSend: function (e) {
      //show uploading loading
      loading.style.setProperty("display", "flex");
    },
    data: formData,
    success: function (result) {
      //hide uploading loading
      loading.style.setProperty("display", "none");
      //convert to json
      result = JSON.parse(result);

      //show message
      report.innerHTML = result.message;
      rps = report.style;
      rps.setProperty("display", "block");

      if (result.status === "success") {
        rps.setProperty("--bg", "#00ff0019");
        rps.setProperty("--txt", "#55bb55");
      } else {
        rps.setProperty("--bg", "#ff000019");
        rps.setProperty("--txt", "#ff1212");
      }

      //hide message after 8 seconds
      setTimeout(function (e) {
        rps.setProperty("display", "none");
      }, 8000);
    },
  });
});
