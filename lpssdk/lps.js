
function redeemChecker(auto_load = false) {
    var rc = document.getElementById("redeemChecker").checked;
    /* ------------------------ Update Final Total version -------------------------
    if (rc == false) {
        $(".lps_redeemed_total").load("lpssdk/redeemable.php?action=onRedeem", function (data) {
            var redeemed_total = data.split('</style>')[1];  
            merchant_callback(redeemed_total);
        });
    }else{
        $(".lps_redeemed_total").load("lpssdk/redeemable.php?action=offRedeem", function (data) {
            var redeemed_total = data.split('</style>')[1];
            merchant_callback(redeemed_total);
        });
    }*/

    if (auto_load) {
        if (rc == true){
            var action = 'onRedeem';
        }else if(rc == false){
            var action = 'offRedeem';
        }
    } else {
        if (rc == false) {
            var action = 'onRedeem';
        } else {
            var action = 'offRedeem';
        }
    }
    $.get("lpssdk/redeemable.php?action="+action, function (data) {
        var sub_total = data.split('</style>')[1];
        var delivery_fee = 0 + $(".delivery_fee").html();
        delivery_fee = delivery_fee || 0;
        var redeemed_total = Number(sub_total) + Number(delivery_fee);
        redeemed_total = formatMoney(redeemed_total, 2, ".", ",");
        //alert(sub_total+'+'+delivery_fee+'='+redeemed_total);

        $(".lps_redeemed_total").html(redeemed_total);
        merchant_callback(redeemed_total);
    });
}

redeemChecker(true);

function merchant_callback(redeemed_total){    
    $.post("lpssdk/merchant_callback.php", { redeemed_total: redeemed_total }, function () { 
        //Any merchant code
    });
}


function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;
    
    return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }
    
    document.getElementById("b").addEventListener("click", event => {
      document.getElementById("x").innerText = "Result was: " + formatMoney(document.getElementById("d").value);
});