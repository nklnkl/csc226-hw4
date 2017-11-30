$(document).ready(function () {

  $('#page_name_checkbox').change(function () {
    if (this.checked)
      $('#page_name').prop('disabled', false);
    else
      $('#page_name').prop('disabled', true);
  });

  $('#remote_host_checkbox').change(function () {
    if (this.checked)
      $('#remote_host').prop('disabled', false);
    else
      $('#remote_host').prop('disabled', true);
  });

  $('#start_date_checkbox').change(function () {
    if (this.checked)
      $('#start_date').prop('disabled', false);
    else
      $('#start_date').prop('disabled', true);
  });

  $('#end_date_checkbox').change(function () {
    if (this.checked)
      $('#end_date').prop('disabled', false);
    else
      $('#end_date').prop('disabled', true);
  });

  $('#submit').on('click', function () {
    $("#records").find("tr:gt(0)").remove();
    var page_name = null;
    var remote_host = null;
    var start_date = null;
    var end_date = null;

    if ($('#page_name_checkbox').is(':checked'))
      page_name = $('#page_name').val();
    if ($('#remote_host_checkbox').is(':checked'))
      remote_host = $('#remote_host').val();
    if ($('#start_date_checkbox').is(':checked'))
      start_date = $('#start_date').val();
    if ($('#end_date_checkbox').is(':checked'))
      end_date = $('#end_date').val();

    query(page_name, remote_host, start_date, end_date, function (err, results) {
      if (err) alert(err);
      else {
        populate(results);
      }
    });
  });

  // GET request to server.
  function query (page_name, remote_host, start_date, end_date, callback) {
    var params = {};
    if (page_name != null)
      params.page_name = page_name;
    if (remote_host != null)
      params.remote_host = remote_host;
    if (start_date != null)
      params.start_date = start_date;
    if (end_date != null)
      params.end_date = end_date;
    $.get( "api.php", params, function( data ) {
      callback(null, data);
    });
  }

  function populate (rows) {
    $.each(rows, function(i, item) {
        var $tr = $('<tr>').append(
            $('<td>').text(item.page_name),
            $('<td>').text(item.visit_date),
            $('<td>').text(item.visit_time),
            $('<td>').text(item.previous_page),
            $('<td>').text(item.request_method),
            $('<td>').text(item.remote_host),
            $('<td>').text(item.remote_port)
        ).appendTo('#records');
    });
  }

});
