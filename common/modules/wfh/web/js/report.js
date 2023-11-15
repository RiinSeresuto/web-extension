console.log('success report');
console.log(BASE_URL);
const date     = $('#date_select')
const status   = $('#status_select')

const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];


$('#generate-report').click(function (e) {
    // console.log('has clicked');
    // console.log('date : ', $('#date_select').val());
    // console.log('status : ', $('#status_select').val());

    if (date.val() != '' && status.val() != '') {
        $.post(      
            BASE_URL+'/wfh/report/generate?d='+date.val()+'&s='+status.val()+' ',
                            
            ).done(resp => {
              if (resp.result != 0) {
                  console.log(resp.date);
                $('#result-div').html(createResult(resp.result));
                $('#btn-form-export').removeClass('hide');
                $("#btn-form-export").attr("href", BASE_URL+'/wfh/report/export?d='+date.val()+'&s='+status.val()+' ');
              } else {
                $('#result-div').html(noRecord(resp));
                $('#btn-form-export').addClass('hide');
              }

              $('#pre-date').html('(' + resp.date + ')');
            }).fail((xhr, stat, err) => console.error(xhr.responseText))
    }
});

function createResult(data)
{
    var s = '';
    var d = '';
    var newDate = '';
    var recent = '';
    if (data) {
        s  += '<table  class="table table-responsive table-condensed table-bordered table-striped table-hover">';
        s  += '<tr>';
        s  +=       '<th width="30%" style="padding: 10px;">Date</th>';
        s  +=       '<th width="70%" style="padding: 10px;">Task Description</th>';
        s  +=  '</tr>';
        $.each(data, function( index, value ){
            d = new Date(value.start_date);
            yy = d.getFullYear();
            mm = d.getMonth()+1;
            dd = d.getDate();
            if (dd < 10) {
                dd = '0' + dd;
            }
            newDate = yy + '-' + mm + '-' + dd;
            strMonth = monthNames[d.getMonth()];
            s  += '<tr>';
                if (recent != newDate) {
                    s  +=       '<td style="padding: 10px;">' + strMonth + ' ' + dd + ', ' + yy + '</td>';
                    recent = newDate;
                } else {
                    s  +=       '<td style="padding: 10px;"></td>';
                }
            s  +=       '<td style="padding: 10px;">' + escapeHtml(value.description) + '</td>';
            s  +=  '</tr>';
        });
        s  += '</table>';
    }

    return s;

}


function noRecord() 
{
    var s = '';

    s   += '<div class="alert alert-info">';
    s   +=      '<strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> No records found for this search.';
    s   += '</div>';

    return s;
}

$('#reset-report').click(function (e) {
	var url = BASE_URL+'/wfh/report';
	window.location.href = url;

});

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}