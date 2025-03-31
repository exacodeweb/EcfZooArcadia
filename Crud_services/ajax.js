$(document).ready(function() {
  // Gérer la soumission du formulaire avec AJAX
  $("#updateForm").on("submit", function(e) {
      e.preventDefault(); // Empêche le rechargement de la page
      let formData = new FormData(this);

      $.ajax({
          url: "update_service.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              $("#message").html(response);
              location.reload(); // Recharge la page pour voir la mise à jour
          },
          error: function() {
              $("#message").html("<p class='error'>Erreur lors de la mise à jour.</p>");
          }
      });
  });

  // Gérer la prévisualisation de l’image
  $("#file-selector").change(function(event) {
      let file = event.target.files[0];
      if (file) {
          let reader = new FileReader();
          reader.onload = function(e) {
              $("#preview-container").html(`<img src="${e.target.result}" alt="Aperçu" style="max-width: 200px;">`);
          };
          reader.readAsDataURL(file);
      }
  });
});




/*
$(document).ready(function() {
  // Gérer la soumission du formulaire avec AJAX
  $("#updateForm").on("submit", function(e) {
      e.preventDefault(); // Empêche le rechargement de la page

      let formData = new FormData(this);
      
      $.ajax({
          url: "update_service.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              $("#message").html(response);
              location.reload(); // Recharge la page pour voir la mise à jour
          },
          error: function() {
              $("#message").html("<p class='error'>Erreur lors de la mise à jour.</p>");
          }
      });
  });

  // Gérer la prévisualisation de l’image
  $("#file-selector").change(function(event) {
      let file = event.target.files[0];
      if (file) {
          let reader = new FileReader();
          reader.onload = function(e) {
              $("#preview-container").html(`<img src="${e.target.result}" alt="Aperçu" style="width: 100px; height: 100px;">`);
          };
          reader.readAsDataURL(file);
      }
  });
});
*/






/*
$(document).ready(function() {
  // Gérer la soumission du formulaire avec AJAX
  $("#updateForm").on("submit", function(e) {
      e.preventDefault(); // Empêche le rechargement de la page

      let formData = new FormData(this);
      
      $.ajax({
          url: "update_service.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              $("#message").html(response);
              location.reload(); // Recharge la page pour voir la mise à jour
          },
          error: function() {
              $("#message").html("<p class='error'>Erreur lors de la mise à jour.</p>");
          }
      });
  });

  // Gérer la prévisualisation de l’image
  $("#file-selector").change(function(event) {
      let file = event.target.files[0];
      if (file) {
          let reader = new FileReader();
          reader.onload = function(e) {
              $("#preview-container").html(`<img src="${e.target.result}" alt="Aperçu" style="width: 100px; height: 100px;">`);
          };
          reader.readAsDataURL(file);
      }
  });
});

*/

