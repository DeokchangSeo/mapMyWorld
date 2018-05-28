/**
 * Created by super on 21/04/2017.
 */

function loadPage(table) {
    var tableNo = table;
    var username = getCookie("username");
    if (username != null) {
        requestData = {
            "table": tableNo
        };
        $.ajax({
            url: "server/get_info.php",
            data: requestData,
            type: "POST",
            dataType: 'json',
            success: function (data) {

                if (data.result == "success") {
                    //alert("success");
                    console.log(data.return);

                    $.each(data.return, function (key, value) {
                        //console.log(key + ": "+ data.return[key]);
                        var value = data.return[key];
                        $('#' + key).append(value);
                    });
                } else {
                    console.log(data.return);
                }
            }
        });
    }

}
