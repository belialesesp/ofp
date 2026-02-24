(function ($) {
  $("#importCardsCSV").on("click", function (e) {
    e.preventDefault();

    var form_data = new FormData();
    form_data.append("action", "add_cards_meta_data");
    form_data.append("cards_data", $("input[name=cards_data]")[0].files[0]);

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
        alert("CSV Imported Successfully");
      },
    });
  });
})(jQuery);
