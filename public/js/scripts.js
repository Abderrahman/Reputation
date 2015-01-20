$(function() {

    function IsAlphaNumeric(Val) {

        var regId = new RegExp('^[A-Za-z0-9 ]+$', 'i');

        return regId.test(Val);
    }

    $('#form2').on('submit', function(event) {

        event.preventDefault();
        avis = [];
        for (i = 1; i <= 10; i++) {

            // Positif = 1; Negatif = -1; Neutre = 0
            if (document.getElementsByName("avis" + i)[0] === undefined)
                break;

            if (document.getElementsByName("avis" + i)[0].checked)
                avis.push(1);
            else if (document.getElementsByName("avis" + i)[2].checked)
                avis.push(-1);
            else
                avis.push(0);
        }

        json = JSON.stringify(avis);

        var cl = document.getElementById("Cl");

        if (cl !== null) {

            $.post("score/add", {'id': cl.value, 'json': json}, function(data) {

                if (data === 'true') {
                    $("#error").css("display", "none");
                    $("#label").css("display", "inline");
                    window.location.replace("dashboard");

                }
            });
        }
    });

    $('#form').on('submit', function(event) {

        event.preventDefault();
        avis = [];
        for (i = 1; i <= 10; i++) {

            // Positif = 1; Negatif = -1; Neutre = 0
            if (document.getElementsByName("avis" + i)[0] === undefined)
                break;

            if (document.getElementsByName("avis" + i)[0].checked)
                avis.push(1);
            else if (document.getElementsByName("avis" + i)[2].checked)
                avis.push(-1);
            else
                avis.push(0);
        }

        json = JSON.stringify(avis);

        var e = document.getElementsByName("reg_email")[0].value;
        var p = document.getElementsByName("reg_password")[0].value;
        var f = document.getElementsByName("first_name")[0].value;
        var l = document.getElementsByName("last_name")[0].value;

        var cl = document.getElementById("Cl");

        if (!IsAlphaNumeric(f) || !IsAlphaNumeric(l)) {
            $("#error").html('First name and Last name may only contain alphanumeric characters.');
            $("#error").css("display", "inline");
            return;
        }

        if (cl !== null && e !== '' && p !== '') {
            // controller/score
            $.post("score/getScore",
                    {'id': cl.value, 'json': json, 'email': e, 'password': p, 'first_name': f, 'last_name': l},
            function(data) {

                if (data === 'true') {
                    $("#error").css("display", "none");
                    $("#label").css("display", "inline");
                    window.location.replace("dashboard");

                } else {
                    $("#error").html(data);
                    $("#error").css("display", "inline");
                }
            });
        } else {
            $("#label").css("display", "none");
            $("#error").html('Veuillez remplir touts les champs');
            $("#error").css("display", "inline");
        }
    });
});
