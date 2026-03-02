(function ($) {
  $("#importCardsCSV").on("click", function (e) {
    e.preventDefault();

    var fileInput = $("input[name=cards_data]")[0];
    if (!fileInput || !fileInput.files || !fileInput.files[0]) {
      alert("Please select a CSV file first.");
      return;
    }

    // The nonce is rendered by wp_nonce_field() into the page as a hidden input.
    var nonce = $("#import_cards_nonce").val();
    if (!nonce) {
      alert("Security token missing. Please refresh the page and try again.");
      return;
    }

    var form_data = new FormData();
    form_data.append("action", "add_cards_meta_data");
    form_data.append("import_cards_nonce", nonce);
    form_data.append("cards_data", fileInput.files[0]);

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/wp-admin/admin-ajax.php",
      data: form_data,
      processData: false,
      contentType: false,
      enctype: "multipart/form-data",
      async: true,
      success: function (response) {
        if (response.success) {
          alert("CSV Imported Successfully");
        } else {
          alert("Import failed: " + (response.data && response.data.message ? response.data.message : "Unknown error"));
        }
      },
      error: function (xhr) {
        alert("Request failed (status " + xhr.status + "). Check console for details.");
        console.error("CSV import error:", xhr.responseText);
      },
    });
  });
})(jQuery);